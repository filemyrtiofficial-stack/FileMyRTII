<?php
namespace App\Repositories;
use App\Interfaces\TemplateInterface;
use Carbon\Carbon;
use App\Models\Page;
use App\Models\PageData;
use App\Models\ServiceData;
use App\Models\SlugMaster;
use App\Models\SeoMaster;
use Session;
use Exception;
class TemplateRepository implements TemplateInterface {

    public function store($request) {
        $page = Page::create(['title' => $request['title'], 'description' => $request->description, 'status' => $request->status]);
        SlugMaster::create(['slug' => $request['slug'], 'linkable_id' => $page->id, 'linkable_type' => "pages"]);
        $seo_data = $request->only(['meta_title', 'meta_keywords', 'meta_description']);
        $seo_data['linkable_type'] = 'pages';
        $seo_data['linkable_id'] = $page->id;
        SeoMaster::createUpdateSeo( $seo_data);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added", 'redirect' => route('pages.edit',$page->id)]);
    }
    
    public function update($request, $id) {
        $data = ['title' => $request['title'], 'description' => $request->description, 'status' => $request->status];
        $page = Page::where('id', $id)->first();
        $page->update($data);
        $seo_data = $request->only(['meta_title', 'meta_keywords', 'meta_description']);
        $seo_data['linkable_type'] = 'pages';
        $seo_data['linkable_id'] = $page->id;
        SeoMaster::createUpdateSeo( $seo_data);
        if(!empty($request->update_array)) {

            $update_array = json_decode($request->update_array, true);
    
            $page_data = PageData::wherein('id', $update_array)->get();
            foreach($page_data as $item) {
                $item->sequance = array_search($item->id, $update_array);
                $item->save();
            }
        }


        if(!empty($request['slug'])) {
            SlugMaster::createUpdateSlug(['slug' => $request['slug'], 'linkable_id' => $id, 'linkable_type' => "pages"]);
        }
        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    

   

    public function delete($id) {
        $data = Page::where(['id' => $id])->first();
        if($data) {
            if($data->slugMaster) {
                $data->slugMaster()->delete();
            }
            if($data->seo) {
                $data->seo()->delete();
            }
            if($data->pageData) {
                $data->pageData()->delete();
            }
            $data->delete();
        }
        else {
            throw new Exception("Invalid section type");

        }
    }

    public function updateSectionDetails($request, $page_id, $id = null) {

        if($request->page_type == 'service') {
            if($request->key == null) {
    
                $sequance = 1;
                $pages = ServiceData::where(['service_id' => $page_id])->orderBy('sequance', 'desc')->first();
                if($pages) {
                    $sequance = $pages->sequance + 1;
                }
                ServiceData::create(['service_id' => $page_id, 'section_key' => $request->section_key, 'data' => json_encode($request->all()), 'sequance' => $sequance]);
            }
            else {
                ServiceData::where(['id' => $request->key])->update([ 'data' => json_encode($request->all())]);
    
            } 
            Session::flash("success", "Data successfully added");
            return response(['message' => "Data successfully added", 'redirect' => route('services.edit',$page_id)]);
        }
        else {

            if($request->key == null) {
    
                $sequance = 1;
                $pages = PageData::where(['page_id' => $page_id])->orderBy('sequance', 'desc')->first();
                if($pages) {
                    $sequance = $pages->sequance + 1;
                }
                PageData::create(['page_id' => $page_id, 'section_key' => $request->section_key, 'data' => json_encode($request->all()), 'sequance' => $sequance]);
            }
            else {
                PageData::where(['id' => $request->key])->update([ 'data' => json_encode($request->all())]);
    
            } 
            Session::flash("success", "Data successfully added");
            return response(['message' => "Data successfully added", 'redirect' => route('pages.edit',$page_id)]);
        }
    }

    public function deleteSection($id) {
        $data = PageData::where(['id' => $id])->first();
        if($data) {
            $data->delete();
        }
        else {
            throw new Exception("Invalid section");

        }
    }


 
  


}