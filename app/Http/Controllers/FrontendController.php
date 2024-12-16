<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Enquiry;
use App\Models\PageData;
use App\Models\Page;
use App\Models\SlugMaster;
use App\Models\Blog;
use App\Models\Newsletter;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;
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
            $seo = $page->seo;
            return view('frontend.index', compact('page_section', 'slug', 'seo'));
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

    // Newsletter Validation Code
    public function sendNewsletter(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => "required|email",
        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $request->only(['email']);
        $newsletter = Newsletter::where($data)->first();
        if($newsletter) {
            if($newsletter->status == false) {
                $newsletter->update(['status' => true]);
            }
            else {
                return response(['errors' => ['email' => 'You are already subscribed']], 422);
            }
        }
        else {
            $newsletter = Newsletter::create($data);
        }
        Mail::to('developmentd299@gmail.com')->send(new NewsletterMail($newsletter));
        return response(['message' =>  'Thank you for connecting with us']);
    }
    public function blogListingAPI(Request $request) {
        // $request->merge(['status' =>  2]);
        $blogs = Blog::list(true, $request->all());
        $html = view('frontend.template.blog_listing', compact('blogs'))->render();
        return response(['data' => $blogs, 'html' => $html]);
    }

}

