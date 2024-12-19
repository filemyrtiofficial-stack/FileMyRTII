<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\Models\Customer;
class AuthController extends Controller
{
    public function __construct()

    {

        $this->middleware('guest')->except('logout');

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

                Auth::login($finduser);

                return redirect('/home');

            }else{

                $newUser = Customer::create([
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id

                ]);
                Auth::login($newUser);
                print_r(json_encode($newUser));
                return redirect('/home');

            }

        } catch (Exception $e) {

            return redirect('auth/google');

        }

    }

}
