<?php
namespace App\Repositories;
use App\Interfaces\DiseaseInterface;
use Carbon\Carbon;
use App\Models\MemberMedicalHistory;
use App\Models\Disease;
use Session;
use Exception;
class DiseaseRepository implements DiseaseInterface {

    public function store($request) {
        Disease::create(['name' => $request['name'], 'icon' => uploadFile($request, 'icon', 'icon'), 'status' => $request->status, 'disease_type_id' => $request->disease_type_id]);
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
        Disease::where('id', $id)->update($data);
        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    

   

    public function delete($id) {
        $data = Disease::where(['id' => $id])->first();
        if($data) {
            $data->delete();
        }
        else {
            throw new Exception("Invalid Disease");

        }
    }

}