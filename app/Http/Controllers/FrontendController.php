<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Enquiry;
use App\Models\PageData;
use App\Models\Page;
use App\Models\SlugMaster;

class FrontendController extends Controller
{
    public function index($slug = null) {


        if($slug == null) {
          $slug = 'root';
        }
        $page = Page::with('pageData')->join('slug_masters', 'slug_masters.linkable_id', '=', 'pages.id')
        ->where(['slug_masters.linkable_type'=> 'pages', 'slug_masters.slug' => $slug])->select('pages.*')->first();
        if($page) {

            $page_section = $page->pageData;
            return view('frontend.index', compact('page_section'));
        }
        abort(404);
    }
    public function about() {
        return view('frontend.about');
    }
    public function service($id = null) {
        $data = ourServices()[$id];
        return view('frontend.service', compact('data', 'id'));
    }

    public function sendEnquiry(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => "required",
            'email' => "required|email",
            'phone' => "required|digits:10|numeric",
            'subject' => "required",
            'message' => "required",


        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $request->only(['name', 'email', 'phone', 'subject', 'message']);
        Enquiry::create($data);

        return response(['message' =>  'Thank you for connecting with us']);
    }
}

