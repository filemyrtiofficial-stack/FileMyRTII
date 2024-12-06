<?php
namespace App\Repositories;
use App\Interfaces\ServiceInterface;
use Carbon\Carbon;
use App\Models\Service;
use App\Models\SlugMaster;
use Session;
use Exception;
class ServiceRepository implements ServiceInterface {

    public function store($request) {
        $service = Service::create(['name' => $request['name'], 'icon' => uploadFile($request, 'icon', 'icon'), 'status' => $request->status, 'description' => $request->description, 'category_id' => $request->category]);
        SlugMaster::create(['slug' => $request['slug'], 'linkable_id' => $service->id, 'linkable_type' => "services"]);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added"]);
    }
    
    public function update($request, $id) {
        $data = [
            'name' => $request['name'],
            'status' => $request->status,
            'description' =>  $request['description'],
            'category_id' => $request['category']
        ];

      
        $image = uploadFile($request, 'icon', 'icon');
        if(!empty($image)) {
            $data['icon'] = $image;
        }
        Service::where('id', $id)->update($data);
        if(!empty($request['slug'])) {
            SlugMaster::createUpdateSlug(['slug' => $request['slug'], 'linkable_id' => $id, 'linkable_type' => "services"]);
        }
        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    

   

    public function delete($id) {
        $data = Service::where(['id' => $id])->first();
        if($data) {
            if($data->slug) {
                $data->slug()->delete();
            }
            $data->delete();
        }
        else {
            throw new Exception("Invalid diease type");

        }
    }

}