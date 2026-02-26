<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Models\ApplicationCloseRequest;
use App\Models\ApplicationStatus;
use App\Models\Lawyer;
use App\Models\LawyerRtiQuery;
use App\Models\Notification;
use App\Models\PioMaster;
use App\Models\RtiApplication;
use App\Models\RtiApplicationRevision;
use App\Models\RtiApplicationTracking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PDF;

class RtiController extends Controller
{
    /**
     * Display the lawyer's RTI list or a specific RTI application details.
     *
     * @param Request $request
     * @param string|null $application_no
     * @param string $tab
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function myRti(Request $request, $application_no = null, $tab = "case-details")
    {
        $lawyerdata = Lawyer::find(auth()->guard('lawyers')->id());

        if ($application_no === null) {
            // Logic for listing all RTIs
            $status = $request->status;
            
            if (isset($status)) {
                if ($status === 'all') {
                    $request->offsetUnset('status');
                } else {
                    $request['status'] = applicationStatusString()[$status] ?? 1; // Assuming applicationStatusString is a helper
                }
            } else {
                $request['status'] = 1;
            }

            $request->merge([
                'lawyer_id' => auth()->guard('lawyers')->id(),
                'order_by' => 'created_at',
                'order_by_type' => 'desc',
                'payment_status' => 'paid',
            ]);

            $list = RtiApplication::list(true, $request->all()); // Assuming RtiApplication::list() is a custom method
            
            $rti_counts = RtiApplication::where([
                'lawyer_id' => auth()->guard('lawyers')->id(),
                'payment_status' => 'paid'
            ])
            ->groupBy('status')
            ->select('rti_applications.status', DB::raw('count(*) as total'))
            ->get();

            $total_rti = [
                "total" => 0, 
                'pending' => 0, 
                'filed' => 0, 
                'active' => 0
            ];

            foreach ($rti_counts as $count) {
                $total_rti['total'] += $count['total'];
                if ($count['status'] == 3) {
                    $total_rti['filed'] += $count['total'];
                } elseif ($count['status'] == 1) {
                    $total_rti['active'] += $count['total'];
                } elseif ($count['status'] == 2) {
                    $total_rti['pending'] += $count['total'];
                }
            }

            return view('lawyer.dashboard', compact('list', 'total_rti', 'lawyerdata'));
        } else {
            // Logic for viewing a single RTI
            $application_parts = explode("-", $application_no);
            $rti_no = $application_parts[0];
            $application_id = $application_parts[1] ?? null;

            if (!$application_id) {
                abort(404);
            }

            $request->merge([
                'lawyer_id' => auth()->guard('lawyers')->id(),
                'application_no' => $rti_no,
                'id' => $application_id,
                'payment_status' => 'paid',
            ]);

            $data_collection = RtiApplication::rtiNumberDetails($request->all()); // Assuming RtiApplication::rtiNumberDetails is a custom method
            
            if ($data_collection->isEmpty()) {
                abort(404);
            }

            $data = $data_collection->last();

            $service_field_data = !empty($data->service_fields) ? json_decode($data->service_fields, true) : [];
            $service_fields = ($data->service && !empty($data->service->fields)) ? json_decode($data->service->fields, true) : [];
            
            $revision_data = [];
            $change_request = [];

            if ($data->lastRevision) {
                $revision_data = json_decode($data->lastRevision->details, true) ?? [];
                $change_request = json_decode($data->lastRevision->customer_change_request, true) ?? [];
            }

            $html = RtiApplication::draftedApplication($data); // Assuming RtiApplication::draftedApplication is a custom method

            // Redirection logic based on status and current tab
            if (($data->status >= 2) && in_array($tab, ["drafted-rti", "draft-rti"])) {
                return redirect()->to('/lawyer/myrti/' . $rti_no . "-" . $data->id . "/approved-rti");
            } elseif (empty($data->final_rti_document) && ($tab == "tracking-no")) {
                return redirect()->to('/lawyer/myrti/' . $rti_no . "-" . $data->id . "/upload-rti");
            } elseif (($data->status < 2) && ($tab == "upload-rti")) {
                return redirect()->to('/lawyer/myrti/' . $rti_no . "-" . $data->id . "/approved-rti");
            }

            return view('lawyer.view-my-rti', compact('data', 'service_fields', 'revision_data', 'service_field_data', 'change_request', 'html', 'lawyerdata', 'tab'));
        }
    }

    ---

    /**
     * Generates and streams the draft RTI application as a PDF.
     *
     * @param int $application_id
     * @return \Illuminate\Http\Response
     */
    public function draftApplication($application_id)
    {
        $data = RtiApplication::where('id', $application_id)->firstOrFail();
        $html = RtiApplication::draftedApplication($data); // Assuming this returns the HTML content for the PDF
        $pdf = PDF::loadHtml($html);
        
        return $pdf->stream();
    }

