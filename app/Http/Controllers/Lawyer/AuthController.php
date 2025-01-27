<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
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
        if (Auth::guard('lawyers')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response(['status' => 'success', 'redirect' => route('lawyer.my-rti')]);
        }

        return response(['errors' => ['password' => 'The provided credentials do not match our records.']], 422);
       
    }
    public function logout(Request $request)
    {
        Auth::guard('lawyers')->logout();
        return redirect('/lawyer/login');
    }

}
