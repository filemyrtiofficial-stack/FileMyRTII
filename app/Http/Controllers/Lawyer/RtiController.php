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

class RtiController extends Controller
{
    public function myRti(Request $request, $application_no = null) {
        if($application_no == null) {

            $request->merge(['lawyer_id' => auth()->guard('lawyers')->id(), 'order_by' => 'created_at', 'order_by_type' => 'desc']);
            $list = RtiApplication::list(true, $request->all());
            return view('lawyer.dashboard', compact('list'));
        }
        else {
            $request->merge(['lawyer_id' => auth()->guard('lawyers')->id(), 'application_no' => $application_no]);
            // $data = RtiApplication::list(false, $request->all());
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
                if( $data->lastRevision) {
                    $revision_data = json_decode($data->lastRevision->details, true);
                }
                // print_r(($data->service_fields));
                // foreach($service_field_data['field_data'] ?? [] as $key => $value) {
                //     print_r($key);
                // }
                // print_r(json_encode($revision_data));
                // echo '<br><br>';
                // print_r(($service_field_data['field_data'] ?? []));die;
            }
            else {
                abort(404);
            }
            return view('lawyer.view-my-rti', compact('data', 'service_fields', 'revision_data'));
        }
    }

    public function draftApplication($application_no) {


        
        $data = RtiApplication::where(['application_no' => $application_no])->first();
        $revision = $data->lastRevision;
        // print_r(json_encode($revision));
        $field_data = json_decode($revision->details, true);
        $html = $revision->serviceTemplate->template;

        // print_r( $data->signature_image);die;
        foreach($field_data as $key => $value) {
            $html = str_replace("[".$key."]", $value, $html);
        }
        $signature = "";

        if($data->signature_type != "manual" && !empty($data->signature_image)) {

            
                    $signature = public_path($data->signature_image);
                    $signature = "data:image/png;base64,".base64_encode(file_get_contents($signature));
        }

//         $html = view('frontend.profile.rti-file-pdf', compact('data', 'field_data', 'revision', 'html', 'signature'))->render();
//         	header("Content-type: application/vnd.ms-word");
//   header("Content-Disposition: attachment;Filename=document_name.doc");    
//   echo $html;
//   die;


        // 
	    // return view('frontend.profile.rti-file-pdf', compact('data', 'field_data', 'revision', 'html', 'signature'));

        $pdf = PDF::loadView('frontend.profile.rti-file-pdf', compact('data', 'field_data', 'revision', 'html', 'signature'));
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

        return response(['status' => 'success', 'message' => "Application  Number : ".$application_no." is sent to user for approval.", 'clean' => false]);

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
                $data['documents'] = [$request->documents];
                $data['application_id'] = $revision->application_id;
                $data['revision_id'] = $revision->id;
                RtiApplicationTracking::create($data);
                $revision->rtiApplication()->update(['status' => 3]);
                ApplicationStatus::create(['status' => "filed", "date" => Carbon::now(), 'time' => Carbon::now(), 'application_id' => $revision->application_id]);

            }
            return response(['status' => 'success', 'message' => "Tracking details are successfully added"]);
                
                
        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);

        }
    }

    public function sendQuery(Request $request, $application_id) {
        $validator = Validator::make($request->all(), [
            'message' => "required",
        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        try {
            
            $data['application_id'] = $application_id;
            $data['message'] = $request->message;
            $data['from_user'] = "lawyer";
            $data['to_user'] = "customer";

            LawyerRtiQuery::create($data);
            Notification::create(['message' => "lawyer need more information", 'linkable_type' => "rti-application", 'linkable_id' => $application_id, 'type' => "more-info"]);
            $application = RtiApplication::where(['id' => $application_id])->first();
            SendEmail::dispatch('filed-rti', $application);

            return response(['status' => 'success', 'message' => "Requested Info is sended to user."]);
                
                
        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);

        }
    }

}
