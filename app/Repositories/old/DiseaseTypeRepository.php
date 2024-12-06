<?php
namespace App\Repositories;
use App\Interfaces\DiseaseTypeInterface;
use Carbon\Carbon;
use App\Models\MemberMedicalHistory;
use App\Models\DiseaseType;
use Session;
use Exception;
class DiseaseTypeRepository implements DiseaseTypeInterface {

    public function store($request) {
        DiseaseType::create(['name' => $request['name'], 'icon' => uploadFile($request, 'icon', 'icon'), 'status' => $request->status]);
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
        DiseaseType::where('id', $id)->update($data);
        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    

   

    public function delete($id) {
        $data = DiseaseType::where(['id' => $id])->first();
        if($data) {
            if($data->diseases) {
                $data->diseases()->delete();
            }
            $data->delete();
        }
        else {
            throw new Exception("Invalid diease type");

        }
    }

}