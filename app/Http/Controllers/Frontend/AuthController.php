<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\Models\Customer;
use Validator;
use Mail;
use App\Mail\ResetPassword;
use App\Jobs\SendEmail;
use Carbon\Carbon;
use session;
use Hash;
class AuthController extends Controller
{
    public function __construct()

    {

        // $this->middleware('guest')->except('logout');

    }

    public function redirectToGoogle()

    {

        return Socialite::driver('google')->redirect();

    }

    public function handleGoogleCallback()

    {

        try {

            $user = Socialite::driver('google')->user();
            $finduser = Customer::where('google_id', $user->id)->first();

            if($finduser){

                Auth::guard('customers')->login($finduser);

                return redirect('/my-rti');

            }else{

                $newUser = Customer::create([
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id

                ]);
                Auth::guard('customers')->login($newUser);
                return redirect('/my-rti');

            }

        } catch (Exception $e) {

            return redirect('auth/google');

        }

    }

    public function customerLogin(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => "required|email",
            'password' => "required",

        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        if (Auth::guard('customers')->attempt(['email' => $request->email, 'password' => $request->password, 'google_id' => NULL])) {
            return response(['status' => 'success', 'redirect' => route('my-rti')]);
        }

        return response(['errors' => ['password' => 'The provided credentials do not match our records.']], 422);
       
    }

    public function logout(Request $request)
    {
        Auth::guard('customers')->logout();
        return redirect('/');
    }

    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => "required|email|unique:customers,email",
            'password' => 'required|min:6',

            'name' => "required",
            'confirm_password' => "required||same:password"


        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $newUser = Customer::create([
            'first_name' => $request->name,
            'email' => $request->email,
            'password' => $request->password

        ]);
        if($newUser) {
            Auth::guard('customers')->login($newUser);
            return response(['status' => 'success', 'redirect' => route('my-rti')]);

        }

        return response(['errors' => ['password' => 'Something went wrong']], 422);
       
    }

    public function forgotPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => "required|email",
        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $customer = Customer::where(['email' => $request->email])->first();
        if(!$customer) {
            return response(['errors' => ['email' => 'Please enter registered email id']], 422);
        }
        SendEmail::dispatch('reset-password', $customer);
        // Mail::to( $request->email)->send(new ResetPassword($customer));
        return response(['status' => 'success', 'message' => "Password reset mail has been to send to you register mail"]);


        
    }

    public function resetPassword($email, $date) {
        try {
            $id = decryptString($email);
            $customer = Customer::findOrFail($id);
            if(!$customer) {
                abort(404);
            }
            $formatdate = decryptString($date);
            $date = decryptString($date);
            $date = Carbon::parse($date)->addMinutes(10);
            $now = Carbon::now();
            if($now < $date) {
                return view('frontend.reset-password', compact('customer'));
            }
            abort(404);

        } catch (\Throwable $th) {
            print_r($th->getMessage());
            abort(404);
        }

        
    }

    public function updatePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'confirm_password' => "required||same:password"
        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $id = decryptString($request->key);
        $customer = Customer::findOrFail($id);
        if(!$customer) {
            return response(['errors' => ['confirm_password' => "Something went wrong"]], 422);
        }

        $customer->password = $request->password;
        $customer->save();
        return response(['status' => "success"]);


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
        $customer = auth()->guard('customers')->user();

        if(!$customer) {
            return response(['errors' => ['confirm_password' => "Something went wrong"]], 422);
        }
        elseif( ! Hash::check($request->current_password,  $customer->password ) )
        {
            return response(['errors' => ['current_password' => "Current password is invalid"]], 422);
        }

        $customer->password = $request->password;
        $customer->save();
        return response(['status' => "success", "message" => "Password is successfully updated"]);
    }

}
