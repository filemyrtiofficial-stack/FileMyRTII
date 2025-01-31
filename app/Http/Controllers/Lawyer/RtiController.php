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
            $data = RtiApplication::list(false, $request->all());
            if(count($data) > 0) {
                $data = $data[0] ?? [];
                $service_fields = [];
                if($data->service && !empty($data->service->fields)) {
                    $service_fields = json_decode($data->service->fields, true);
                }
                $revision_data = [];
                if( $data->lastRevision) {
                    $revision_data = json_decode($data->lastRevision->details, true);
                }
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

        if(!empty($data->signature_image)) {

            
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
        return "tets";
    }

    public function processRTIApplication(Request $request, $application_no) {
        $application = RtiApplication::where(['application_no' => $application_no])->first();

        $input = $request->except(['_token', 'template_id']);
        RtiApplicationRevision::create([
            'application_id' =>  $application->id, 
            'template_id' => $request->template_id,
            'details' => json_encode($input), 
        ]);
        $application->url = route('my-rti', $application_no);
        SendEmail::dispatch('draft-rti', $application);

        return response(['status' => 'success', 'message' => "Application  Number : ".$application_no." is sent to user for approval."]);

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
            }
            return response(['status' => 'success', 'message' => "Tracking details are successfully added"]);
                
                
        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);

        }
    }

}
