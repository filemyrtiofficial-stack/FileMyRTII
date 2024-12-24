<?php
namespace App\Repositories;
use App\Interfaces\ServiceInterface;
use Carbon\Carbon;
use App\Models\Service;
use App\Models\SlugMaster;
use App\Models\ServiceData;
use App\Models\SeoMaster;

use Session;
use Exception;
class ServiceRepository implements ServiceInterface {

    public function store($request) {
        $faq = $request->only(['question', 'answer']);
        $service = Service::create([
            'name' => $request['name'], 
            'icon' => uploadFile($request, 'icon', 'icon'), 
            'mobile_banner' => uploadFile($request, 'mobile_banner', 'service'), 
            'desktop_banner' => uploadFile($request, 'desktop_banner', 'service'), 
            'image_1' => uploadFile($request, 'image_1', 'service'), 
            'image_2' => uploadFile($request, 'image_2', 'service'), 
            'status' => $request->status, 
            'description' => $request->description, 
            'category_id' => $request->category, 
            'fields' => json_encode($request->all()), 
            'faq' => json_encode($faq)]
        );
        SlugMaster::create(['slug' => $request['slug'], 'linkable_id' => $service->id, 'linkable_type' => "services"]);
        $seo_data = $request->only(['meta_title', 'meta_keywords', 'meta_description']);
        $seo_data['linkable_type'] = 'services';
        $seo_data['linkable_id'] = $service->id;
        SeoMaster::createUpdateSeo( $seo_data);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added", 'redirect' => route('services.edit',$service->id)]);
    }
    
    public function update($request, $id) {
        $faq = $request->only(['question', 'answer']);

        $data = [
            'name' => $request['name'],
            'status' => $request->status,
            'description' =>  $request['description'],
            'category_id' => $request['category'],
            'fields' => json_encode($request->all()),
            'faq' => json_encode($faq)
        ];

      
        $image = uploadFile($request, 'icon', 'icon');
        if(!empty($image)) {
            $data['icon'] = $image;
        }
       
        Service::where('id', $id)->update($data);
        if(!empty($request['slug'])) {
            SlugMaster::createUpdateSlug(['slug' => $request['slug'], 'linkable_id' => $id, 'linkable_type' => "services"]);
        }
        $seo_data = $request->only(['meta_title', 'meta_keywords', 'meta_description']);
        $seo_data['linkable_type'] = 'services';
        $seo_data['linkable_id'] = $id;
        SeoMaster::createUpdateSeo( $seo_data);

        if(!empty($request->update_array)) {

            $update_array = json_decode($request->update_array, true);
    
            $page_data = ServiceData::wherein('id', $update_array)->get();
            foreach($page_data as $item) {
                $item->sequance = array_search($item->id, $update_array);
                $item->save();
            }
        }


        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated", 'redirect' => route('services.edit',$id)]);
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

    
    
    public function deleteSection($id) {
        $data = ServiceData::where(['id' => $id])->first();
        if($data) {
            $data->delete();
        }
        else {
            throw new Exception("Invalid section");

        }
    }


}