<?php
namespace App\Repositories;
use App\Interfaces\ServiceCategoryInterface;
use Carbon\Carbon;
use App\Models\ServiceCategory;
use App\Models\SlugMaster;
use App\Models\SeoMaster;
use Session;
use Exception;
use App\Models\ServiceCategoryData;
class ServiceCategoryRepository implements ServiceCategoryInterface {

    public function store($request) {
        $service = ServiceCategory::create(['name' => $request['name'], 'status' => $request->status]);
        SlugMaster::create(['slug' => $request['slug'], 'linkable_id' => $service->id, 'linkable_type' => "service_category"]);
        $seo_data = $request->only(['meta_title', 'meta_keywords', 'meta_description']);
        $seo_data['linkable_type'] = 'service_category';
        $seo_data['linkable_id'] = $service->id;
        SeoMaster::createUpdateSeo( $seo_data);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added", 'redirect' => route('service-category.edit',$service->id)]);
    }
    
    public function update($request, $id) {
        $data = [
            'name' => $request['name'],
            'status' => $request->status
        ];
      
        ServiceCategory::where('id', $id)->update($data);
        if(!empty($request['slug'])) {
            SlugMaster::createUpdateSlug(['slug' => $request['slug'], 'linkable_id' => $id, 'linkable_type' => "service_category"]);
        }
        $seo_data = $request->only(['meta_title', 'meta_keywords', 'meta_description']);
        $seo_data['linkable_type'] = 'service_category';
        $seo_data['linkable_id'] = $id;
        SeoMaster::createUpdateSeo( $seo_data);

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

    public function deleteSection($id) {
        $data = ServiceCategoryData::where(['id' => $id])->first();
        if($data) {
            $data->delete();
        }
        else {
            throw new Exception("Invalid section");

        }
    }

}