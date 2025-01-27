<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RtiApplication;
use App\Jobs\SendEmail;
use App\Models\RtiApplicationRevision;
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
                $fields = [];
                if($data->service && !empty($data->service->fields)) {
                    $fields = json_decode($data->service->fields, true);
                }
            }
            else {
                abort(404);
            }
            return view('lawyer.view-my-rti', compact('data', 'fields'));
        }
    }

    public function draftApplication($application_no) {
        $data = RtiApplication::where(['application_no' => $application_no])->first();
	    return view('frontend.profile.rti-file', compact('data'));
    }

    public function processRTIApplication(Request $request, $application_no) {
        $application = RtiApplication::where(['application_no' => $application_no])->first();

        $input = $request->except(['_token', 'template_id']);
        RtiApplicationRevision::create([
            'application_id' =>  $application->id, 
            'template_id' => $request->template_id,
            'details' => json_encode($input), 

            // 'template', 
            // 'status', 
            // 'signature', 
            // 'customer_change_request'
        ]);
        return response(['status' => 'success', 'Message' => "Applicatio  Number : ".$application_no." is sent to user for approval."]);

    }

}
