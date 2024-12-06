<?php
namespace App\Repositories;
use App\Interfaces\TemplateInterface;
use Carbon\Carbon;
use App\Models\Page;
use App\Models\PageData;
use App\Models\SlugMaster;
use App\Models\SeoMaster;
use Session;
use Exception;
class TemplateRepository implements TemplateInterface {

    public function store($request) {
        $page = Page::create(['title' => $request['title'], 'description' => $request->description, 'status' => $request->status]);
        // PageData::create(['page_id' => $page->id, 'data' => json_encode($request->all())]);
        SlugMaster::create(['slug' => $request['slug'], 'linkable_id' => $page->id, 'linkable_type' => "pages"]);
        $seo_data = $request->only(['meta_title', 'meta_keywords', 'meta_description']);
        $seo_data['linkable_type'] = 'pages';
        $seo_data['linkable_id'] = $page->id;
        SeoMaster::createUpdateSeo( $seo_data);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added"]);
    }
    
    public function update($request, $id) {
        $data = ['title' => $request['title'], 'description' => $request->description, 'status' => $request->status];
        $page = Page::where('id', $id)->first();
        $page->update($data);
        $page_data = PageData::create(['page_id' => $page->id])->first();
        if(!$page_data ) {

            PageData::create(['page_id' => $page->id, 'data' => json_encode($request->all())]);
        }
        else {
            $page->update(['data' => json_encode($request->all())]);
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

        if($request->key == null) {

            PageData::create(['page_id' => $page_id, 'section_key' => $request->section_key, 'data' => json_encode($request->all())]);
        }
        else {
            PageData::where(['id' => $request->key])->update([ 'data' => json_encode($request->all())]);

        }

        // $page_data = PageData::where(['page_id' => $page_id])->first();
        // if(!$page_data) {
        // }
        // else {
        //     $page_data->update(['data' => json_encode($request->all())]);
        // }
        
        
    }

 
  


}