<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AuthRepository;
use App\Interfaces\AuthInterface;
use Validator;
use App\Http\Resources\UserProfileResource;
class AuthController extends Controller
{
    private AuthRepository $authRepository;

    public function __construct(AuthInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * send otp on mobile number
     */
    public function sendOtp(Request $request){
        $validator = Validator::make($request->all(), [
            'mobile' => "required|digits:10"
        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->authRepository->sendOtp($request);
        return $data;

    }

    /**
     * verify otp
     */
    public function verifyOtp(Request $request){
        $validator = Validator::make($request->all(), [
         'mobile' => "required|digits:10",
         'otp' => "required|digits:4",
         'key' => "required"

        ]);
        if($validator->fails()) {
         return response(['errors' => $validator->errors()], 422);
        }
         $data = $this->authRepository->verifyOtp($request);
         return $data;
 
    }

    public function myProfile() {
        $data = new UserProfileResource(auth('api')->user());
        return response([
            'data' => $data
        ]);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => "required",
            'age' => "required|numeric",
            'dob' => "required|date",
            'height' => "required|numeric",
            'weight' => "required|numeric",
            'address' => "required",
            'emergency_name' => "required",
            'emergency_mobile' => "required|numeric",
            'relation' => "required",

        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        try {
            $data = $this->authRepository->register($request);
            return $data;
        } catch (\Throwable $th) {
            return response(['error' => $th->getMessage()], 500);
        }
    }


}