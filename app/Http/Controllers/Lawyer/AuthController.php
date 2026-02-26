<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Hash;
use Session;
class AuthController extends Controller
{
    public function login() {
        return view('lawyer.auth.login');
    }
    public function signin(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => "required|email",
            'password' => "required",

        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        if (Auth::guard('lawyers')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
             $redirect_url = route('lawyer.my-rti');
            if(Session::has('lawyer_request_url') && !empty(Session::get('lawyer_request_url'))) {
                $redirect_url = Session::get('lawyer_request_url');
                  Session::forget('lawyer_request_url');
            }
            
            return response(['status' => 'success', 'redirect' =>  $redirect_url]);
        }

        return response(['errors' => ['password' => 'The provided credentials do not match our records.']], 422);

    }
    public function logout(Request $request)
    {
        Auth::guard('lawyers')->logout();
        return redirect('/lawyer/login');
    }

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|min:6',
            'password' => 'required|min:6',
            'confirm_password' => "required||same:password"
        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $customer = auth()->guard('lawyers')->user();

        if(!$customer) {
            return response(['errors' => ['confirm_password' => "Something went wrong"]], 422);
        }
        elseif( ! Hash::check($request->current_password,  $customer->password ) )
        {
            return response(['errors' => ['current_password' => "Current password is invalid"]], 422);
        }

        $customer->password = bcrypt($request->password);
        $customer->save();
        return response(['status' => "success", "message" => "Password is successfully updated"]);
    }

}
