<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\BlogComment;
use App\Repositories\BlogRepository;
use App\Interfaces\BlogInterface;
use Validator;
class BlogController extends Controller
{
    private BlogRepository $blogRepository;

    public function __construct(BlogInterface $blogRepository)
    {
       $this->blogRepository = $blogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Blog::list(true, $request->all());
        return view('pages.blog.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::list(false, ['status' => 1]);
        return view('pages.blog.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => "required|unique:blogs,title",
            'status' => "required",
            'short_description' => "required",
            'description' => "required",
            'thumbnail' => "required",
            'feature_image' => "required",
            'category' => "required",
            'slug' => "required|unique:slug_masters,slug",
            'publish_date' => 'required|date'

        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->blogRepository->store($request);
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Blog::get($id);
        $categories = Category::list(false, ['status' => 1]);
        $category_ids = getColumnData($data->blogCategories->toArray(), 'category_id');
        return view('pages.blog.create', compact('data', 'categories', 'category_ids'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
          'title' => "required|unique:blogs,title,".$id,
            'status' => "required",
            'short_description' => "required",
            'description' => "required",
            // 'thumbnail' => "nullable|image",
            // 'feature_image' => "nullable|image",
            'category' => "required",
            'slug' => "required|unique:blogs,slug,".$id,
            'publish_date' => 'required|date'
        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $blog = Blog::get($id);
        // if($blog && $blog->slug && checkSlug($request->slug, $blog->slug->id)) {
        //     return response(['errors' => ['slug' => "This slug is already exist"]], 422);

        // }
        $data = $this->blogRepository->update($request, $id);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $data = $this->blogRepository->delete($id);
            return response(['message' => 'Data is successfully deleted']);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 500);
        }
    }

    public function blogCommentList(Request $request) {
        
        $list = BlogComment::list(true, $request->all());
        return view('pages.blog.blog-comment.index', compact('list'));
        
    }


   
}
