<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RtiApplication;
use App\Jobs\SendEmail;
use App\Models\RtiApplicationRevision;
use PDF;
use Validator;
use App\Models\RtiApplicationTracking;
use Carbon\Carbon;
use App\Models\ApplicationStatus;
use App\Models\LawyerRtiQuery;
use App\Models\Notification;
use App\Models\ApplicationCloseRequest;
use App\Models\Lawyer;
use DB;

class RtiController extends Controller
{
    public function myRti(Request $request, $application_no = null, $tab="case-details") {

        $lawyerdata = Lawyer::get(auth()->guard('lawyers')->id());
        // dd($lawyerdata);
        if($application_no == null) {
            if(isset($request->status)) {
                if($request['status'] == 'all') {
                    unset($request['status']);
                }
                else {

                    $request['status'] =  applicationStatusString()[$request->status];
                }

            }
            else {
                $request['status'] = 1;

            }
            $request->merge(['lawyer_id' => auth()->guard('lawyers')->id(), 'order_by' => 'created_at', 'order_by_type' => 'desc', 'payment_status' => 'paid']);
            // print_r(json_encode($request->all()));die;
            $list = RtiApplication::list(true, $request->all());
            $rti_count = RtiApplication::where(['lawyer_id' => auth()->guard('lawyers')->id(), 'process_status'=> true, 'payment_status' => 'paid'])->groupBy('status')->select('rti_applications.status', DB::raw('count(*) as total'))->get()->toArray();
            // $test_rti_count = RtiApplication::where(['lawyer_id' => auth()->guard('lawyers')->id(), 'process_status'=> true])->groupBy('application_no')->select('rti_applications.status', DB::raw('count(*) as total'))->get()->toArray();

            $total_rti = ["total" => 0, 'pending' => 0, 'filed' => 0, 'active' => 0];
            foreach($rti_count as $count) {
                $total_rti['total'] += $count['total'];
                if($count['status'] == 3) {
                    $total_rti['filed'] += $count['total'];
                }
                else if($count['status'] == 1) {
                    $total_rti['active'] += $count['total'];
                }
                else if($count['status'] == 2) {
                    $total_rti['pending'] += $count['total'];
                }
            }
            // echo count($list);die;

            return view('lawyer.dashboard', compact('list', 'total_rti','lawyerdata'));
        }
        else {
            $application_nos = $application_no;
            // $application_no = substr($application_no, 0, 8);
            // $application_id = substr($application_nos, 8);
            $application_nos  = explode("-",$application_nos);
            $application_no = $application_nos[0];
            $application_id = $application_nos[1];


            // echo $application_id;die;
            $request->merge(['lawyer_id' => auth()->guard('lawyers')->id(), 'application_no' => $application_no, 'id' => $application_id, 'payment_status' => 'paid']);
            $data = RtiApplication::rtiNumberDetails($request->all());
            if(count($data) > 0) {
                $data = $data[count($data)-1] ?? [];
                $service_field_data = [];
                if(!empty($data->service_fields)) {
                    $service_field_data = json_decode($data->service_fields, true);
                }
                $service_fields = [];
                if($data->service && !empty($data->service->fields)) {
                    $service_fields = json_decode($data->service->fields, true);
                }
                $revision_data = [];
                $change_request = [];

                if( $data->lastRevision) {
                    $revision_data = json_decode($data->lastRevision->details, true);
                    $change_request =  json_decode($data->lastRevision->customer_change_request, true);
                }
                $html = RtiApplication::draftedApplication($data);

              $rti_id =  $data->id;


            }
            else {
                abort(404);
            }
            return view('lawyer.view-my-rti', compact('data', 'service_fields', 'revision_data', 'service_field_data', 'change_request', 'html','lawyerdata', 'tab'));
        }
    }

    public function draftApplication($application_no) {



        $data = RtiApplication::where(['application_no' => $application_no])->first();
        $revision = $data->lastRevision;
        // print_r(json_encode($revision));
        $field_data = json_decode($revision->details, true);
        $html = $revision->serviceTemplate->template;
            $signature_html = $revision->serviceTemplate->signature;

            foreach ($field_data as $key => $value) {
                $html = str_replace("[" . $key . "]", $value, $html);
                $signature_html = str_replace("[" . $key . "]", $value, $signature_html);

            }
            $html = str_replace("[pio_address]", $data->pio_address, $html);

            $signature_html = str_replace("[pio_address]", $data->pio_address, $signature_html);



            $signature = "";

            if ($data->signature_type != "manual" && !empty($data->signature_image)) {


                $signature = public_path($data->signature_image);
                $signature = "data:image/png;base64," . base64_encode(file_get_contents($signature));
            }
            if(!empty($data->signature_image)) {

                if($data->signature_type == 'manual') {
                    $signature_html = str_replace("[signature]", "<span>".$data->signature_image."</span>", $signature_html);
                }
                else {
                    $signature_html = str_replace("[signature]", " <img src=".$signature." alt='' width='100'>", $signature_html);
                }

            }
            // $html = view('frontend.profile.rti-file-pdf', compact('data', 'field_data', 'revision', 'html', 'signature', 'signature_html'))->render();


//         $html = view('frontend.profile.rti-file-pdf', compact('data', 'field_data', 'revision', 'html', 'signature'))->render();
//         	header("Content-type: application/vnd.ms-word");
//   header("Content-Disposition: attachment;Filename=document_name.doc");
//   echo $html;
//   die;


        //
	    // return view('frontend.profile.rti-file-pdf', compact('data', 'field_data', 'revision', 'html', 'signature'));

        $pdf = PDF::loadView('frontend.profile.rti-file-pdf', compact('data', 'field_data', 'revision', 'html', 'signature', 'signature_html'));
        return $pdf->stream();
    }

