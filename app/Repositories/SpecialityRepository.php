<?php
namespace App\Repositories;
use App\Interfaces\SpecialityInterface;
use Carbon\Carbon;
use App\Models\MemberMedicalHistory;
use App\Models\Specialization;
use Session;
use Exception;
class SpecialityRepository implements SpecialityInterface {

    public function store($request) {
        Specialization::create(['name' => $request['name'], 'icon' => uploadFile($request, 'icon', 'icon'), 'status' => $request->status]);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added"]);
    }
    
    public function update($request, $id) {
        $data = [
            'name' => $request['name'],
            'status' => $request->status
        ];
        $image = uploadFile($request, 'icon', 'icon');
        if(!empty($image)) {
            $data['icon'] = $image;
        }
        Specialization::where('id', $id)->update($data);
        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    

   

    public function delete($id) {
        $data = Specialization::where(['id' => $id])->first();
        if($data) {
            $data->delete();
        }
        else {
            throw new Exception("Invalid speciality");

        }
    }

}