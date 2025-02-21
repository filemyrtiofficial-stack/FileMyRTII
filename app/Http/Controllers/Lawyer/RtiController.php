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
            $request->merge(['lawyer_id' => auth()->guard('lawyers')->id(), 'order_by' => 'created_at', 'order_by_type' => 'desc']);
            $list = RtiApplication::list(true, $request->all());
            $rti_count = RtiApplication::where(['lawyer_id' => auth()->guard('lawyers')->id(), 'process_status'=> true])->groupBy('status')->select('rti_applications.status', DB::raw('count(*) as total'))->get()->toArray();
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
            return view('lawyer.dashboard', compact('list', 'total_rti','lawyerdata'));
        }
        else {
            $application_nos = $application_no;
            $application_no = substr($application_no, 0, 8);
            $application_id = substr($application_nos, 8);
            // echo $application_id;die;
            $request->merge(['lawyer_id' => auth()->guard('lawyers')->id(), 'application_no' => $application_no, 'id' => $application_id]);
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
        $application_no = $application->application_no;
        $input = $request->except(['_token', 'template_id']);
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
            'courier_name' => "required",
            'courier_tracking_number' => "required",
            'courier_date' => "required|date",
            'charges' => "required|numeric",
            'address' => "required"

        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        try {
            
            $revision = RtiApplicationRevision::find($revision_id);
            if($revision) {
                $data = $request->only(['courier_name', 'courier_date', 'courier_tracking_number', 'charges', 'address']);
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
            'pio_address' => "required",
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
            'document' => "required",
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
        $request->merge(['lawyer_id' => auth()->guard('lawyers')->id(), 'order_by' => 'created_at', 'order_by_type' => 'desc']);
        $list = RtiApplication::list(true, $request->all()); 
        $html  =  view('lawyer.listing', compact('list'))->render();
        $list = $list->toArray();
        return response(['data' =>  $html, 'pages' => ['next_page' =>  $list['current_page']+1, 'last_page' => $list['last_page']]]);
    }

}
