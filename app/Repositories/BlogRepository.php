<?php
namespace App\Repositories;
use App\Interfaces\BlogInterface;
use Carbon\Carbon;
use App\Models\Blog;
use App\Models\SeoMaster;
use App\Models\SlugMaster;
use App\Models\BlogCategory;
use App\Models\BlogFaq;
use Session;
use Exception;
class BlogRepository implements BlogInterface {

    public function store($request) {
        $data = $request->only(['title', 'slug', 'short_description', 'description', 'status', 'publish_date']);
       
        $data['thumbnail'] = uploadFile($request, 'thumbnail', 'blog');
        $data['banner'] = uploadFile($request, 'feature_image', 'blog');
        $blog = Blog::create($data);
        if($blog) {
            $this->category($blog, $request);
            $this->faqs($blog, $request);
            $seo_data = $request->only(['meta_title', 'meta_keywords', 'meta_description']);
            $seo_data['linkable_type'] = 'blogs';
            $seo_data['linkable_id'] = $blog->id;
            SlugMaster::createUpdateSlug(['slug' => $request['slug'], 'linkable_id' => $blog->id, 'linkable_type' => "blogs"]);
            SeoMaster::createUpdateSeo( $seo_data);

        }
        return response(['message' => "Data successfully added"]);
    }

    private function category($blog, $request) {
        if($blog->blogCategories) {
            $blog->blogCategories()->delete();
        }
        if(isset($request->category)) {
            foreach($request->category as $category) {
                BlogCategory::create(['blog_id' => $blog->id, 'category_id' => $category]);
            }
        }
    }


    private function faqs($blog, $request) {
        if($blog->blogFaqs) {
            $blog->blogFaqs()->delete();
        }
        if(isset($request->question)) {
            foreach($request->question as $key => $question) {
                BlogFaq::create(['blog_id' => $blog->id, 'question' => $question, 'answer' => $request['answer'][$key]]);
            }
        }
    }
    
    public function update($request, $id) {
        $data = $request->only(['title', 'slug', 'short_description', 'description', 'status', 'publish_date']);
       
        if($request->hasFile('thumbnail')){
            $data['thumbnail'] = uploadFile($request, 'thumbnail', 'blog');
        }
        if($request->hasFile('feature_image')){
            $data['banner'] = uploadFile($request, 'feature_image', 'blog');
        }
        $blog = Blog::where(['id' => $id])->first();
        $blog->update($data);
        $this->category($blog, $request);
   
        $this->faqs($blog, $request);
        $seo_data = $request->only(['meta_title', 'meta_keywords', 'meta_description']);
        $seo_data['linkable_type'] = 'blogs';
        $seo_data['linkable_id'] = $blog->id;
        if(!empty($request['slug'])) {

            SlugMaster::createUpdateSlug(['slug' => $request['slug'], 'linkable_id' => $id, 'linkable_type' => "blogs"]);
        }
        SeoMaster::createUpdateSeo( $seo_data);

        return response(['message' => "Data successfully added"]);
    }
    

   

    public function delete($id) {
        $blog = Blog::where(['id' => $id])->first();
        if($blog) {
            if($blog->blogCategories) {
                $blog->blogCategories()->delete();
            }
            if($blog->blogFaqs) {
                $blog->blogFaqs()->delete();
            }
            if($blog->slugMaster) {
                $blog->slugMaster()->delete();
            }
            if($blog->seo) {
                $blog->seo()->delete();
            }
            
            $blog->delete();
        }
        else {
            throw new Exception("Invalid blog");

        }
    }

}