<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RtiApplication;
use App\Jobs\SendEmail;
use App\Models\RtiApplicationRevision;
use PDF;
use Illuminate\Support\Str;
use Validator;
class CustomerController extends Controller
{
    public function myRti(Request $request, $application_no = null) {
        if($application_no == null) {

            $request->merge(['user_id' => auth()->guard('customers')->id(), 'order_by' => 'created_at', 'order_by_type' => 'desc']);
            $list = RtiApplication::list(true, $request->all());
            return view('frontend.profile.my-rti', compact('list'));
        }
        else {
            $request->merge(['user_id' => auth()->guard('customers')->id(), 'application_no' => $application_no]);
            $data = RtiApplication::list(false, $request->all());
            if(count($data) > 0) {
                $data = $data[0] ?? [];
                $service_fields = [];
                if($data->service && !empty($data->service->fields)) {
                    $service_fields = json_decode($data->service->fields, true);
                }
                $revision_data = [];
                if( $data->lastRevision) {
                    if(!empty($data->lastRevision->customer_change_request)) {
                        $revision_data = json_decode($data->lastRevision->customer_change_request, true);

                    }
                    else {

                        $revision_data = json_decode($data->lastRevision->details, true);
                    }
                }
                $html = RtiApplication::draftedApplication($data);

            }
            else {
                abort(404);
            }
            return view('frontend.profile.view-my-rti', compact('data', 'revision_data', 'service_fields', 'html'));
        }
    }


    public function approvedARTI(Request $request, $application_no) {
        $filter = ['user_id' => auth()->guard('customers')->id(), 'application_no' => $application_no];
        $data = RtiApplication::list(false, $filter);
        if(count($data) > 0) {
            $data = $data[0] ?? [];
            $data->update(['signature_type' => $request->signature_type, 'signature_image' => $request->signature, 'status' => 2]);
            $rti = RtiApplication::get($data['id']);
            SendEmail::dispatch('approve-rti', $rti);
            return response(['status' => 'success']);
        }
    }
    public function sendChangeRequest(Request $request, $request_id) {
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
            if( isset($fields['form_field_type'][$key]) && $fields['form_field_type'][$key] != "lawyer") {
                $validation_string = '';
                if (isset($fields['is_required']) && isset($fields['is_required'][$key]) && $fields['is_required'][$key] == 'yes') {
                    $validation_string = 'required';
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
                        $field_key = Str::slug($fields['dependency_date_field'][$key]);
                        $validation_string .= "|after_or_equal:".$request[$field_key];
                    }
                }
                $slug_key = str_replace('-', "_", Str::slug($fields['field_lable'][$key]));
                if($validation_string != '') {
                    $validation[$slug_key ] =  $validation_string;

                }
                $field_data[$slug_key] = ['lable' => $fields['field_lable'][$key], 'type' => $fields['field_type'][$key], 'value' => $request[$slug_key]];
            }
        }


        $validator = Validator::make($request->all(),  $validation);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        if($revision) {
            $data = $request->except(['_token']);
            $revision->update(['customer_change_request' => json_encode($data)]);
            return response(['status' => 'success']);

        }

    }
}