    ---

    /**
     * Processes and drafts the RTI application details submitted by the lawyer.
     *
     * @param Request $request
     * @param int $application_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function processRTIApplication(Request $request, $application_id)
    {
        $application = RtiApplication::where('id', $application_id)->firstOrFail();

        $validation = [
            'first_name' => 'required|min:1|max:45|regex:/^[a-zA-Z\s.]+$/u',
            'last_name' => 'required|min:1|max:45|regex:/^[a-zA-Z\s.]+$/u',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|max:45',
            'address' => 'required|min:3|max:100',
            'city' => 'required|min:3|max:25',
            'state' => 'required|min:3|max:25',
            'pincode' => 'required|digits:6',
        ];

        $fields = $application->service->fields ? json_decode($application->service->fields, true) : [];
        $filelist = [];
        $field_data = [];
        
        // Dynamic validation based on service fields
        foreach ($fields['field_type'] ?? [] as $key => $value) {
            if (!isset($fields['form_field_type'][$key])) {
                continue;
            }

            $slug_key = getFieldName($fields['field_lable'][$key]); // Assuming getFieldName is a helper
            $validation_string = '';

            $is_required = $fields['is_required'][$key] ?? 'no';

            if ($value != 'file') {
                $validation_string = ($is_required == 'yes') ? 'required' : 'nullable';
            } else {
                // Handle file uploads, no general validation needed here unless files are explicitly required later
            }

            if ($value == 'date') {
                $validation_string .= '|date';
                if ($fields['maximum_date'][$key] ?? null) {
                    $validation_string .= "|before:" . $fields['maximum_date'][$key];
                }
                if ($fields['minimum_date'][$key] ?? null) {
                    $validation_string .= "|after_or_equal:" . $fields['minimum_date'][$key];
                }
                if ($fields['dependency_date_field'][$key] ?? null) {
                    $field_key = getFieldName($fields['dependency_date_field'][$key]);
                    $validation_string .= "|after_or_equal:" . $request[$field_key];
                }
            }

            $validation_string = trim($validation_string, "|");
            
            // Add custom validations
            if ($fields['validations'][$key] ?? null) {
                $validation_string .= "|" . $fields['validations'][$key];
            }
            
            // Default max for textarea if not present
            if ($value == "textarea" && !str_contains($validation_string, 'max:')) {
                $validation_string .= '|max:200';
            }

            $validation_string = trim($validation_string, "|");
            $validation_string = str_replace("current_year", Carbon::now()->format('Y'), $validation_string);

            if ($validation_string !== '') {
                $validation[getFieldName($fields['field_lable'][$key])] = $validation_string;
            }

            if ($value == 'file') {
                array_push($filelist, $slug_key);
                $field_data[$slug_key] = ['lable' => $fields['field_lable'][$key], 'type' => $fields['field_type'][$key], 'value' => null];
            } else {
                $field_data[$slug_key] = ['lable' => $fields['field_lable'][$key], 'type' => $fields['field_type'][$key], 'value' => $request[$slug_key]];
            }
        }

        // Additional RTI/PIO specific validation
        if (isset($request->rti_query)) {
            $validation['rti_query'] = 'required|max:1000';
            if (strtolower($request->pio_addr) == 'yes') {
                $validation['pio_address'] = 'required|max:500';
            }
        }

        if (empty($application->pio_address)) {
            $validation['to'] = 'required|max:500';
        }
        
        // Phone number validation logic
        $phone_number_digits = 10;
        $phone_start_regex = "[6789]\d{9}";
        
        if (!empty($request->phone_number) && $request->phone_number[0] == 0) {
            $phone_number_digits = 11;
            $phone_start_regex = "[0][6789]\d{9}";
        }
        
        $validation['phone_number'] = "required|digits:{$phone_number_digits}|" 
            . Rule::notIn(['6666666666', '7777777777', '8888888888', '9999999999']) 
            . "|regex:/^{$phone_start_regex}$/";

        $validator = Validator::make($request->all(), $validation, [
            'phone_number.digits' => "Please enter a valid " . $phone_number_digits . "-digit phone number.",
            'phone_number.regex' => !empty($request->phone_number) && $request->phone_number[0] == 0 
                ? "Phone number second digit should start with 6, 7, 8, or 9" 
                : "Phone number should start with 6, 7, 8, or 9",
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        // Processing files and input
        $input = $request->except(['_token', 'template_id']);

        foreach ($filelist as $list) {
            $slug = $list . "_file";
            $file = uploadFile($request, $slug, 'page_images'); // Assuming uploadFile is a helper
            
            if (empty($file)) {
                $file = $input[$list] ?? null; // Keep existing file if new one not uploaded
            }
            
            $field_data[$list]['value'] = $file; // Corrected to $list, not $slug_key
            $input[$list] = $file;
            unset($input[$slug]);
        }

        // Save or update revision
        if ($application->lastRevision && $application->lastRevision->send_client == 0) {
            $revision = $application->lastRevision;
            $revision->update([
                'details' => json_encode($input),
                'lawyer_id' => auth()->guard('lawyers')->id(),
                'send_client' => 0
            ]);
        } else {
            $revision = RtiApplicationRevision::create([
                'application_id' => $application->id,
                'template_id' => $request->template_id,
                'details' => json_encode($input),
                'lawyer_id' => auth()->guard('lawyers')->id(),
                'send_client' => 0,
            ]);
        }

        session()->flash('success', "Application Number: " . $application->application_no . " is drafted successfully.");
        
        return response([
            'status' => 'success', 
            'message1' => "Application Number: " . $application->application_no . " is drafted successfully.", 
            'clean' => false, 
            'disabled' => true
        ]);
    }

    ---

    /**
     * Sends the current draft revision to the customer for approval.
     *
     * @param int $revision_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendDraftToCustomer($revision_id)
    {
        $revision = RtiApplicationRevision::findOrFail($revision_id);
        $revision->update(['send_client' => 1]);
        
        $application = $revision->rtiApplication;

        SendEmail::dispatch('draft-rti', $revision);
        $html = view('email.draft_rti', ['data' => $revision])->render();
        Notification::sendNotification('draft-rti', $application, ['mail' => $html]);

        session()->flash('success', "Application Number: " . $application->application_no . " is sent to user for approval.");
        
        return back();
    }

    ---

    /**
     * Assigns courier tracking details to a filed application.
     *
     * @param Request $request
     * @param int $revision_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignCourierTracking(Request $request, $revision_id)
    {
        $validator = Validator::make($request->all(), [
            'courier_name' => 'required|max:50',
            'courier_tracking_number' => 'required|unique:rti_application_trackings,courier_tracking_number|max:2500',
            'courier_date' => 'required|date|before_or_equal:today',
            'charges' => 'required|numeric|digits_between:1,6',
            'details' => 'nullable|max:255',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        if (!isset($request->documents) || empty($request->documents)) {
            return response(['errors' => ['error' => 'document is required']], 422);
        }

        try {
            $revision = RtiApplicationRevision::findOrFail($revision_id);
            $application = $revision->rtiApplication;
            
            $data = $request->only(['courier_name', 'courier_date', 'courier_tracking_number', 'charges']);
            $data['address'] = $request->details;
            $data['documents'] = $request->documents; // Assuming $request->documents is handled correctly as an array or JSON string
            $data['application_id'] = $application->id;
            $data['revision_id'] = $revision->id;
            $data['lawyer_id'] = auth()->guard('lawyers')->id();
            
            RtiApplicationTracking::create($data);

            // Update application status
            $application->update([
                'status' => 3, // Filed status
                'pio_expected_date' => Carbon::now()->addDays(40)
            ]);

            ApplicationStatus::create([
                'status' => "filed", 
                "date" => Carbon::now(), 
                'time' => Carbon::now(), 
                'application_id' => $application->id
            ]);

            // Send notifications and email
            SendEmail::dispatch('filed-mail', $application);
            $html = view('email.filed_rti', ['data' => $application])->render();
            Notification::sendCustomerNotification('filed-mail', $application, ['mail' => $html]);

            session()->flash('success', "RTI Application " . $application->application_no . " is successfully filed.");
            
            return response([
                'status' => 'success', 
                'message1' => "Tracking details are successfully added"
            ]);
        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);
        }
    }

    ---

    /**
     * Sends a query from the lawyer to the customer.
     *
     * @param Request $request
     * @param int $application_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendQuery(Request $request, $application_id)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|max:1000',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        try {
            $data = [
                'application_id' => $application_id,
                'message' => $request->message,
                'from_id' => auth()->guard('lawyers')->id(),
                'from_user' => 'lawyer',
                'to_user' => 'customer',
            ];

            $query = LawyerRtiQuery::create($data);
            $application = RtiApplication::findOrFail($application_id);

            // Send email and notification
            SendEmail::dispatch('more-info', $query);
            $html = view('email.more-info', ['data' => $query])->render();
            Notification::sendNotification('more-info-requested', $application, ['mail' => $html]);

            session()->flash('success', 'Requested Info is sent to the user.');
            
            return response(['status' => 'success']);
        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);
        }
    }

    ---

    /**
     * Sends an application back to the admin with a message (close request).
     *
     * @param Request $request
     * @param int $application_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendBackToAdmin(Request $request, $application_id)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        try {
            $data = ApplicationCloseRequest::create([
                'application_id' => $application_id,
                'message' => $request->message,
                'lawyer_id' => auth()->guard('lawyers')->id(),
            ]);
            
            SendEmail::dispatch('send-back-to-admin', $data);

            session()->flash('success', 'Request is sent to the admin.');
            
            return response(['status' => 'success', 'message' => ""]);
        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);
        }
    }

    ---

    /**
     * Assigns a PIO address to the RTI application.
     *
     * @param Request $request
     * @param int $application_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignPIO(Request $request, $application_id)
    {
        $validator = Validator::make($request->all(), [
            'pio_address' => 'required|min:3|max:255',
        ]);

        if ($validator->fails()) {
            // Check if manual_pio is not set, meaning it's a search validation error
            if (!isset($request->manual_pio)) {
                return response(['errors' => ['search_pio' => 'The PIO address field is required.']], 422);
            } else {
                return response(['errors' => $validator->errors()], 422);
            }
        }

        try {
            // Logic to check if PIO exists if not manually added
            if (!isset($request->manual_pio)) {
                $check = PioMaster::where('address', $request->pio_address)->first();
                if (!$check) {
                    return response(['errors' => ['search_pio' => 'This PIO address does not exist in our record. You can add it manually.']], 422);
                }
            }
            
            $application = RtiApplication::findOrFail($application_id);
            
            $application->update([
                'pio_address' => $request->pio_address, 
                'manual_pio' => isset($request['manual_pio']) && $request['manual_pio'] == 'on' ? 1 : 0
            ]);

            session()->flash('success', "PIO is successfully assigned");
            
            return response([
                'status' => 'success', 
                'value' => $application->pio_address, 
                'message' => 'PIO is successfully assigned',
                'set_column' => 'to_address'
            ]);
        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);
        }
    }

    ---

    /**
     * Approves and incorporates the customer's change request into a new revision.
     *
     * @param Request $request
     * @param int $application_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function approveChangeRequest(Request $request, $application_id)
    {
        try {
            $application = RtiApplication::find($application_id);

            if ($application && $application->lastRevision) {
                $details = json_decode($application->lastRevision->details, true) ?? [];
                $customer_change_request = json_decode($application->lastRevision->customer_change_request, true) ?? [];
                
                // Merge changes
                $details = array_merge($details, $customer_change_request);
                
                // Create new revision with approved changes
                $revision = RtiApplicationRevision::create([
                    'lawyer_id' => auth()->guard('lawyers')->id(),
                    'application_id' => $application->id,
                    'template_id' => $application->lastRevision->template_id,
                    'details' => json_encode($details),
                ]);

                // Send email and notification
                SendEmail::dispatch('draft-rti-again', $revision);
                $html = view('email.draft_rti', ['data' => $revision])->render();
                Notification::sendNotification('draft-rti-again', $application, ['mail' => $html]);

                session()->flash('success', "RTI is successfully drafted with approved changes.");
                
                return response(['status' => 'success']);
            }
            
            return response(['status' => 'error', 'message' => "Invalid application number."]);
        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);
        }
    }

    ---

    /**
     * Retrieves the details of a specific lawyer query.
     *
     * @param int $query_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLawyerQuery($query_id)
    {
        $data = LawyerRtiQuery::findOrFail($query_id);
        
        return response(['data' => $data]);
    }

    ---

    /**
     * Uploads the final RTI document (PDF).
     *
     * @param Request $request
     * @param int $application_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFinalRTI(Request $request, $application_id)
    {
        $validator = Validator::make($request->all(), [
            'document' => 'required|file|mimes:pdf|max:5120', // Max 5MB
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        try {
            $data = uploadFile($request, 'document', 'final-rti'); // Assuming uploadFile is a helper
            $application = RtiApplication::findOrFail($application_id);
            
            $application->update(['final_rti_document' => $data]);

            return response([
                'status' => 'success', 
                'form' => 'upload-rti', 
                'file' => asset($data), 
                'message' => 'Document successfully uploaded.'
            ]);
        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);
        }
    }

    ---

    /**
     * Fetches a paginated list of RTI applications for the lawyer.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function rtiList(Request $request)
    {
        $status = $request->status;

        if (isset($status)) {
            if ($status == 'all') {
                $request->offsetUnset('status');
            } else {
                $request['status'] = applicationStatusString()[$status] ?? 1; // Assuming helper exists
            }
        } else {
            $request['status'] = 1;
        }

        $request->merge([
            'lawyer_id' => auth()->guard('lawyers')->id(), 
            'order_by' => 'created_at', 
            'order_by_type' => 'desc', 
            'payment_status' => 'paid'
        ]);

        $list = RtiApplication::list(true, $request->all()); // Assuming RtiApplication::list() is a custom method
        
        $html = view('lawyer.listing', compact('list'))->render();
        $list_array = $list->toArray();

        return response([
            'data' => $html, 
            'pages' => [
                'next_page' => ($list_array['current_page'] ?? 0) + 1, 
                'last_page' => $list_array['last_page'] ?? 1
            ]
        ]);
    }

    ---

    /**
     * Sends a reminder email to the customer about an existing query.
     *
     * @param Request $request
     * @param int $application_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendReminder(Request $request, $application_id)
    {
        try {
            $application = RtiApplication::where('id', $application_id)->firstOrFail();
            $query = LawyerRtiQuery::where('id', $request->enquiry)->firstOrFail();

            // Resend email and notification for the query
            SendEmail::dispatch('more-info', $query);
            $html = view('email.more-info', ['data' => $query])->render();
            Notification::sendNotification('more-info-requested', $application, ['mail' => $html]);

            session()->flash('success', 'Reminder is successfully sent.');
            
            return back();
        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);
        }
    }

    ---

    /**
     * Retrieves the content of a notification based on its type.
     *
     * @param int $id
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function getNotification($id)
    {
        $notification = Notification::findOrFail($id);
        $data = RtiApplication::find($notification->linkable_id);
        $html = "";

        if ($notification->type == 'more-info-sended') {
            $additional = $notification->additional;
            $query = LawyerRtiQuery::find($additional['id']);
            $html = view('notification.more-info', compact('data', 'query'))->render();
            
            return response(['data' => $html]);
        } else {
            $additional = $notification->additional;
            $html = $additional['mail'] ?? '';
            
            return view('notification.mail-data', compact('html'));
        }
    }
}