    public function processRTIApplication(Request $request, $application_id) {


        $application = RtiApplication::where(['id' => $application_id])->first();

        $validation = [
            'first_name' => "required|max:50",
            'last_name' => "required|max:50",
            'email' => "required|email|max:75",
            'phone_number' => "required|digits:10",
            'address' => "required|max:255",
            'city' => "required|max:50",
            'state' => "required|max:50",
            'pincode' => "required|digits:6",

        ];

        $fields = isset($application->service->fields,) ? json_decode($application->service->fields, true) : [];

        // if($request->service_key == '0') {
        //     $validation['rti_query'] = 'required';

        //     if($request->pio_addr == 'yes') {
        //         $validation['pio_address'] = 'required';
        //     }
        // }
        $input = $request->all();
        $filelist = [];
        foreach ($fields['field_type'] ?? [] as $key => $value) {
            if( isset($fields['form_field_type'][$key]) ) {
                $slug_key = getFieldName($fields['field_lable'][$key]);
                $validation_string = '';
                if (isset($fields['is_required']) && isset($fields['is_required'][$key]) && $fields['is_required'][$key] == 'yes' && $value != 'file') {
                    $validation_string = 'required';
                }

                if($value == "input") {
                    $validation_string .= '|max:75';
                }
                if($value == "textarea") {
                    $validation_string .= '|max:200';
                }
                if($value == 'date') {
                    $validation_string .= '|date';
                    if(isset($fields['maximum_date'][$key]) && !empty($fields['maximum_date'][$key])) {
                        $validation_string .= "|before:".$fields['maximum_date'][$key];
                    }
                    if(isset($fields['minimum_date'][$key]) && !empty($fields['minimum_date'][$key])) {
                        $validation_string .= "|after_or_equal:".$fields['minimum_date'][$key];
                    }
                    if(isset($fields['dependency_date_field'][$key]) && !empty($fields['dependency_date_field'][$key])) {
                        $field_key = getFieldName($fields['dependency_date_field'][$key]);
                        $validation_string .= "|after_or_equal:".$request[$field_key];
                    }
                }
                 $validation_string = trim($validation_string, "|");

                if($validation_string != '') {
                    $validation[getFieldName($fields['field_lable'][$key])] =  $validation_string;

                }
                if($value == 'file') {
                    $new_slug_key = $slug_key."_file";

                    array_push( $filelist , $slug_key);
                    $field_data[$slug_key] = ['lable' => $fields['field_lable'][$key], 'type' => $fields['field_type'][$key], 'value' =>null];

                }
                else {

                    $field_data[$slug_key] = ['lable' => $fields['field_lable'][$key], 'type' => $fields['field_type'][$key], 'value' => $request[$slug_key]];
                }

            }
        }

        // return response(['data' =>  $validation], 500);

        $validator = Validator::make($request->all(), $validation);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        // return response(['data' =>  $application], 500);
        $application_no = $application->application_no;
        $input = $request->except(['_token', 'template_id']);
        $document_file = "";
        foreach($filelist as $list) {
            $slug = $list."_file";
            $file_name = $slug  ;

            $file =  uploadFile($request, $slug, 'page_images');
            if(empty($file)) {
                $file = $input[$list];
            }
            $field_data[$slug_key]['value'] = $file;
            $input[$list] = $file;
            unset($input[$slug]);
        }
        RtiApplicationRevision::create([
            'application_id' =>  $application->id,
            'template_id' => $request->template_id,
            'details' => json_encode($input),
        ]);
        $application->url = route('my-rti', $application_no);
        SendEmail::dispatch('draft-rti', $application);
        session()->flash('success', "Application  Number : ".$application_no." is sent to user for approval.");
        return response(['status' => 'success', 'message1' => "Application  Number : ".$application_no." is sent to user for approval.", 'clean' => false, 'disabled' => true]);

    }

