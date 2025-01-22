<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RtiApplication;
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
            }
            else {
                abort(404);
            }
            return view('frontend.profile.view-my-rti', compact('data'));
        }
    }
}
