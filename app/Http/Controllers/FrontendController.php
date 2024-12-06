<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Enquiry;
use App\Models\PageData;
class FrontendController extends Controller
{
    public function index() {


        $page_section = PageData::where(['page_id' => 7])->get();

        return view('frontend.index', compact('page_section'));
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

