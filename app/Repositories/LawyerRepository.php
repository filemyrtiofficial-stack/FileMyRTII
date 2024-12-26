<?php
namespace App\Repositories;
use App\Interfaces\LawyerInterface;
use Carbon\Carbon;
use App\Models\Lawyer;
use App\Models\SlugMaster;

use Session;
use Exception;
class LawyerRepository implements LawyerInterface {

    public function store($request) {
        $lawyer = Lawyer::create(['first_name' => $request['first_name'], 'last_name' => $request['last_name'], 'dob' => $request['dob'], 'phone' => $request['phone'], 'email' => $request['email'], 'status' => $request->status, 'qualification' => $request['qualification'], 'about' => $request->about, 'image' => uploadFile($request, 'profile_image', 'profile_image'), 'experience' => $request['experience'], 'address' => $request->address]);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added"]);
    }
    
    public function update($request, $id) {
        $data = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'dob' => $request['dob'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'status' => $request->status,
            'qualification' => $request['qualification'],
            'about' => $request->about,
            'experience' => $request['experience'],
            'address' => $request->address
        ];
      
        $image = uploadFile($request, 'image', 'image');
        if(!empty($image)) {
            $data['image'] = $image;
        }
        Lawyer::where('id', $id)->update($data);

        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    

   

    public function delete($id) {
        $data = Lawyer::where(['id' => $id])->first();
        if($data) {
           
            $data->delete();
        }
        else {
            throw new Exception("Invalid Lawyer type");

        }
    }

}