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
use App\Models\Service;
use Illuminate\Support\Str;
use App\Models\RtiApplication;
use App\Models\Customer;
use App\Models\Setting;
use Razorpay\Api\Api;
use DB;
use Log;
use Session;
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

    public function serviceForm($service_slug = null) {
        $service = Service::wherehas('slug', function($query) use($service_slug){
            $query->where('slug', $service_slug);
        })->first();
        $fields = json_decode($service->fields, true);
        $payment = Setting::getSettingData('payment');
        return view('frontend.service_form', compact('service', 'fields', 'payment'));
    } 

    public function serviceFormAction(Request $request) {
        $service = Service::where(['id' => $request->service_key])->first();
        $fields = json_decode($service->fields, true);
        if($request->step_no == 1) {

            $validator = Validator::make($request->all(), [
                'first_name' => "required",
                'last_name' => "required",
                'email' => "required|email",
                'phone_number' => "required",
                'address' => "required",
                'postal_code' => "required|digits:6",
                
    
            ]);
            if($validator->fails()) {
                return response(['errors' => $validator->errors()], 422);
            }
            return response(['step' => 2]);
        }
        elseif($request->step_no == 2) {
            $field_data = [];
            $validation = [];
            foreach($fields['field_type'] ?? [] as $key => $value) {
                if($fields['is_required'][$key] == 'yes') {
                    
                    $validation[Str::slug($fields['field_lable'][$key])] = 'required';
                }
                $slug_key = Str::slug($fields['field_lable'][$key]);
                $field_data[$slug_key] = ['lable' => $fields['field_lable'][$key], 'type' => $fields['field_type'][$key], 'value' => $request[$slug_key]];
            }

            $validator = Validator::make($request->all(), $validation);
            if($validator->fails()) {
                return response(['errors' => $validator->errors()], 422);
            }
            $input = $request->all();
            $input['field_data'] = $field_data;
            $data = $request->only(['first_name', 'last_name', 'email', 'phone_number', 'address', 'postal_code']);
            $data['service_id'] = $request->service_key;
            $data['service_fields'] = json_encode($input);
            $data['status'] = 1;
            $data['application_no'] =  $this->generateApplicationNumber();
            $data['user_id'] = $this->updateUser($request);
            if(!empty($request->application_no)) {
                $rti = RtiApplication::where(['application_no' => $request->application_no])->first();
                $rti->update($data);
            }
            else {
                $rti = RtiApplication::create($data);
            }
            return response(['step' => 3, 'rti' => $rti]);
        }
        else {
            $rti = RtiApplication::where(['application_no' => $request->application_no])->first();
            $service_fields = json_decode($rti->service_fields, true);
            $service_fields['user_document'] = uploadFile($request, 'file', 'user_files');
            $rti->update(['charges' => $request->charges, 'service_fields' => json_encode($service_fields)]);
            return response(['step' => 4, 'rti' => $rti, 'service_fields' => $service_fields]);  
        }
    }

    private function updateUser($request) {
        $user = Customer::where(['email' => $request->email])->first();
        if(!$user) {
            $data = $request->only(['first_name', 'last_name', 'email', 'phone_number', 'address', 'postal_code']);
            $data['password'] = bcrypt($request->phone_no);
            $user = Customer::create($data);
        }
        return $user->id;

    }
    
    private function generateApplicationNumber() {
        $application_no = date('Y').date('m').rand(0000, 9999);
        $check_application_no = RtiApplication::where('application_no', $application_no)->first();
        if(!$check_application_no) {
            return $application_no;
        }
        else {
            $this->generateApplicationNumber();
        }

    }

    public function udpatePaymentSuccess(Request $request) {
        $rti = RtiApplication::where(['application_no' => $request->application_no])->first();

        DB::beginTransaction();
        try {

            $paymentResponse = $request->all();
            if (count($paymentResponse) > 0 && empty($paymentResponse['razorpay_payment_id'])) {
                Session::put('error', 'No Payment ID Found');

                return redirect()->back();
            }

            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $payment = $api->payment->fetch($paymentResponse['razorpay_payment_id']);
            $response = $payment->capture(['amount' => $payment['amount']]);
            $rti->update(['payment_id' => $paymentResponse['razorpay_payment_id'], 'success_response' => json_encode($response), 'status' => 2]);

            Session::flash('success', 'Payment Successful');
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Payment successfully recorded']);

        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('PAYMENT_STORE_ERROR'.$th->getMessage());

            return response()->json(['success' => false, 'error' => 'Internal Server Error'], 500);
        }

    }

    public function updatePaymentFailure(Request $request){
        DB::beginTransaction();
        print_r(json_encode($request->all()));
        try {
            $responseData = $request->input('response', []);
            $errorData = $responseData['error'] ?? [];

            // Payment::create([
            //     'r_payment_id' => $errorData['metadata']['payment_id'] ?? null,
            //     'method' => $errorData['source'] ?? null,
            //     'currency' => 'INR',
            //     'email' => '', //email id for the the user
            //     'phone' => '', // mobile number for the user,
            //     'amount' => 100, // amount for the payment process
            //     'status' => 'failed',
            //     'json_response' => json_encode($responseData)
            // ]);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Payment failure recorded']);

        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('PAYMENT_FAILURE_ERROR: '.$th->getMessage());
            return response()->json(['success' => false, 'error' => 'Internal Server Error'], 500);
        }
    }

}

