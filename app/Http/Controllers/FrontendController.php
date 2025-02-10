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
use App\Models\EnquiryForm;
use App\Models\BlogComment;
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
use App\Models\Section;
use App\Models\ServiceCategory;
use App\Jobs\SendEmail;
use App\Models\ApplicationStatus;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function index($slug = null)
    {

        if ($slug == null) {
            $slug = 'root';
        }
        $page = Page::with('pageData')->join('slug_masters', 'slug_masters.linkable_id', '=', 'pages.id')
            ->where(['slug_masters.linkable_type' => 'pages', 'slug_masters.slug' => $slug])->where('pages.status', 1)->select('pages.*')->first();
        if ($page) {

            $page_section = $page->pageData;
            $seo = $page->seo;
            return view('frontend.index', compact('page_section', 'slug', 'seo'));
        }
        abort(404);
    }
    public function blogDetail($slug)
    {
        $data = Blog::wherehas('slugMaster', function ($query) use ($slug) {
            $query->where(['linkable_type' => 'blogs', 'slug' => $slug]);
        })->where('status', 2)->first();
        if (!$data) {
            abort(404);
        }
        $footer_banner = Section::list(false, ['status' => 1, 'type' => 'footer_banner']);
        if($footer_banner) {
            if(count($footer_banner) > 0) {
                $footer_banner = $footer_banner[0];
                $footer_banner = json_decode($footer_banner->data, true);
            }
        }
  

     
        $categoryIds = $data->blogCategories->pluck('category_id');
       
        $relatedBlogs = Blog::where('id','!=', $data->id)->where('status', 2)->whereHas('blogCategories', function ($query) use ($categoryIds) {
            $query->whereIn('category_id', $categoryIds);
        })->limit(8)->get();
       
    
        return view('frontend.blog_details', compact('data','relatedBlogs', 'footer_banner'));
    }

    public function serviceDetails($service_category = null, $service_slug = null)
    {
        if($service_slug != null) {

            $service = Service::wherehas('slug', function ($query) use ($service_slug) {
                $query->where('slug', $service_slug);
            })->where('status', 1)->select('services.*')->first();
            if (!$service) {
                abort(404);
            }
            $page_section = $service->serviceData;
            $seo = $service->seo;
            $page_type = "service";
            // $breadcrums = [
            //     [
            //         'label' => "Service"
            //     ]
                
            // ]
            return view('frontend.service_details', compact('service', 'page_section', 'seo', 'page_type'));
        }
        else if($service_category != null) {
            $service = ServiceCategory::with('serviceData')->join('slug_masters', 'slug_masters.linkable_id', '=', 'service_categories.id')
            ->where(['slug_masters.linkable_type' => 'service_category', 'slug_masters.slug' => $service_category])->where('service_categories.status', 1)->select('service_categories.*')->first();
            if (!$service) {
                abort(404);
            }
            $page_section = $service->serviceData;
            $seo = $service->seo;
            return view('frontend.service_details', compact('service', 'page_section', 'seo'));
        }
        else {
           return $this->index('service');
        }
    }

    public function sendEnquiry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required",
            'email' => "required|email",
            'phone' => "required|digits:10|numeric",
            'subject' => "required",
            'message' => "required",


        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $request->only(['name', 'email', 'phone', 'subject', 'message']);
        Enquiry::create($data);

        return response(['message' =>  'Thank you for connecting with us']);
    }

    // Newsletter Validation Code
    public function sendNewsletter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => "required|email",
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $request->only(['email']);
        $newsletter = Newsletter::where($data)->first();
        if ($newsletter) {
            if ($newsletter->status == false) {
                $newsletter->update(['status' => true]);
            } else {
                return response(['errors' => ['email' => 'You are already subscribed']], 422);
            }
        } else {
            $newsletter = Newsletter::create($data);
        }
        // Mail::to('developmentd299@gmail.com')->send(new NewsletterMail($newsletter));
        return response(['message' =>  'Thank you for connecting with us']);
    }
    public function blogListingAPI(Request $request)
    {
        $blogs = Blog::list(true, ['title' => $request->search, 'status' => 2, 'limit' => 9, 'order_by' => 'publish_date']);
        $html = view('frontend.template.blog_listing', compact('blogs'))->render();
        $pages = ($blogs->toArray());
        $page = ['current_page' => $pages['current_page'], 'last_page' => $pages['last_page'], 'next_page' => $pages['current_page'] + 1];
        return response(['pages' => $page, 'html' => $html]);
    }

    public function serviceForm($service_category, $service_slug = null)
    {

        $why_choose = Section::list(true, ['status' => 1, 'type' => 'why_choose', 'order_by' => 'sequance', 'order_by_type' => 'asc', 'limit' => 3]);
        $payment = Setting::getSettingData('payment');
        $service_category = ServiceCategory::wherehas('slug', function ($query) use ($service_category) {
            $query->where('slug', $service_category);
        })->first();
        if($service_slug == 'custom-request') {
            $service = ['id' => 0, 'name' => "Custom Request"];
            $service = (object) $service;
            $fields = [];
        return view('frontend.service_form', compact('service', 'fields', 'payment', 'why_choose', 'service_category'));

        }
        $service = Service::wherehas('slug', function ($query) use ($service_slug) {
            $query->where('slug', $service_slug);
        })->first();
        if (!$service) {
            abort(404);
        }
        $fields = [];
        if (!empty($service->fields)) {
            $fields = json_decode($service->fields, true);
        }


       
        return view('frontend.service_form', compact('service', 'fields', 'payment', 'why_choose', 'service_category'));
    }

    public function serviceFormAction(Request $request)
    {
        $service = Service::where(['id' => $request->service_key])->first();
        $fields = isset($service->fields,) ? json_decode($service->fields, true) : [];
        if ($request->step_no == 1) {

            $validator = Validator::make($request->all(), [
                'first_name' => "required",
                'last_name' => "required",
                'email' => "required|email",
                'phone_number' => "required|digits:10",
                'address' => "required",
                'postal_code' => "required|digits:6",

            ]);
            if ($validator->fails()) {
                return response(['errors' => $validator->errors()], 422);
            }
            return response(['step' => 2]);
        } elseif ($request->step_no == 2) {
            $field_data = [];
            $validation = [];
            if($request->service_key == '0') {
                $validation['rti_query'] = 'required';

                if($request->pio_addr == 'yes') {
                    $validation['pio_address'] = 'required';
                }
            }
            foreach ($fields['field_type'] ?? [] as $key => $value) {
                if( isset($fields['form_field_type'][$key]) && $fields['form_field_type'][$key] != "lawyer") {
                    $validation_string = '';
                    if (isset($fields['is_required']) && isset($fields['is_required'][$key]) && $fields['is_required'][$key] == 'yes') {
                        $validation_string = 'required';
                    }
                    if($value == 'date') {
                        $validation_string .= '|date';
                        if(isset($fields['maximum_date'][$key]) && !empty($fields['maximum_date'][$key])) {
                            $validation_string .= "|before:".$fields['maximum_date'][$key];
                        }
                        if(isset($fields['minimum_date'][$key]) && !empty($fields['minimum_date'][$key])) {
                            $validation_string .= "|after_or_equal:".$fields['minimum_date'][$key];
                        }
                        if(isset($fields['dependency_date_field'][$key]) && !empty($fields['dependency_date_field'][$key])) {
                            $field_key = getFieldName($fields['dependency_date_field'][$key]);
                            $validation_string .= "|after_or_equal:".$request[$field_key];
                        }
                    }
                    if($validation_string != '') {
                        $validation[getFieldName($fields['field_lable'][$key])] =  $validation_string;

                    }
                    $slug_key = getFieldName($fields['field_lable'][$key]);
                    $field_data[$slug_key] = ['lable' => $fields['field_lable'][$key], 'type' => $fields['field_type'][$key], 'value' => $request[$slug_key]];
                }
            }

            $validator = Validator::make($request->all(), $validation);
            if ($validator->fails()) {
                return response(['errors' => $validator->errors()], 422);
            }
            $input = $request->all();
            $input['field_data'] = $field_data;
            $data = $request->only(['first_name', 'last_name', 'email', 'phone_number', 'address', 'postal_code']);
            $data['service_id'] = $request->service_key;
            $data['service_category_id'] = $request->category_id;
            $data['service_fields'] = json_encode($input);
            $data['status'] = 1;
            $data['payment_status'] = 'pending';

            $data['application_no'] =  $this->generateApplicationNumber();
            $data['user_id'] = $this->updateUser($request);
            if (!empty($request->application_no)) {
                $rti = RtiApplication::where(['application_no' => $request->application_no])->first();
                $rti->update($data);
            } else {
                $rti = RtiApplication::create($data);
            }
            return response(['step' => 3, 'rti' => $rti]);
        } else {
            $rti = RtiApplication::where(['application_no' => $request->application_no])->first();
            $service_fields = json_decode($rti->service_fields, true);
            $service_fields['user_document'] =  $request->documents; //uploadFile($request, 'file', 'user_files');
            $rti->update(['charges' => $request->charges, 'service_fields' => json_encode($service_fields), 'documents' => $request->documents]);
            ApplicationStatus::create(['status' => "pending", "date" => Carbon::now(), 'time' => Carbon::now(), 'application_id' => $rti->id]);
            return response(['step' => 4, 'rti' => $rti, 'service_fields' => $service_fields]);
        }
    }

    private function updateUser($request)
    {
        if(auth()->guard('customers')->check()) {
            return auth()->guard('customers')->id();
        }
        $user = Customer::where(['email' => $request->email])->first();
        if (!$user) {
            $data = $request->only(['first_name', 'last_name', 'email', 'address', 'postal_code']);
            $data['phone_no'] = $request->phone_number;
            $data['password'] = bcrypt($request->phone_number);
            $user = Customer::create($data);
        }
        return $user->id;
    }

    private function generateApplicationNumber()
    {
        $application_no = date('y') . date('m') . rand(0000, 9999);
        $check_application_no = RtiApplication::where('application_no', $application_no)->first();
        if (!$check_application_no) {
            return $application_no;
        } else {
            $this->generateApplicationNumber();
        }
    }

    public function udpatePaymentSuccess(Request $request)
    {
        $fillter_array = $request->only(['application_no', 'appeal_no']);
        $rti = RtiApplication::where($fillter_array)->first();

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
            $rti->update(['payment_id' => $paymentResponse['razorpay_payment_id'], 'success_response' => json_encode($response), 'status' => 2, 'payment_status' => 'paid']);

            Session::flash('success', 'Payment Successful');
            DB::commit();
            SendEmail::dispatch('application-register', $rti);

            $why_choose = Section::list(true, ['status' => 1, 'type' => 'why_choose', 'order_by' => 'sequance', 'order_by_type' => 'asc', 'limit' => 3]);
            $footer_banner = Section::list(false, ['status' => 1, 'type' => 'footer_banner']);
            if($footer_banner) {
                if(count($footer_banner) > 0) {
                    $footer_banner = $footer_banner[0];
                    $footer_banner = json_decode($footer_banner->data, true);
                }
            }
            ApplicationStatus::create(['status' => "confirmed", "date" => Carbon::now(), 'time' => Carbon::now(), 'application_id' => $rti->id]);
            
            $payment = Setting::getSettingData('payment');
            $fileName = 'invoice_' .$rti->application_no .'_appeal_no_'.$rti->appeal_no.'.pdf';
            RtiApplication::ApplicationPaymentInvoice($rti,$fileName,$payment);

            
            return view('frontend.thank_you', compact('rti', 'why_choose', 'footer_banner'));
            //return response()->json(['success' => true, 'message' => 'Payment successfully recorded']);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('PAYMENT_STORE_ERROR' . $th->getMessage());
            // print_r(json_encode($th->getMessage()));
            return response(['success' => false, 'error' => 'Internal Server Error', 'msg' => "error"], 500);
        }
    }

    public function updatePaymentFailure(Request $request)
    {
        DB::beginTransaction();
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
            Log::error('PAYMENT_FAILURE_ERROR: ' . $th->getMessage());
            return response()->json(['success' => false, 'error' => 'Internal Server Error'], 500);
        }
    }

    // Newsletter Validation Code
    public function contactusForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reason' => "required|max:255",
            'name' => "required|max:255",
            'email' => "required|email|max:255",
            'phone_number' => "required|numeric|digits:10"


        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $request->only(['email', 'reason', 'name', 'phone_number', 'rti_option', 'message']);

        $EnquiryForm = EnquiryForm::create($data);

        Mail::to($request->email)->send(new NewsletterMail($newsletter));
        return response(['message' =>  'Thank you for connecting with us']);
    }

    public function blogComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'blog_id' => "required",
            'first_name' => "required|max:255",
            'last_name' => "required|max:255",
            'email' => "required|email|max:255",
            'comment' => "required|max:255"


        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $request->only([ 'blog_id', 'first_name', 'last_name','email', 'comment']);

        $BlogComment = BlogComment::create($data);

        // Mail::to('developmentd299@gmail.com')->send(new NewsletterMail($newsletter));
        return response(['message' =>  'Thank you for connecting with us']);
    }
}
