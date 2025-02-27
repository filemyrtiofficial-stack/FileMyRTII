<?php

namespace App\Repositories;

use App\Interfaces\LawyerInterface;
use Carbon\Carbon;
use App\Models\Lawyer;
use App\Models\LawyerProfile;
use App\Models\SlugMaster;
use App\Jobs\SendEmail;
use Session;
use Exception;
use App\Mail\LawyerRegister;
use Mail;

class LawyerRepository implements LawyerInterface
{

    public function store($request)
    {
        
        $lawyer = Lawyer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'email' => $request->email,
            'status' => $request->status,
            'qualification' => $request->qualification,
            'about' => $request->about,
            'image' => uploadFile($request, 'image', 'lawyer'),
            'experience' => $request->experience,
            'address' => $request->address,
            'password' => bcrypt($request->password)

        ]);
        $lastInsertedId = $lawyer->id;
       
        $LawyerProfile = LawyerProfile::create([
            'lawyer_id' => $lastInsertedId,
            'father_spouse_name' => $request->father_spouse_name,
            'mother_name' => $request->mother_name,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'alternative_phone_no' => $request->alternative_phone_no,
            'personal_email_id' => $request->personal_email_id,
            'date_of_joining' => $request->date_of_joining,
            'package_details' => $request->package_details,
            'bank_account_holder' => $request->bank_account_holder,
            'bank_name' => $request->bank_name,
            'bank_address' => $request->bank_address,
            'bank_account_number' => $request->bank_account_number,
            'bank_ifsc_code' => $request->bank_ifsc_code,
            'attachments' =>['document_name' => $request->document_name, 'images' => $request->document_name_image],
            'blood_group' => $request->blood_group,
            'exit_date' => $request->exit_date,
            'remarks' => $request->remarks
        ]);

        $employee_id = "EMP-0000".$lastInsertedId;
        Lawyer::where('id', $lastInsertedId)->update(['employee_id'=>$employee_id]);

         $laywerData = Lawyer::get($lastInsertedId);
        //  $laywerData['pswd'] = $request->password;
         $data =[
            'email' => $request->personal_email_id,
             'password' => $request->password,
             'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_email' => $request->email,
            'employee_id'=>$employee_id
        ];
       
         $email = new LawyerRegister($data);
        //  Mail::to($request->personal_email_id)->send($email);
        SendEmail::dispatch('lawyer-resgister', $data);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added"]);
    }

    public function update($request, $id)
    {
      
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'email' => $request->email,
            'status' => $request->status,
            'qualification' => $request->qualification,
            'about' => $request->about,
            'experience' => $request->experience,
            'address' => $request->address,       
            'employee_id' =>$id
        ];

        if(!empty($request->password)){
        $data['password'] =bcrypt($request->password);
        }

        $LawyerProfileData =[
            'father_spouse_name' => $request->father_spouse_name,
            'mother_name' => $request->mother_name,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'alternative_phone_no' => $request->alternative_phone_no,
            'personal_email_id' => $request->personal_email_id,
            'date_of_joining' => $request->date_of_joining,
            'package_details' => $request->package_details,
            'bank_account_holder' => $request->bank_account_holder,
            'bank_name' => $request->bank_name,
            'bank_address' => $request->bank_address,
            'bank_account_number' => $request->bank_account_number,
            'bank_ifsc_code' => $request->bank_ifsc_code,
            'attachments' =>['document_name' => $request->document_name, 'images' => $request->document_name_image],
            'blood_group' => $request->blood_group,
            'exit_date' => $request->exit_date,
            'remarks' => $request->remarks
        ];

        $image = uploadFile($request, 'image', 'lawyer');
        if (!empty($image)) {
            $data['image'] = $image;
        }
        Lawyer::where('id', $id)->update($data);
        LawyerProfile::where('lawyer_id', $id)->update($LawyerProfileData);
        
        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }




    public function delete($id)
    {
        $data = Lawyer::where(['id' => $id])->first();
        if ($data) {

            $data->delete();
        } else {
            throw new Exception("Invalid Lawyer type");
        }
    }
}
