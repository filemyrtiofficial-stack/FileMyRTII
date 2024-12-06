<?php
namespace App\Repositories;
use App\Interfaces\LabTestInterface;
use Carbon\Carbon;
use App\Models\MemberMedicalHistory;
use App\Models\LabTest;
use Session;
use Exception;
class LabTestRepository implements LabTestInterface {

    public function store($request) {
        LabTest::create(['name' => $request['name'], 'icon' => uploadFile($request, 'icon', 'icon'), 'status' => $request->status, 'description' =>  $request->description]);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added"]);
    }
    
    public function update($request, $id) {
        $data = [
            'name' => $request['name'],
            'status' => $request->status,
            'description' => $request->description
        ];
        $image = uploadFile($request, 'icon', 'icon');
        if(!empty($image)) {
            $data['icon'] = $image;
        }
        LabTest::where('id', $id)->update($data);
        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    

   

    public function delete($id) {
        $data = LabTest::where(['id' => $id])->first();
        if($data) {
            $data->delete();
        }
        else {
            throw new Exception("Invalid lab test");

        }
    }

}