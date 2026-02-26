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
use App\Models\RtiApplicationLawyer;
use App\Models\RefundRequest;
class CustomerController extends Controller
{
    public function myRti(Request $request, $application_no = null, $tab = "application-status")
    {
       
        $payment = Setting::getSettingData('payment');
        if ($application_no == null) {

            $request->merge(['user_id' => auth()->guard('customers')->id(), 'order_by' => 'created_at', 'order_by_type' => 'desc', 'process_status' => 1]);
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
                 if((!$data->lastRtiQuery || ($data->lastRtiQuery && $data->lastRtiQuery->marked_read != 0)) && $tab == "requested-info") {
                   return redirect()->to('/my-rtis/'.$application_no);
        
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
        $signature = "";
        if($request->signature_type == 'manual') {
            $validator = Validator::make($request->all(),  [
                'signature' => 'required|min:1|max:25'
            ]);
            $signature = $request->signature;
        }
        else {
            $validator = Validator::make($request->all(),  [
                'signature_file' => 'required'
            ]);
            $signature = $request->signature_file;

        }

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = RtiApplication::rtiNumberDetails(['application_no' => $application_no]);
        if(count($data) > 0) {
            $data = $data[count($data)-1] ?? [];
            $last_revision = RtiApplicationRevision::find($request->last_revision_id);
            $details = json_decode($last_revision->details, true);
            // return response(['status' => 'success', 'tab' => RtiApplication::draftedApplication($rti)], 500);
            $data->update([
                'signature_type' => $request->signature_type, 
                'signature_image' =>   $signature, 
                'status' => 2,
                'first_name' => $details['first_name'] ?? $data->first_name,
                'last_name' => $details['last_name'] ?? $data->last_name,
                'email' => $details['email'] ?? $data->email,
                'phone_number' => $details['phone_number'] ?? $data->phone_number,
                'address' => $details['address'] ?? $data->address,
                'city' => $details['city'] ?? $data->city,
                'state' => $details['state'] ?? $data->state,
                'postal_code' => $details['pincode'] ?? $data->postal_code,
            ]);
            //$data->update(['signature_type' => $request->signature_type, 'signature_image' =>   $signature, 'status' => 2]);
            $rti = RtiApplication::get($data['id']);
           
            
            $rti->update(['signed_rti' => RtiApplication::draftedApplication($rti)]);
            ApplicationStatus::create(['status' => "approved", "date" => Carbon::now(), 'time' => Carbon::now(), 'application_id' => $rti->id]);

            SendEmail::dispatch('approve-rti', $rti);
            // Notification::create(['message' => "RTI have been appoved", 'linkable_type' => "rti-application", 'linkable_id' => $rti->id, 'type' => "approved-rti", 'to_type' => 'lawyer', 'to_id' => $rti['lawyer_id'],  'from_type' => 'customer', 'from_id' => auth()->guard('customers')->id()]);

            $html = view('email.lawyer.approve_rti',['data' => $rti])->render();
            Notification::sendNotification('approve-rti', $rti, ['mail' => $html ]);

            // session()->flash('success', "Your rti is successfully sended to lawyer for further process.");
            return response(['status' => 'success', 'tab' => "thankyou-process"]);
        }
    }
    public function sendChangeRequest(Request $request, $request_id)
    {
        $revision = RtiApplicationRevision::find($request_id);
        $validation = [

            'first_name' => "required|min:1|max:50|regex:/^[a-zA-Z\s.]+$/u",
            'last_name' => "required|min:1|max:50|regex:/^[a-zA-Z\s.]+$/u",
            'email' => "required|email|regex:/(.+)@(.+)\.(.+)/i|max:75",
            'phone_number' => "required|digits:10|regex:/^[6789]\d{9}$/",
            'address' => "required|min:3|max:255",
            'city' => "required|min:3|max:50",
            'state' => "required|min:3|max:50",
            'pincode' => "required|digits:6",

        ];
        $filelist = [];

        $fields = isset($revision->rtiApplication->service->fields,) ? json_decode($revision->rtiApplication->service->fields, true) : [];
        foreach ($fields['field_type'] ?? [] as $key => $value) {
            if( isset($fields['form_field_type'][$key]) && $fields['form_field_type'][$key] != "lawyer" ) {
                if( isset($fields['form_field_type'][$key]) && $fields['form_field_type'][$key] != "customer" ) {
                    $slug_key = getFieldName($fields['field_lable'][$key]);
                    $validation_string = '';
                    if (isset($fields['is_required']) && isset($fields['is_required'][$key]) && $fields['is_required'][$key] == 'yes' && $value != 'file') {
                        $validation_string = 'required';
                    }
    
                    if (!isset($fields['is_required']) || ( isset($fields['is_required'][$key]) && $fields['is_required'][$key] == 'no')) {
                             $validation_string = 'nullable';
                        }
                    // if($value == "input") {
                    //     $validation_string .= '|max:75';
                    // }
                    // if($value == "textarea") {
                    //     $validation_string .= '|max:200';
                    // }
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
                   
                    if(isset($fields['validations'][$key]) && !empty($fields['validations'][$key])) {
                        $validation_string .= "|".$fields['validations'][$key];
                    }
                     if($value == "textarea" && !str_contains($validation_string, 'max:')) {
                        $validation_string .= '|max:200';
                    }
                     $validation_string = trim($validation_string, "|");
                       $validation_string = str_replace("current_year",Carbon::now()->format('Y'),$validation_string);
    
    
    
                    if($validation_string != '') {
                        $validation[getFieldName($fields['field_lable'][$key])] =  $validation_string;
    
                    }
                    if($value == 'file') {
                        array_push( $filelist , $slug_key);
    
                        $field_data[$slug_key] = ['lable' => $fields['field_lable'][$key], 'type' => $fields['field_type'][$key], 'value' => null];
    
                    }
                    else {
    
                        $field_data[$slug_key] = ['lable' => $fields['field_lable'][$key], 'type' => $fields['field_type'][$key], 'value' => $request[$slug_key]];
                    }
                }

            }
        }

        if(isset($request->rti_query)) {
            $validation['rti_query'] = 'required|max:1000';

            if(strtolower($request->pio_addr) == 'yes') {
                $validation['pio_address'] = 'required|max:500';
            }

        }



        $validator = Validator::make($request->all(),  $validation, [
            'phone_number.digits' => "Please enter a valid 10-digit phone number.",
            'phone_number.regex' => "Phone number should be started with 6, 7, 8 and 9"
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        if ($revision) {
            $data = $request->except(['_token']);

            // foreach(json_decode($revision->details, true) ?? [] as $key => $value) {
            //     if(!isset($data[$key])) {
            //         $data[$key] = $value;
            //     }
            // }
            
            $temp_data = $data;
            foreach(json_decode($revision->details, true) ?? [] as $key => $value) {
                if(!isset($temp_data[$key])) {
                    if(empty($temp_data[$key])) {
                        $temp_data[$key] = $temp_data[$key] ?? $value;
                    }
                    else {

                        $temp_data[$key] = $value;
                    }
                }
            }
            foreach($data as $key => $value) {
                if(isset($temp_data[$key])) {
                    $temp_data[$key]  = $value;
                }
            }
            $data = $temp_data;
            foreach($filelist as $list) {
                $slug = $list."_file";
                $file_name = $slug  ;

                $file =  uploadFile($request, $slug, 'page_images');
                if(empty($file)) {
                    $file = $data[$list];
                }
                $field_data[$slug_key]['value'] = $file;
                $data[$list] = $file;
                unset($data[$slug]);
            }
            $revision->update(['customer_change_request' => json_encode($data)]);
            // Notification::create(['message' => "You have received change request", 'linkable_type' => "rti-application", 'linkable_id' => $revision->application_id,'to_type' => 'lawyer', 'to_id' => $revision->rtiApplication->lawyer_id, 'type' => "change-request", 'from_type' => 'customer', 'from_id' => auth()->guard('customers')->id()]);
            SendEmail::dispatch('edit-request', $revision);
            $html = view('email.lawyer.edit-request',['data' => $revision])->render();
            Notification::sendNotification('edit-request', $revision->rtiApplication, ['mail' => $html ]);


            session()->flash("success", "Change request sended to lawyer");
            return response(['status' => 'success']);
        }
    }

    public function customerRtiDelete(Request $request, $application_no = null)
    {

        $id =  $request->id;
        $model = RtiApplication::find($id);
        if(  $model->appeal_no == 1) {
              
               $parent = RtiApplication::find($model->application_id);
               $parent->update(['process_status' => 1]);
               
        }
        elseif(  $model->appeal_no == 2) {
              
               $parent = RtiApplication::where(['application_no' => $model->application_no, 'appeal_no' => 1])->first();
               $parent->update(['process_status' => 1]);
               
        }
        
        $model->delete();
        // Redirect to another page with a success message
        return redirect()->route('my-rti')->with('success', 'The record has been created successfully!');
    }

    public function customerpayAction(Request $request)
    {
        $rti = RtiApplication::where(['application_no' => $request->application_no, 'appeal_no' => $request->appeal_no])->first();
        if($rti->payment_status  == 'paid') {
            return response(['errors'=> ['error' => 'payment is already done']], 422);
        }
        $service_fields = json_decode($rti->service_fields, true);
        // $documents = json_decode($rti->documents, true);
        $documents = $rti->documents;
        if(!empty($request->documents) && !empty($rti->documents)) {

            $documents = array_merge( $documents, $request->documents);
        }
        elseif(empty($request->documents) && !empty($rti->documents)) {
            $documents = $rti->documents;
        }
        elseif(!empty($request->documents) && empty($rti->documents)) {
            $documents = $request->documents;
        }
        $service_fields['user_document'] =  $documents; //uploadFile($request, 'file', 'user_files');
          $gst = getGST($request->charges);
            $final_price = $gst + $request->charges;
        // print_r( $request->documents); die();
        $rti->update(['charges' => $request->charges,  'gst' => $gst, 'final_price' => $final_price,'service_fields' => json_encode($service_fields), 'documents' => $documents]);
        return response(['step' => 4, 'rti' => $rti, 'service_fields' => $service_fields]);
    }

    public function rtiAppeal(Request $request, $application_id) {


        $application = RtiApplication::find($application_id);
        $application->update(['process_status' => false]);
        $appeal = RtiAppeal::where(['appeal_no' => $request->appeal_no, 'application_id' => $application_id])->first();
        $list_id = RtiApplication::where(['application_no' => $application->application_no, 'appeal_no' => $request->appeal_no])->first();

        // dd( $appeal );
        // if(count($applications) > 0) {
            $validation = [
                'appeal_no' => "required",
                'reason' => "required|max:255",
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
                        if(isset($revision_data[$key])) {
                            
                            $service_field_data['field_data'][$key] = $revision_data[$key];
                            $service_field_data[$key] =$revision_data[$key];
                        }
                    }
                    foreach($service_field_data?? [] as  $key =>  $value) {
                        if(isset($revision_data[$key])) {
                        $service_field_data[$key] =$revision_data[$key];

                        }
                    }
                    foreach($revision_data  as $key => $value) {
                        if(!isset($service_field_data['field_data'][$key])) {
                            $service_field_data['field_data'][$key] = $value;
                        }
                        if(!isset($service_field_data[$key])) {
                            $service_field_data[$key] = $value;
                        }
                    }

                    // return response(['data' => $service_field_data], 500);
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
            // $application['lawyer_id'] = null;
            $application['payment_status'] = 'pending';
            $application['appeal_no'] = $request->appeal_no;
            $application['application_id'] = $application_id;
            $application['status'] = 1 ;
            $application['pio_expected_date'] = null;
            $application['final_rti_document'] = null;
             $application['signature_type'] = null;
              $application['signature_image'] = null;
              $application['signed_rti'] = null;

            // return response(['data' =>  $application], 500);
            $application['rti_appeal_id'] = $appeal->id;
            if(!$list_id) {
                $list_id =  RtiApplication::create($application);
                RtiApplicationLawyer::create(['application_id' => $list_id->id, 'lawyer_id' => $application['lawyer_id']]);
            }
            else {
                $list_id->update($application);
            }

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
            'reply' => "required|max:1500",

        ];
        $validator = Validator::make($request->all(),  $validation);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $query = LawyerRtiQuery::where(['id' => $request_id])->first();
        // Notification::create(['message' => "More Information Received", 'linkable_type' => "rti-application", 'linkable_id' => $query->application_id, 'type' => "more-info-sended", 'to_type' => 'lawyer', 'to_id' => $query->rtiApplication->lawyer_id, 'from_type' => 'customer', 'from_id' => auth()->guard('customers')->id(), 'additional' => ['id' => $query->id, 'module' => "lawyer_query"]]);

        $query->update(['reply' => $request->reply, 'documents' => $request->documents, 'marked_read' => true]);
        $documents = $query->rtiApplication->documents ?? [];
        $documents = array_merge($documents, $request->documents ?? []);
        $query->rtiApplication()->update(['documents'=> $documents]);
        $rtiApplication = $query->rtiApplication;
    
        SendEmail::dispatch('send-reply',  $query);
          $html = view('email.lawyer.more-info-required',['data' => $query])->render();
        Notification::sendNotification('send-reply', $rtiApplication, ['mail' => $html ]);

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


    public function getNotification($id) {
        $notification = Notification::find($id);
        $data = RtiApplication::find($notification->linkable_id);
        $html = "";
    //    return $notification;
      
        if($notification->type == 'more-info-sended') {
            $additional = $notification->additional;
            $query = LawyerRtiQuery::find($additional['id']);
            $html = view('notification.more-info', compact('data', 'query'))->render();

        }
        else {
            $additional = $notification->additional;
            $html = $additional['mail'] ?? '';
            // return $html;
            return view('notification.mail-data', compact('html', 'notification'));

        }
        return response(['data' => $html]);

    }
     public function customerRtiRefundRequest(Request $request, $id) {
        $rti = RtiApplication::where(['id' => $id])->first();
        if($rti) {
            if(getTotalHours($rti) > 72) {
               
                session()->flash('error', "Refund time is expired!");
                $url= route('my-rti');
                return response(['status' => 'success','redirect'=> $url]);
            }
             if($rti->refundRequest && $rti->refundRequest->status == 'pending') {
                session()->flash('error', "Refund request already sended!");
                $url= route('my-rti');
                return response(['status' => 'success','redirect'=> $url]);
            }
            RefundRequest::create(['rti_application_id' => $id, 'reason' => $request->reason]);
            // Redirect to another page with a success message
            session()->flash('success', "Your refund request successfully send!");
            $url= route('my-rti');
            return response(['status' => 'success','redirect'=> $url]);

        }
        session()->flash('error', "Something went wrong!");
        $url= route('my-rti');
        return response(['status' => 'success','redirect'=> $url]);
      

    }


}
