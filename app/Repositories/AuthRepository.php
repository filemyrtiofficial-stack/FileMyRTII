<?php
namespace App\Repositories;
use App\Interfaces\AuthInterface;
use App\Models\MobileOtp;
use App\Models\AuthUser;
use App\Models\FamilyMember;
use Carbon\Carbon;
use App\Models\MemberMedicalHistory;
class AuthRepository implements AuthInterface {

    public function sendOtp($data) {
        $mobile_otp = MobileOtp::where(['mobile' => $data['mobile']])->first();
        $otp = rand(1000, 9999);
        $otp = 1234;
        if($mobile_otp) {
            $mobile_otp->update(['otp' => $otp, 'expiry' => Carbon::now()->addMinutes(5)]);
        }
        else {
            $mobile_otp = MobileOtp::create(['mobile' => $data['mobile'], 'otp' => $otp, 'expiry' => Carbon::now()->addMinutes(5)]);
        }
        return response(['message' => 'otp is successfully send', 'key' => base64_encode($mobile_otp->id)]);
    }


    public function verifyOtp($data) {
        $key = base64_decode($data['key']);
        $mobile_otp = MobileOtp::where(['mobile' => $data['mobile'], 'otp' => $data['otp'], 'id' => $key])->first();
        if($mobile_otp) {
            if(Carbon::now() < $mobile_otp->expiry) {
                $user = AuthUser::where(['phone_no' => $data['mobile']])->first();
                if(!$user) {
                    $user = AuthUser::create(['phone_no' => $data['mobile']]);
                }
                $user->password = bcrypt($data['otp']);
                $user->save();
                
                if (!$token = auth()->guard('api')->attempt(['phone_no' => $data['mobile'], 'password' => $data['otp']])) {
                    return response(['message' => 'invalid user']);

                }
                $data = $this->createNewToken($token);
                $mobile_otp->delete();
                return response(['data' => $data]);

            }
        }
        return response(['message' => 'otp is incorrect']);
    }


    protected function createNewToken($token)
    {
        // $ttl_in_minutes = 60*24*100;
        // auth()->factory()->setTTL($ttl_in_minutes);
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL()
        ];
        // $user = auth()->guard('api')->user();
        // return [
        //     'response_message' => 'User successfully Logged in.',
        //     'response_code' => 200,
        //     'access_token' => $token,
        //     'token_type' => 'bearer',
        //     // 'expires_in' => auth()->factory()->getTTL(),
        //     'expires_in' => config('jwt.ttl') * 60,
        //     'user' => $user,
        // ];
    }

    public function register($data) {
        $user = auth('api')->user();
        if(isset($data['email'])) {
            $user->update(['email' => $data['email'] ?? '', 'name' => $data['name'] ?? '']);
        }
        $user_data = [
                'user_id' => $user->id, 
                'name' => $data['name'], 
                'age' => $data['age'], 
                'dob' => $data['dob'], 
                'address' => $data['address'], 
                'emergency_name' => $data['emergency_name'], 
                'emergency_mobile' => $data['emergency_mobile'], 
                'relation' => 'self',
                'member_relation' => $data['relation'],
                'marital_status' => $data['marital_status'] ?? '',
            ];

        $image = uploadFile($request, 'profile', 'profile');
        if(!empty($image)) {
            $user_data['profile'] = $image;
        }

        $member = FamilyMember::where(['user_id' => $user->id, 'relation' => 'self'])->first();
        if($member) {
            $member->update($user_data);
            
        }
        else {
            $member = FamilyMember::create($user_data);
        }
        $history = MemberMedicalHistory::where(['member_id' => $member->id])->first();
        $history_data = [
            'member_id' => $member->id, 
            'height' => $data['height'], 
            'weight' => $data['weight'],
            'blood_group' => $data['blood_group'] ?? '',
        ];

        if($history) {
            $history->update($history_data);
        }
        else {
            MemberMedicalHistory::create($history_data);
        }
        

        return json_encode(['message' => 'Thank you for register with us']);
        
    }

    private function uploadFile($request) {
        $file_name = 'profile';
        if($request->hasFile($file_name)){
            $filenameWithExt = $request->file($file_name)->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file($file_name)->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file($file_name)->storeAs('public/profile',$fileNameToStore);
            return $fileNameToStore;
        }
        return "";
    }


}