    public function assignCourierTracking(Request $request, $revision_id) {
        $validator = Validator::make($request->all(), [
            'courier_name' => "required|max:50",
            'courier_tracking_number' => "required|max:50",
            'courier_date' => "required|date|after_or_equal:today",
            'charges' => "required|numeric|digits_between:1,6",
            'details' => "required|max:255"

        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        try {

            $revision = RtiApplicationRevision::find($revision_id);
            if($revision) {
                $data = $request->only(['courier_name', 'courier_date', 'courier_tracking_number', 'charges']);
                $data['address'] = $request->details;
                $data['documents'] = $request->documents;
                $data['application_id'] = $revision->application_id;
                $data['revision_id'] = $revision->id;
                $data['lawyer_id'] = auth()->guard('lawyers')->id();
                RtiApplicationTracking::create($data);
                $revision->rtiApplication()->update(['status' => 3]);
                ApplicationStatus::create(['status' => "filed", "date" => Carbon::now(), 'time' => Carbon::now(), 'application_id' => $revision->application_id]);
                SendEmail::dispatch('filed-mail', $revision->rtiApplication);
                $revision->rtiApplication()->update(['pio_expected_date' => Carbon::now()->addDays(40)]);

            }
            session()->flash('success', "RTI Application ".$revision->rtiApplication->application_no." is successully filed.");
            return response(['status' => 'success', 'message1' => "Tracking details are successfully added"]);


        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);

        }
    }

    public function sendQuery(Request $request, $application_id) {
        $validator = Validator::make($request->all(), [
            'message' => "required|max:255",
        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        try {

            $data['application_id'] = $application_id;
            $data['message'] = $request->message;
            $data['from_user'] = "lawyer";
            $data['to_user'] = "customer";

            $query = LawyerRtiQuery::create($data);
            // Notification::create(['message' => "lawyer need more information", 'linkable_type' => "rti-application", 'linkable_id' => $application_id, 'type' => "more-info", 'from_type' => 'lawyer', 'from_id' => auth()->guard('lawyers')->id(), 'additional' => ['id' => $query->id, 'module' => "lawyer_query"]]);
            $application = RtiApplication::where(['id' => $application_id])->first();
            // SendEmail::dispatch('filed-rti', $application);
            SendEmail::dispatch('more-info', $application);

            session()->flash('success', 'Requested Info is sended to user.');
            return response(['status' => 'success']);


        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);

        }
    }

    public function sendBackToAdmin(Request $request, $application_id) {


        $validator = Validator::make($request->all(), [
            'message' => "required|max:255",
        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        try {

            $data['application_id'] = $application_id;
            $data['message'] = $request->message;
            $data['lawyer_id'] = auth()->guard('lawyers')->id();
            ApplicationCloseRequest::create($data);
            session()->flash('success', 'Requested Info is sended to admin.');
            return response(['status' => 'success', 'message' => ""]);


        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);

        }

    }

    public function assignPIO(Request $request, $application_id) {
        $validator = Validator::make($request->all(), [
            'pio_address' => "required|max:255",
        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        try {
            $application = RtiApplication::find($application_id);
            if($application) {
                $application->update(['pio_address' => $request->pio_address, 'manual_pio' => isset($request['manual_pio']) && $request['manual_pio'] == 'on'  ? 1 : 0]);
            }
            return response(['status' => 'success', 'message' => "PIO is successfully assigned"]);
        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);

        }
    }

    public function approveChangeRequest(Request $request, $application_id) {

        try {
            $application = RtiApplication::find($application_id);
            if($application && $application->lastRevision) {
                $details = json_decode($application->lastRevision->details, true);
                $customer_change_request = json_decode($application->lastRevision->customer_change_request, true);
                foreach($customer_change_request as $key => $value) {
                    $details[$key] = $value;
                }
                RtiApplicationRevision::create([
                    'application_id' =>  $application->id,
                    'template_id' => $application->lastRevision->template_id,
                    'details' => json_encode($details),
                ]);

                SendEmail::dispatch('draft-rti', $application);

                session()->flash('success', "RTI is successfully drafted.");
                return response(['status' => 'success']);
            }
            return response(['status' => 'error', 'message' => "invalid applicatio  no."]);

        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);

        }
    }

    public function getLawyerQuery($query_id) {
        $data = LawyerRtiQuery::find($query_id);
        return response(['data' => $data]);
    }

    public function uploadFinalRTI(Request $request, $application_id) {

        $validator = Validator::make($request->all(), [
            'document' => 'required|file|mimes:pdf|max:3072',

        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        try {
            $data = uploadFile($request, 'document', 'final-rti');
            $application = RtiApplication::find($application_id);
            $application->update(['final_rti_document' => $data]);
            session()->flash('success', "Document successfully uploaded.");
            return response(['status' => 'success']);
        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);

        }



    }

    public function rtiList(Request $request) {
        if(isset($request->status)) {
            if($request['status'] == 'all') {
                unset($request['status']);
            }
            else {
                $request['status'] =  applicationStatusString()[$request->status];
            }

        }
        else {
            $request['status'] = 1;
        }
        $request->merge(['lawyer_id' => auth()->guard('lawyers')->id(), 'order_by' => 'created_at', 'order_by_type' => 'desc', 'payment_status' => 'paid']);
        $list = RtiApplication::list(true, $request->all());
        $html  =  view('lawyer.listing', compact('list'))->render();
        $list = $list->toArray();
        return response(['data' =>  $html, 'pages' => ['next_page' =>  $list['current_page']+1, 'last_page' => $list['last_page']]]);
    }

}
