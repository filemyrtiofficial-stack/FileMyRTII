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
use App\Models\LawyerRtiQuery;
use App\Models\Notification;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    public function myRti(Request $request, $application_no = null, $tab = "application-status")
    {
        $payment = Setting::getSettingData('payment');
        if ($application_no == null) {

            $request->merge(['user_id' => auth()->guard('customers')->id(), 'order_by' => 'created_at', 'order_by_type' => 'desc']);
            $list = RtiApplication::list(true, $request->all());
            // print_r($list);die();
            return view('frontend.profile.my-rti', compact('list', 'payment'));
        } else {
            $request->merge(['user_id' => auth()->guard('customers')->id(), 'application_no' => $application_no, 'payment_status' => 'paid']);
            // $data = RtiApplication::list(false, $request->   all());
            $list = RtiApplication::rtiNumberDetails($request->all());
            //  echo "<pre>"; print_r( $list ); die('hello');
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
            return view('frontend.profile.view-my-rti', compact('data', 'revision_data', 'service_fields', 'html', 'list', 'tab'));
        }
    }


    public function approvedARTI(Request $request, $application_no)
    {
        $filter = ['user_id' => auth()->guard('customers')->id(), 'application_no' => $application_no];
        // $data = RtiApplication::list(false, $filter);
        // $data = $request->except(['_token']);

        $data = RtiApplication::rtiNumberDetails(['application_no' => $application_no]);
        if(count($data) > 0) {
            $data = $data[count($data)-1] ?? [];
            $data->update(['signature_type' => $request->signature_type, 'signature_image' => $request->signature, 'status' => 2]);
            $rti = RtiApplication::get($data['id']);
            ApplicationStatus::create(['status' => "approved", "date" => Carbon::now(), 'time' => Carbon::now(), 'application_id' => $rti->id]);

            SendEmail::dispatch('approve-rti', $rti);
            // session()->flash('success', "Your rti is successfully sended to lawyer for further process.");
            return response(['status' => 'success', 'tab' => "thankyou-process"]);
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
                        $field_key = getFieldName($fields['dependency_date_field'][$key]);
                        $validation_string .= "|after_or_equal:" . $request[$field_key];
                    }
                }
                $slug_key = getFieldName($fields['field_lable'][$key]);
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
            foreach(json_decode($revision->details, true) ?? [] as $key => $value) {
                if(!isset($data[$key])) {
                    $data[$key] = $value;
                }
            }
            $revision->update(['customer_change_request' => json_encode($data)]);
            Notification::create(['message' => "You have received change request", 'linkable_type' => "rti-application", 'linkable_id' => $revision->application_id, 'type' => "change-request", 'from_type' => 'customer', 'from_id' => auth()->guard('customers')->id()]);

            session()->flash("success", "Change request sended to lawyer");
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
        $application->update(['process_status' => false]);
        $appeal = RtiAppeal::where(['appeal_no' => $request->appeal_no, 'application_id' => $application_id])->first();
        $applications = RtiApplication::list(false, ['application_no' => $application->application_no, 'appeal_no' => $request->appeal_no]);
        
        // dd( $appeal );
        // if(count($applications) > 0) {
            $validation = [
                'appeal_no' => "required",
                'reason' => "required",
                'received_appeal' => 'required'
    
            ];
            if($request->received_appeal) {
                $validation['document'] = 'required';
            }
            $validator = Validator::make($request->all(),  $validation);
            if ($validator->fails()) {
                return response(['errors' => $validator->errors()], 422);
            }
            $data = $request->only(['appeal_no', 'reason', 'document', 'received_appeal']);
            $data['application_id'] = $application_id;
            $appeal = RtiAppeal::where(['application_id' => $application_id, 'appeal_no' => $request->appeal_no])->first();
            if(!$appeal) {
                $appeal = RtiAppeal::create($data);
            }
           
          
            if($application->lastRevision) {
                $revision_data = [];
                if( $application->lastRevision) {

                    $service_field_data = [];
                    if(!empty($application->service_fields)) {
                        $service_field_data = json_decode($application->service_fields, true);
                        
                    }
                    $revision_data = json_decode($application->lastRevision->details, true);
                    foreach($service_field_data['field_data'] ?? [] as  $key =>  $value) {
                        $service_field_data['field_data'][$key] = $revision_data[$key];
                        $service_field_data[$key] =$revision_data[$key];
                    }
                    foreach($service_field_data?? [] as  $key =>  $value) {
                        if(isset($revision_data[$key])) {
                        $service_field_data[$key] =$revision_data[$key];

                        }
                    }
                    
                    $application = $application->toArray();
                    $remove = ['process_status', 'charges', 'id', 'created_at', 'updated_at', 'status', 'signature_image', 'signature_type', 'success_response', 'payment_status', 'payment_details', 'payment_id', 'error_response'];
                    $application = array_diff_key($application, array_flip($remove));
                    $application['first_name'] = $revision_data['first_name'];
                    $application['last_name'] = $revision_data['last_name'];
                    $application['email'] = $revision_data['email'];
                    $application['phone_number'] = $revision_data['phone_number'];
                    $application['address'] = $revision_data['address'];
                    $application['postal_code'] = $revision_data['pincode'];

                    $application['service_fields'] = json_encode($service_field_data);
                    
                }
                

            }
            else {
                $application = $application->toArray();
                $remove = ['charges', 'id', 'created_at', 'updated_at', 'status', 'signature_image', 'signature_type', 'success_response', 'payment_status', 'payment_details', 'payment_id', 'error_response'];
                $application = array_diff_key($application, array_flip($remove));
            }
            $application['payment_status'] = 'pending';
            $application['appeal_no'] = $request->appeal_no;
            $application['application_id'] = $application_id;
            $application['status'] = 1 ;

          $list_id =  RtiApplication::create($application);
       
            session()->flash('success', "Success");
            $url= route('customer.payment-rti', encryptString($list_id->id));
            // echo $list_id->id; die('hello');
            return response(['status' => 'success', 'message' =>  "Success" ,'redirect'=> $url]);
        // }
        // return response(['status' => 'error', 'message' => "First appeal already applied"]);
        // return redirect()->route('payment-rti',$list_id)->with('success', 'The record has been created successfully!');
        // 'application_id', 'appeal_no', 'reason', 'document', 'status'
    }

    public function sendReply(Request $request, $request_id) {
        $validation = [
            'reply' => "required",
            
        ];
        $validator = Validator::make($request->all(),  $validation);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $query = LawyerRtiQuery::where(['id' => $request_id])->first();
        Notification::create(['message' => "lawyer need more information", 'linkable_type' => "rti-application", 'linkable_id' => $query->application_id, 'type' => "more-info", 'from_type' => 'customer', 'from_id' => auth()->guard('customers')->id(), 'additional' => ['id' => $query->id, 'module' => "lawyer_query"]]);

        $query->update(['reply' => $request->reply, 'documents' => $request->documents, 'marked_read' => true]);
        $documents = $query->rtiApplication->documents ?? [];
        $documents = array_merge($documents, $request->documents ?? []);
        $query->rtiApplication()->update(['documents'=> $documents]);
        // session()->flash('success', "Reply is successfully sended.");
        return response(['status' => 'success', 'tab' => "thankyou-query-process"]);

    }
    public function paymentRti(Request $request, $application_id = null)
    {
        $application_id = decryptString($application_id);
        $application = RtiApplication::get($application_id);
        // echo $application->appeal_no;
        // $payment = Setting::getSettingData('first_appeal_payment');
        // print_r($payment);
        //  die;
        if($application) {

            if($application->appeal_no == 1){
            $payment = Setting::getSettingData('first_appeal_payment');
            }
            else if($application->appeal_no == 2){
            $payment = Setting::getSettingData('second_appeal_payment');
            }
            else{
            $payment = Setting::getSettingData('payment');
            }
         
           $why_choose = Section::list(true, ['status' => 1, 'type' => 'why_choose', 'order_by' => 'sequance', 'order_by_type' => 'asc', 'limit' => 3]);
           return view('frontend.profile.payment-rti', compact( 'payment','why_choose', 'application'));
        }

    }

    
}
