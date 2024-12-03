<?php
namespace App\Repositories;
use App\Interfaces\BlogInterface;
use Carbon\Carbon;
use App\Models\Blog;
use Session;
use Exception;
class BlogRepository implements BlogInterface {

    public function store($request) {
        $data = $request->only(['title', 'slug', 'short_description', 'description', 'status']);
        $data['slug'] = $data['title'];
        $data['thumbnail'] = uploadFile($request, 'thumbnail', 'blog');
        $data['banner'] = uploadFile($request, 'feature_image', 'blog');
        $blog = Blog::create($data);
        if($blog) {
            $this->category($blog, $request);
            $this->faqs($blog, $request);

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
        $data = [
            'name' => $request['name'],
            'status' => $request->status
        ];
        $image = uploadFile($request, 'icon', 'icon');
        if(!empty($image)) {
            $data['icon'] = $image;
        }
        Blog::where('id', $id)->update($data);
        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    

   

    public function delete($id) {
        $data = Blog::where(['id' => $id])->first();
        if($data) {
            $data->delete();
        }
        else {
            throw new Exception("Invalid blog");

        }
    }

}