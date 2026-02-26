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
use PDF;
use App\Mail\ApplicationRegister;
use App\Models\LawyerRtiQuery;
use App\Models\PioMaster;
use Illuminate\Validation\Rule;

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
            return view('frontend.index', compact('page_section', 'slug', 'seo', 'page'));
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
        $validation = [
            'name' => "required|min:3|max:45|regex:/^[a-zA-Z\s.]+$/u",
            'email' => "required|email|max:45|regex:/(.+)@(.+)\.(.+)/i",
            'phone' => "required|digits:10|numeric|".Rule::notIn(['6666666666', '7777777777', '8888888888', '9999999999'])."|regex:/^[6789]\d{9}$/",
            'subject' => "required|min:3|min:150",
            'message' => "required|min:3|max:500",        
        ];
        $validation['phone'] = "required|digits:10|".Rule::notIn(['6666666666', '7777777777', '8888888888', '9999999999'])."|regex:/^[6789]\d{9}$/";
        $phone_number_digits = 10;
        if(!empty($request->phone) && $request->phone[0] == 0) {
            $validation['phone'] = "required|digits:11|".Rule::notIn(['6666666666', '7777777777', '8888888888', '9999999999'])."|regex:/^[0][6789]\d{9}$/";
            $phone_number_digits = 11;
        }
        $validator = Validator::make($request->all(), $validation, [
            'phone.digits' => "Please enter a valid ".$phone_number_digits."-digit phone number.",
            'phone.regex' => !empty($request->phone) && $request->phone[0] == 0 ? "Phone number second digit should be started with 6, 7, 8 and 9" : "Phone number should be started with 6, 7, 8 and 9"
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
            'email' => "required|email|regex:/(.+)@(.+)\.(.+)/i",
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
        
        SendEmail::dispatch('newsletter', $newsletter);
        // Mail::to('developmentd299@gmail.com')->send(new NewsletterMail($newsletter));
        return response(['message' =>  'Thank you for connecting with us']);
    }
    public function blogListingAPI(Request $request)
    {
        $blogs = Blog::list(true, ['title' => $request->search, 'status' => 2, 'limit' => 9, 'order_by' => 'publish_date']);
        $html = view('frontend.template.blog_listing', compact('blogs'))->render();
        $pagination = view('frontend.template.blog-pagination', compact('blogs'))->render();

        $pages = ($blogs->toArray());
        $page = ['current_page' => $pages['current_page'], 'last_page' => $pages['last_page'], 'next_page' => $pages['current_page'] + 1];
        return response(['pages' => $page, 'html' => $html, 'pagination' => $pagination]);
    }

    public function serviceForm($service_category, $service_slug = null)
    {
        $old_service_slug = $service_slug;
        $why_choose = Section::list(true, ['status' => 1, 'type' => 'why_choose', 'order_by' => 'sequance', 'order_by_type' => 'asc', 'limit' => 3]);
        $payment = Setting::getSettingData('payment');
        $service_category = ServiceCategory::wherehas('slug', function ($query) use ($service_category) {
            $query->where('slug', $service_category);
        })->where('status', 1)->first();
        
          if (!$service_category) {
            abort(404);
        }
        if($service_slug == 'custom-request') {
        $service_slug = ($service_category->slug->slug ?? '')."-".$service_slug;
        

        }

        $service = Service::wherehas('slug', function ($query) use ($service_slug) {
            $query->where('slug', $service_slug);
        })->where('status', 1)->first();
        // print_r(json_encode( $service));die;
        if (!$service) {
            abort(404);
        }
        $fields = [];
        if (!empty($service->fields)) {
            $fields = json_decode($service->fields, true);
        }



        return view('frontend.service_form', compact('service', 'fields', 'payment', 'why_choose', 'service_category', 'old_service_slug'));
    }

    public function serviceFormAction(Request $request)
    {
        $service = Service::where(['id' => $request->service_key])->first();
        $fields = isset($service->fields,) ? json_decode($service->fields, true) : [];
        if ($request->step_no == 1) {

            $validations = [
                'first_name' => "required|min:1|max:45|regex:/^[a-zA-Z\s.]+$/u",
                'last_name' => "required|min:1|max:45|regex:/^[a-zA-Z\s.]+$/u",
                'email' => "required|email|regex:/(.+)@(.+)\.(.+)/i|max:45",
                // 'phone_number' => "required|digits:10|".Rule::notIn(['6666666666', '7777777777', '8888888888', '9999999999'])."|regex:/^[6789]\d{9}$/",
                'address' => "required|min:3|max:100",
                'city' => "required|min:3|max:25",
                'state' => "required|min:3|max:25",
                'postal_code' => "required|digits:6",

            ];
            $validations['phone_number'] = "required|digits:10|".Rule::notIn(['6666666666', '7777777777', '8888888888', '9999999999'])."|regex:/^[6789]\d{9}$/";
            $phone_number_digits = 10;
            if(!empty($request->phone_number) && $request->phone_number[0] == 0) {
                $validations['phone_number'] = "required|digits:11|".Rule::notIn(['6666666666', '7777777777', '8888888888', '9999999999'])."|regex:/^[0][6789]\d{9}$/";
                $phone_number_digits = 11;
            }
            // return response(['test' => $validations], 422);
          
            $validator = Validator::make($request->all(), $validations,[
                'phone_number.digits' => "Please enter a valid ".$phone_number_digits."-digit phone number",
                'phone_number.regex' => !empty($request->phone_number) && $request->phone_number[0] == 0 ? "Phone number second digit should be started with 6, 7, 8 and 9" : "Phone number should be started with 6, 7, 8 and 9"
            ]);
  
            if ($validator->fails()) {
                return response(['errors' => $validator->errors()], 422);
            }
            return response(['step' => 2]);
        } elseif ($request->step_no == 2) {
            $field_data = [];
            $validation = [];

            $input = $request->all();

            foreach ($fields['field_type'] ?? [] as $key => $value) {
                if( isset($fields['form_field_type'][$key]) && $fields['form_field_type'][$key] == "customer") {
                    $slug_key = getFieldName($fields['field_lable'][$key]);
                    $validation_string = '';
                    if (isset($fields['is_required']) && isset($fields['is_required'][$key]) && $fields['is_required'][$key] == 'yes' && $value != 'file') {
                        $validation_string = 'required';
                    }
                    if (!isset($fields['is_required']) || ( isset($fields['is_required'][$key]) && $fields['is_required'][$key] == 'no')) {
                         $validation_string = 'nullable';
                    }

                    // if($value == "input") {
                    //     $validation_string .= '|max:75';
                    // }
                    // if($value == "textarea") {
                    //     $validation_string .= '|max:200';
                    // }
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
                       $validation_string = trim($validation_string, "|");

                      if(isset($fields['validations'][$key]) && !empty($fields['validations'][$key])) {
                        $validation_string .= "|".$fields['validations'][$key];
                    }
                     if($value == "textarea" && !str_contains($validation_string, 'max:')) {
                    $validation_string .= '|max:200';
                }
                     $validation_string = trim($validation_string, "|");
                     
                      $validation_string = str_replace("current_year",Carbon::now()->format('Y'),$validation_string);

                    if($validation_string != '') {
                        $validation[getFieldName($fields['field_lable'][$key])] =  $validation_string;

                    }
                    if($value == 'file') {
                        $new_slug_key = $slug_key."_file";
                        $file =  uploadFile($request, $new_slug_key, 'page_images');
                        $input[$slug_key] =  $file;
                        $field_data[$slug_key] = ['lable' => $fields['field_lable'][$key], 'type' => $fields['field_type'][$key], 'value' => $file];

                    }
                    else {

                        $field_data[$slug_key] = ['lable' => $fields['field_lable'][$key], 'type' => $fields['field_type'][$key], 'value' => $request[$slug_key]];
                    }

                }
            }

            if(isset($request->old_service_slug) && $request->old_service_slug == 'custom-request') {
                $validation['rti_query'] = 'required|max:1000';

                if($request->pio_addr == 'yes') {
                    $validation['pio_address'] = 'required|max:500';
                }

            }

            // return response(['data' => $validation], 500);
            $validator = Validator::make($request->all(), $validation);

            if ($validator->fails()) {
                return response(['errors' => $validator->errors()], 422);
            }
            $input['field_data'] = $field_data;
            $data = $request->only(['first_name', 'last_name', 'email', 'phone_number', 'address', 'postal_code', 'city', 'state']);
            $data['service_id'] = $request->service_key;
            $data['service_category_id'] = $request->category_id;
            $data['service_fields'] = json_encode($input);
            $data['status'] = 1;
            $data['payment_status'] = 'pending';
            if (empty($request->application_no)) {
            $data['application_no'] =  $this->generateApplicationNumber();
            }
              
            if(!auth()->guard('customers')->check()) {
                $user = Customer::where(['email' => $request->email])->first();
                if(!$user) {
                    $data['user_type'] = 'guest';
                }
            }
            
            $data['user_id'] = $this->updateUser($request);
            $data ['customer_pio_address'] = $request->pio_address ?? '';
            $data ['pio_address'] = $request->pio_address ?? '';

            if (!empty($request->application_no)) {
                $rti = RtiApplication::where(['application_no' => $request->application_no])->first();
                $rti->update($data);
            } else {
                $rti = RtiApplication::create($data);
            }
            return response(['step' => 3, 'rti' => $rti]);
        } else {
            $rti = RtiApplication::where(['application_no' => $request->application_no])->first();
            if($rti && $rti->payment_status != "paid") {

                $service_fields = json_decode($rti->service_fields, true);
                $service_fields['user_document'] =  $request->documents; //uploadFile($request, 'file', 'user_files');
                 $gst = getGST($request->charges);
                $final_price = $gst + $request->charges;
                $rti->update(['charges' => $request->charges, 'gst' => $gst, 'final_price' => $final_price, 'service_fields' => json_encode($service_fields), 'documents' => $request->documents]);
                ApplicationStatus::create(['status' => "pending", "date" => Carbon::now(), 'time' => Carbon::now(), 'application_id' => $rti->id]);
                return response(['step' => 4, 'rti' => $rti, 'service_fields' => $service_fields]);
            }
            else {
                return response(['errors' => ['error' => "Payment is already done of this application. Please check."]], 422);

            }
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
            $data['password'] = $request->phone_number;
            $user = Customer::create($data);
        }
        return $user->id;
    }

    private function generateApplicationNumber()
    {
        $random = rand(0000, 9999);
        if(strlen($random) == 1) {
            $random = "000".$random;
        }
        elseif(strlen($random) == 2) {
            $random = "00".$random;
        }
        elseif(strlen($random) == 3) {
            $random = "0".$random;
        }
           $year = date('y') *2;
        $application_no = $year . date('m') . $random;
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
            $response = RtiApplication::razorPayResponse($paymentResponse['razorpay_payment_id']);
            $currentDate = Carbon::now()->format('Ymd');;  // Output: 2025-02-17
            // $invoiceNumber = "INV-{$currentDate}".rand(0000, 9999);
                 $invoiceNumber = "FMR{$currentDate}".$rti->id;



            $rti->update(['payment_id' => $paymentResponse['razorpay_payment_id'], 'success_response' => $response, 'status' => 1, 'payment_status' => 'paid','invoice_number'=> $invoiceNumber]);
            $fileName = 'invoice_' .$rti->application_no .'_appeal_no_'.$rti->appeal_no.'.pdf';

                $invoice_path =  RtiApplication::ApplicationPaymentInvoice($rti,$fileName);
                $rti->update(['invoice_path'=> $invoice_path]);
            // Session::flash('success', 'Payment Successful');
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

                if($rti->appeal_no == 1){
                $payment = Setting::getSettingData('first_appeal_payment');
                }
               else if($rti->appeal_no == 2){
                $payment = Setting::getSettingData('second_appeal_payment');
                }
                else{
                $payment = Setting::getSettingData('payment');
                }

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
        $validation = [
            'reason' => "required|max:255",
            'name' => "required|max:45|regex:/^[a-zA-Z\s.]+$/u",
            'email' => "required|email|regex:/(.+)@(.+)\.(.+)/i|max:45",
            'phone_number' => "required|numeric|digits:10|".Rule::notIn(['6666666666', '7777777777', '8888888888', '9999999999'])."|regex:/^[6789]\d{9}$/",
             'g-recaptcha-response' => 'required',
       
        ];
        $validation['phone_number'] = "required|digits:10|".Rule::notIn(['6666666666', '7777777777', '8888888888', '9999999999'])."|regex:/^[6789]\d{9}$/";
        $phone_number_digits = 10;
        if(!empty($request->phone_number) && $request->phone_number[0] == 0) {
            $validation['phone_number'] = "required|digits:11|".Rule::notIn(['6666666666', '7777777777', '8888888888', '9999999999'])."|regex:/^[0][6789]\d{9}$/";
            $phone_number_digits = 11;
        }
        $validator = Validator::make($request->all(), $validation, [
            'phone_number.digits' => "Please enter a valid ".$phone_number_digits."-digit phone number.",
            'phone_number.regex' => !empty($request->phone_number) && $request->phone_number[0] == 0 ? "Phone number second digit should be started with 6, 7, 8 and 9" : "Phone number should be started with 6, 7, 8 and 9"
        ]);


        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        //   $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        //     'secret' => config('services.recaptcha.secret_key'),
        //     'response' => $request->input('g-recaptcha-response'),
        //     'remoteip' => $request->ip(),
        // ]);
    
        // $responseBody = $response->json();
    
        // if (!$responseBody['success']) {
        //       return response(['errors' => ['g-recaptcha-response' => 'reCAPTCHA verification failed.']], 422);
        //     // return back()->withErrors(['g-recaptcha-response' => 'reCAPTCHA verification failed.'])->withInput();
        // }


        $data = $request->only(['email', 'reason', 'name', 'phone_number', 'rti_option', 'message']);

        $EnquiryForm = EnquiryForm::create($data);
        SendEmail::dispatch('enquiry', $EnquiryForm);

        session()->flash('success', 'Thank you for connecting with us');
        // Mail::to($request->email)->send(new NewsletterMail($newsletter));
        return response(['message' =>  'Thank you for connecting with us']);
    }

    public function blogComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'blog_id' => "required",
            'first_name' => "required|max:45|regex:/^[a-zA-Z\s.]+$/u",
            'last_name' => "required|max:45|regex:/^[a-zA-Z\s.]+$/u",
            'email' => "required|email|regex:/(.+)@(.+)\.(.+)/i|max:45",
            'comment' => "required|max:255"


        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $request->only([ 'blog_id', 'first_name', 'last_name','email', 'comment']);

        $BlogComment = BlogComment::create($data);
        session()->flash('success','Thank you for your review');

        // Mail::to('developmentd299@gmail.com')->send(new NewsletterMail($newsletter));
        return response(['status' =>  'success']);
    }

    public function sampleRtiTemplate($service_id) {
        $service = Service::find($service_id);
        // print_r(json_encode($service));

        $html = $service->templates[0]->template;
        $signature_html = $service->templates[0]->signature;
            
        $fields = [];
        if($service && !empty($service->fields)) {
            $fields = json_decode($service->fields, true);
        }
       
        foreach($fields['document_placeholder'] as $key => $value) {
            $slug = getFieldName($fields['field_lable'][$key]);
            if(!empty($fields['default_values'][$key])) {
                $value = $fields['default_values'][$key];
            }
            else {
                $value = "[".$value."]";
            }
            $html = str_replace("[" . $slug . "]", $value, $html);
            $signature_html = str_replace("[" . $slug . "]", $value, $signature_html);
        }
        


        
        $pdf = PDF::loadView('frontend.profile.sample-rti-template', compact('service', 'html', 'signature_html'));
        return $pdf->stream();

    }

    public function invoicePdf($application_no = null) {

        $queries = LawyerRtiQuery::wherehas('rtiApplication')
        ->where('reply', '=',Null)
        ->join('rti_applications', 'rti_applications.id', '=', 'lawyer_rti_queries.application_id')
        ->join('application_statuses', 'application_statuses.application_id', '=', 'lawyer_rti_queries.application_id')
        ->where('application_statuses.status', '!=','approved')
        ->where('application_statuses.status', '!=','filed')
        // ->wheredate('lawyer_rti_queries.created_at', $date)
        ->select('rti_applications.*','lawyer_rti_queries.*')
        ->get();

        foreach($queries as $query) {
            SendEmail::dispatch('more-info', $query->rtiApplication);

        }
//         $currentDate = Carbon::now()->format('Ymd');;  // Output: 2025-02-17
//             // $application_no = date('y') . date('m') . rand(0000, 9999);
//             $invoiceNumber = "INV-{$currentDate}".rand(0000, 9999);
//  echo "<pre>";   print_r($invoiceNumber); die();
        // $application = RtiApplication::where(['application_no' => $application_no])->first();
        // $email = new ApplicationRegister($application);
        // // Mail::to($application['email'])->send($email);

        // $payment_details = json_decode($application->success_response , true);
        // $company = Setting::getSettingData('invoice-setting');
        // // Decode the JSON string into an associative array
        // $paymentdata = json_decode($application->success_response, true);
        // // $paymentdata = json_decode( $data, true);

        // $logo = asset($company['invoice_logo'] ?? '');

        // $signature = public_path($company['invoice_logo'] ?? '');
        // $signature = "data:image/png;base64,".base64_encode(file_get_contents($logo));

        // $fileName = 'invoice_' .$application->application_no .'_appeal_no_'.$application->appeal_no.'.pdf';
        // RtiApplication::ApplicationPaymentInvoice($application,$fileName);

        // echo $logo;
        // $pdf = PDF::loadView('frontend.profile.invoice',compact('company','application','paymentdata','logo') );
        // return view('frontend.profile.invoice',compact('company','application','paymentdata','logo') );

        // $pdf = PDF::loadView('frontend.profile.invoice',compact('company','application','paymentdata') );
        // return $pdf->stream();
     }

     public function searchPIO(Request $request) {
        $list = PioMaster::list(false, ['address' => $request->address]);

        return response(['data' => $list]);
    }

    public function verifyTrackingRTI(Request $request) {
        $validator = Validator::make($request->all(), [
            'application_no' => "required",
            'email' => "required|email|max:255",
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $rti = RtiApplication::where('application_no', $request->application_no)
        ->wherehas('customer', function($query) use($request) {
            $query->where('email' , $request->email);
        })->first();
        if(!$rti) {
            return response(['errors' => ['application_no' => "Invalid application number"]], 422);

        }
        return response(['status' =>  'success', 'redirect' => route('track-my-rti', encryptString($request->application_no))]);
    }

    public function trackingRTI($application_no, $tab = "application-status") {
       try {
        $application_no = decryptString($application_no);
        $list = RtiApplication::rtiNumberDetails(['application_no' => $application_no]);
        $data = $list;
        if(count($data) > 0) {
            $data = $data[count($data)-1] ?? [];
        }
        $html = RtiApplication::draftedApplication($data);
 if((!$data->lastRtiQuery || ($data->lastRtiQuery && $data->lastRtiQuery->marked_read != 0)) && $tab == "requested-info") {
            return redirect()->to('/track-my-rti/'.encryptString($application_no));
 
         }
        return view('frontend.track-my-rti', compact('data', 'tab', 'list', 'html'));
       } catch (\Throwable $th) {
        abort(404);
       }
    }

    public function previewDocument($string) {
        $string = decryptString($string);
        // return $string;
        return view('preview-document', compact('string'));
    }

}
