<?php
namespace App\Repositories;
use App\Interfaces\ServiceCategoryInterface;
use Carbon\Carbon;
use App\Models\ServiceCategory;
use Session;
use Exception;
class ServiceCategoryRepository implements ServiceCategoryInterface {

    public function store($request) {
        ServiceCategory::create(['name' => $request['name'], 'status' => $request->status]);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added"]);
    }
    
    public function update($request, $id) {
        $data = [
            'name' => $request['name'],
            'status' => $request->status
        ];
      
        ServiceCategory::where('id', $id)->update($data);
        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    

   

    public function delete($id) {
        $data = ServiceCategory::where(['id' => $id])->first();
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