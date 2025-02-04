<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RtiApplication;
use App\Models\Setting;
use App\Jobs\SendEmail;
use App\Models\RtiApplicationRevision;
use PDF;
use Illuminate\Support\Str;
use Validator;
use App\Models\RtiAppeal;
use Carbon\Carbon;
use App\Models\ApplicationStatus;
use Razorpay\Api\Api;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    public function myRti(Request $request, $application_no = null)
    {
        $payment = Setting::getSettingData('payment');
        if ($application_no == null) {

            $request->merge(['user_id' => auth()->guard('customers')->id(), 'order_by' => 'created_at', 'order_by_type' => 'desc']);
            $list = RtiApplication::list(true, $request->all());
            return view('frontend.profile.my-rti', compact('list', 'payment'));
        } else {
            $request->merge(['user_id' => auth()->guard('customers')->id(), 'application_no' => $application_no]);
            // $data = RtiApplication::list(false, $request->   all());
            $list = RtiApplication::rtiNumberDetails($request->all());
            $data = $list;
            if(count($data) > 0) {
                $data = $data[count($data)-1] ?? [];
                $service_fields = [];
                if ($data->service && !empty($data->service->fields)) {
                    $service_fields = json_decode($data->service->fields, true);
                }
                $revision_data = [];
                if ($data->lastRevision) {
                    if (!empty($data->lastRevision->customer_change_request)) {
                        $revision_data = json_decode($data->lastRevision->customer_change_request, true);
                    } else {

                        $revision_data = json_decode($data->lastRevision->details, true);
                    }
                }
                $html = RtiApplication::draftedApplication($data);
            } else {
                abort(404);
            }
            return view('frontend.profile.view-my-rti', compact('data', 'revision_data', 'service_fields', 'html', 'list'));
        }
    }


    public function approvedARTI(Request $request, $application_no)
    {
        $filter = ['user_id' => auth()->guard('customers')->id(), 'application_no' => $application_no];
        // $data = RtiApplication::list(false, $filter);
        $data = RtiApplication::rtiNumberDetails($request->all());
        if(count($data) > 0) {
            $data = $data[count($data)-1] ?? [];
            $data->update(['signature_type' => $request->signature_type, 'signature_image' => $request->signature, 'status' => 2]);
            $rti = RtiApplication::get($data['id']);
            ApplicationStatus::create(['status' => "approved", "date" => Carbon::now(), 'time' => Carbon::now(), 'application_id' => $rti->id]);

            SendEmail::dispatch('approve-rti', $rti);
            return response(['status' => 'success']);
        }
    }
    public function sendChangeRequest(Request $request, $request_id)
    {
        $revision = RtiApplicationRevision::find($request_id);
        $validation = [
            'first_name' => "required",
            'last_name' => "required",
            'state' => "required",
            'city' => "required",
            'email' => "required|email",
            'phone_number' => "required|digits:10",
            'address' => "required",
            'pincode' => "required|digits:6",

        ];

        $fields = isset($revision->rtiApplication->service->fields,) ? json_decode($revision->rtiApplication->service->fields, true) : [];
        foreach ($fields['field_type'] ?? [] as $key => $value) {
            if (isset($fields['form_field_type'][$key]) && $fields['form_field_type'][$key] != "lawyer") {
                $validation_string = '';
                if (isset($fields['is_required']) && isset($fields['is_required'][$key]) && $fields['is_required'][$key] == 'yes') {
                    $validation_string = 'required';
                }
                if ($value == 'date') {
                    $validation_string .= '|date';
                    if (isset($fields['maximum_date'][$key]) && !empty($fields['maximum_date'][$key])) {
                        $validation_string .= "|before:" . $fields['maximum_date'][$key];
                    }
                    if (isset($fields['minimum_date'][$key]) && !empty($fields['minimum_date'][$key])) {
                        $validation_string .= "|after_or_equal:" . $fields['minimum_date'][$key];
                    }
                    if (isset($fields['dependency_date_field'][$key]) && !empty($fields['dependency_date_field'][$key])) {
                        $field_key = Str::slug($fields['dependency_date_field'][$key]);
                        $validation_string .= "|after_or_equal:" . $request[$field_key];
                    }
                }
                $slug_key = str_replace('-', "_", Str::slug($fields['field_lable'][$key]));
                if ($validation_string != '') {
                    $validation[$slug_key] =  $validation_string;
                }
                $field_data[$slug_key] = ['lable' => $fields['field_lable'][$key], 'type' => $fields['field_type'][$key], 'value' => $request[$slug_key]];
            }
        }


        $validator = Validator::make($request->all(),  $validation);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        if ($revision) {
            $data = $request->except(['_token']);
            $revision->update(['customer_change_request' => json_encode($data)]);
            return response(['status' => 'success']);
        }
    }

    public function customerRtiDelete(Request $request, $application_no = null)
    {

        $id =  $request->id;
        $model = RtiApplication::find($id);
        $model->delete();
        // Redirect to another page with a success message
        return redirect()->route('my-rti')->with('success', 'The record has been created successfully!');
    }

    public function customerpayAction(Request $request)
    {
        $rti = RtiApplication::where(['application_no' => $request->application_no, 'appeal_no' => $request->appeal_no])->first();
        $service_fields = json_decode($rti->service_fields, true);
        $service_fields['user_document'] =  $request->documents; //uploadFile($request, 'file', 'user_files');
        // print_r( $request->documents); die();
        $rti->update(['charges' => $request->charges, 'service_fields' => json_encode($service_fields), 'documents' => $request->documents]);
        return response(['step' => 4, 'rti' => $rti, 'service_fields' => $service_fields]);
    }

    public function rtiAppeal(Request $request, $application_id) {
        
        $application = RtiApplication::find($application_id);
        $appeal = RtiAppeal::where(['appeal_no' => $request->appeal_no, 'application_id' => $application_id])->first();
        if(!$appeal) {
            $validation = [
                'appeal_no' => "required",
                'reason' => "required",
                'document' => "required",
                'received_appeal' => 'required'

    
            ];
            $validator = Validator::make($request->all(),  $validation);
            if ($validator->fails()) {
                return response(['errors' => $validator->errors()], 422);
            }
            $data = $request->only(['appeal_no', 'reason', 'document', 'received_appeal']);
            $data['application_id'] = $application_id;
            $appeal = RtiAppeal::create($data);
            if(!$application->lastRevision) {
                $remove = ['id', 'created_at', 'updated_at', 'status'];
                $application = $application->toArray();
                $application = array_diff_key($application, array_flip($remove));
                // unset($application['id']);
                // unset($application['created_at']);
                // unset($application['updated_at']);
                // unset($application['status']);
                $application['appeal_no'] = $request->appeal_no;
                $application['application_id'] = $application_id;
                RtiApplication::create($application);
            }
            else {
                $revision_data = [];
                if( $data->lastRevision) {

                    $service_field_data = [];
                    if(!empty($application->service_fields)) {
                        $service_field_data = json_decode($data->service_fields, true);
                        $service_field_data = [];
                        if(!empty($data->service_fields)) {
                            $service_field_data = json_decode($data->service_fields, true);
                        }
                    }


                    $columns = ['first_name', 'last_name', 'email', 'phone_number', 'address', 'pincode'];
                    $additonal_fields = array_diff_key($revision_data, array_flip($remove));
                    $revision_data = json_decode($data->lastRevision->details, true);
                    $remove = ['id', 'created_at', 'updated_at', 'status'];
                    $application = array_diff_key($post, array_flip($remove));
                    $application['first_name'] = $revision_data['first_name'];
                    $application['last_name'] = $revision_data['last_name'];
                    $application['email'] = $revision_data['email'];
                    $application['phone_number'] = $revision_data['phone_number'];
                    $application['address'] = $revision_data['address'];
                    $application['postal_code'] = $revision_data['pincode'];

                  


                }
                

            }

            session()->flash('success', "Success");
            return response(['status' => 'success', 'message' =>  "Success"]);
        }
        return response(['status' => 'error', 'message' => "First appeal already applied"]);

        // 'application_id', 'appeal_no', 'reason', 'document', 'status'
    }

    public function paymentRti(Request $request, $application_id = null)
    {
        $application_id = decryptString($application_id);
        $application = RtiApplication::get($application_id);
        if($application) {

            $payment = Setting::getSettingData('payment');
         
           $why_choose = Section::list(true, ['status' => 1, 'type' => 'why_choose', 'order_by' => 'sequance', 'order_by_type' => 'asc', 'limit' => 3]);
           return view('frontend.profile.payment-rti', compact( 'payment','why_choose', 'application'));
        }

    }

    
}
