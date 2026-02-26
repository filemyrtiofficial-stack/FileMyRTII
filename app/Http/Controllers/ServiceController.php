<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Repositories\ServiceRepository;
use App\Interfaces\ServiceInterface;
use Validator;
use Illuminate\Support\Str;
use App\Models\ServiceData;
use App\Models\RtiApplication;
use App\Models\ApplicationCloseRequest;
use App\Models\RtiApplicationLawyer;
use App\Jobs\SendEmail;
use App\Models\RefundRequest;
use Illuminate\Support\Facades\Response;

use App\Models\AdminRtiBackup;
use Illuminate\Validation\Rule;
use carbon\carbon;
use Illuminate\Support\Facades\File;


class ServiceController extends Controller
{
    private ServiceRepository $serviceRepository;

    public function __construct(ServiceInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
        $this->middleware(['can:Manage Service'], ['only' => ['index', 'destroy', 'create', 'store', 'edit', 'update']]); 
        $this->middleware(['can:Delete Service'], ['only' => ['destroy']]); 
        $this->middleware(['can:Create Service'], ['only' => ['create', 'store']]); 
        $this->middleware(['can:Edit Service'], ['only' => ['edit', 'update']]); 
        $this->middleware(['can:Manage RTI Application'], ['only' => ['rtiApplicationsList', 'view', 'rticloserequestList']]); 
        $this->middleware(['can:Assign Lawyer'], ['only' => ['assignLawyer']]); 

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Service::list(true, $request->all());
        return view('pages.service.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = ServiceCategory::list(false, ['status' => true]);

        return view('pages.service.create', compact('categories'));

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
            // 'name' => "required|unique:services,name",
            'name' => "required|max:255",

            'slug' => "required|unique:slug_masters,slug",
            'status' => "required",
            'description' => "required",
            'category' => "required"

        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->serviceRepository->store($request);
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
        $data = Service::get($id);
        $categories = ServiceCategory::list(false, ['status' => true]);
        $fields = [];
        if($data && !empty($data->fields)) {
            $fields = json_decode($data->fields, true);
        }
        return view('pages.service.create', compact('data', 'categories', 'fields'));

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
            // 'name' => "required|unique:services,name,".$id,
            'name' => "required|max:255",

            'status' => "required",
            'slug' => "required",
            'description' => "required",
            'category' => "required"
        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $service = Service::get($id);
        if($service && $service->slug && checkSlug($request->slug, $service->slug->id)) {
            return response(['errors' => ['slug' => "This slug is already exist"]], 422);

        }
        $data = $this->serviceRepository->update($request, $id);
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
            $data = $this->serviceRepository->delete($id);
            return response(['message' => 'Data is successfully deleted']);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 500);
        }
    }
    public function updateServicesDetails(Request $request, $service_id) {
        $validation = [];
        if($request->section_key == 'home_banner') {
            $validation = [
                'title' => "required",
                'home_banner_description' => "required",
                'home_banner_banner_mobile_image' => "required",
                'home_banner_banner_desktop_image' => "required"
            ];
            
            for($index = 0; $index < $request->banner_slider_list_row_count; $index++) {
                $validation = array_merge($validation, [
                    'home_banner_banner_review_slider_title_'.$index => "required",
                    'home_banner_banner_review_slider_description_'.$index => "required",
                    'home_banner_banner_review_slider_image_'.$index => "required"
                    ]
                );
            }
            if((!empty($request->home_banner_banner_link_title) && empty($request->home_banner_banner_link_url)) || (empty($request->home_banner_banner_link_title) && !empty($request->home_banner_banner_link_url))) {
                $validation = array_merge($validation, [
                    'home_banner_banner_link_title'=> "required",
                    'home_banner_banner_link_url' => "required"
                    ]
                );
            }
        }
        elseif($request->section_key == 'our_blogs') {
            $validation = [
                'title' => "required",
            ];
            for($index = 0; $index < $request->blog_count; $index++) {
                $validation = array_merge($validation, [
                    'blog_'.$index => "required",
                    ]
                );
            }
        }
        elseif($request->section_key == 'how_it_works') {
            $validation = [
                'title' => "required",
            ];
            for($index = 0; $index < $request->how_it_work_count; $index++) {
                $validation = array_merge($validation, [
                    'how_it_work_'.$index => "required",
                    ]
                );
            }
            if((!empty($request->how_it_work_link_title) && empty($request->how_it_work_link_url)) || (empty($request->how_it_work_link_title) && !empty($request->how_it_work_link_url))) {
                $validation = array_merge($validation, [
                    'how_it_work_link_title'=> "required",
                    'how_it_work_link_url' => "required"
                    ]
                );
            }
        }
        elseif($request->section_key == 'service_tabs') {
            $validation = [
                'title' => "required",
            ];
            for($index = 0; $index < $request->service_tabs_service_count; $index++) {
                $validation = array_merge($validation, [
                    'service_tabs_service_'.$index => "required",
                    ]
                );
            }
        }
        elseif($request->section_key == 'top_banner') {
            $validation = [
                'title' => "required",
                'top_banner_desktop_image' => "required",
                'top_banner_mobile_image' => "required"

            ];
        }
        elseif($request->section_key == 'right_image_left_accordian') {
            $validation = [
            'title' => "required",
            'image_1' => "required",
            'accordian_description.*' => 'required',
            'accordian_title.*' => 'required'
            ];
        }
        elseif($request->section_key == 'right_image_left_text') {
            $validation = [
            // 'title' => "required",
            'description' => "required",
            'image_1' => "required",
            ];
        }
        elseif($request->section_key == 'left_image_right_text') {
            $validation = [
            'title' => "required",
            'description' => "required",
            'image_1' => "required",
            ];
        }
        elseif($request->section_key == 'our_team') {
            $validation = [
            'title' => "required",
            'image_1' => "required",
            ];
            for($index = 0; $index < $request->team_count; $index++) {
                $validation['team_'.$index] = 'required';
            }
        }
        $validator = Validator::make($request->all(), $validation);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->serviceRepository->updateSectionDetails($request, $service_id);
        return $data;
    }




    public function getSectionServices($page_id, $section_key, $id = null) {
        $data = [];
          $page = [];
        if($id != null) {
            $data = ServiceData::where(['service_id' => $page_id, 'id' => $id])->first();
            $data = json_decode($data->data, true);
            $page = Service::where(['id' => $page_id])->first();
            
        }
        $template = templateList()[$section_key];
        // print_r(json_encode( $template));
        $page_type = "service";
        
       return view('backend.template.pages.section.'.$section_key, compact('page', 'template', 'page_id', 'section_key', 'id', 'data', 'page_type'));
    }

    public function deleteSectionServices($id) {
        try {
            $data = $this->serviceRepository->deleteSection($id);
            return response(['message' => 'Data is successfully deleted']);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 500);
        }
    }

    public function rtiApplicationsList(Request $request) {
     
        if(!isset($request->daterange)) {
           
            $request->merge(['daterange' => "01/01/2023 - ".Carbon::now()->addDay()->format('m/d/Y')]);
        }
        $request->merge(['with_delete' => "yes"]);

        $list = RtiApplication::list(true, $request->all());
        return view('pages.rti-applications.index', compact('list', 'request'));
        
    }

    public function view(Request $request, $id) {
        $data = RtiApplication::get($id);
         $data = RtiApplication::list(false, ['with_delete' => "yes", 'id' => $id]);
        if(!$data) {
            abort(404);
        }
        $data = $data[0];
        $service_name = json_decode($data->service_fields, true);
        $fields = [];
        if ($data->service && !empty($data->service->fields)) {
            $fields = json_decode($data->service->fields, true);
        }
        $field_data = json_decode($data['service_fields'], true); 

     
        return view('pages.rti-applications.view', compact('data', 'service_name', 'fields', 'field_data'));
        
    }


    public function assignLawyer($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lawyer' => "required",
        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        try {
            $application = RtiApplication::get($id);
            if(!$application) {
                return response(['errors' => ['lawyer' => "Application is not exist"]], 422);
    
            }
            if($application->refundRequest && $application->refundRequest->status == 'pending') {
                return response(['errors' => ['lawyer' => "Customer raised a refund request"]], 422);
            }
            else if($application->refundRequest && $application->refundRequest->status == 'approve') {
                  return response(['errors' => ['lawyer' => "Refund request is approved no need to assign a lawyer"]], 422);
            }
            $data = $this->serviceRepository->assignLawyer($id, $request);
            return $data;
        } catch (\Throwable $th) {
            return response(['error' => "Something went wrong ".$th->getMessage()], 500);
        }
    }

    public function rtiApplicationTemplate() {
        return view('pages.service.template.index');
    }

    public function rticloserequestList(Request $request) {
        // echo "hello";die('kkk');
        $list = ApplicationCloseRequest::list(true, $request->all());
        return view('pages.rti-applications.rticloserequest-list', compact('list'));
        
    }

     public function approveLawyerRequest($id,Request $request) {
       
        
        // $validator = Validator::make($request->all(), [
        //     'message' => "required",
        // ]);
        // if($validator->fails()) {
        //     return response(['errors' => $validator->errors()], 422);
        // }
        try {
            
            // print_r($close_data); die;
            $rti_id = $request->application_id;
            $rti = RtiApplication::where('id', $rti_id)->first();


//  return response(['errors' => ['lawyer' => [$request->lawyer." == ".$rti->lawyer_id]]], 422);


            if($request->lawyer == $rti->lawyer_id) {
            return response(['errors' => ['lawyer' => ['Please select different lawyer']]], 422);

            }

            // $data['message'] = $request->message;
            $data['status'] = 1;
             $data['request_type'] = 'old';
                          $data['new_lawyer_id'] = $request->lawyer;

            ApplicationCloseRequest::where('id', $id)->update($data);
            $close_data = ApplicationCloseRequest::where('id', $id)->get();
          

            $data_rti['lawyer_id'] = 0;
            if(!empty($request->lawyer)) {
                $data_rti['lawyer_id'] = $request->lawyer;
                RtiApplicationLawyer::create(['application_id' => $rti_id, 'lawyer_id' => $request['lawyer']]);
                SendEmail::dispatch('assign-new-lawyer', $rti);


            }
            $rti->update($data_rti);
            session()->flash('success', 'Requested Info is sended to admin.');
            return response(['status' => 'success', 'message' => ""]);
                
                
        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);

        }
        // return view('pages.rti-applications.rticloserequest-list', compact('list'));
        
    }
     public function refundRequestList(Request $request) {
        $list = RefundRequest::list(true, $request->all());
        return view('pages.rti-applications.refund.index', compact('list'));
    }

    public function refundRequestUpdate(Request $request, $id) {
        
     
        try {
            $refund = RefundRequest::find($id);
            $rti = $refund->rtiApplication;
           
           
            if($request->status != 'pending') {
                
                if($request->status == 'approve') {
                    $rti->update(['payment_status' => 'refunded']);
                }
                $refund->update(['status' => $request->status, 'comment' => $request->comment]);
    
                SendEmail::dispatch('refund-response-response', $refund);

            }
            session()->flash('success', 'Requested Info is sended to admin.');
            return response(['status' => 'success', 'message' => ""]);
                
                
        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);

        }
    }
    
    public function export(Request $request) {
        
        $list =  RtiApplication::list(false, $request->all());
   
       // Create CSV content
       $csv = fopen('php://temp', 'r+');
       fputcsv($csv, ['Application No', 'Name', 'Email', 'Phone Number', 'Service Name', 'Service Category', 'Lawyer', 'Payment Status', 'Appeal', 'Created At']); // headers
   
       foreach ($list as $item) {
           fputcsv($csv, [
            $item->application_no, 
            $item->first_name." ".$item->last_name, 
            $item->email, 
            $item->phone_number, 
            $item->service->name ?? ($item->service_id == 0 ? "Custom Request" : ''), 
            $item->serviceCategory->name ?? '',
            ($item->lawyer->first_name ?? "")." ".($item->lawyer->last_name ?? ""),
            (paymentStatus()[trim($item->payment_status)]['name'] ??''),
            (appealDetails()[$item->appeal_no] ?? ''),
            (applicationStatus()[$item->status]['name'] ??''),
            $item->created_at

        ]);
       }
   
       rewind($csv);
       $csvContent = stream_get_contents($csv);
       fclose($csv);
   
       // Return CSV download
       return Response::make($csvContent, 200, [
           'Content-Type' => 'text/csv',
           'Content-Disposition' => 'attachment; filename="rti.csv"',
       ]);
    }
    
    
   public function editRTI($id) {
    $data = RtiApplication::find($id);
    if($data && !$data->lastRevision) {
        $service_field_data = [];
        if(!empty($data->service_fields)) {
            $service_field_data = json_decode($data->service_fields, true);
        }
        $service_fields = [];
        if($data->service && !empty($data->service->fields)) {
            $service_fields = json_decode($data->service->fields, true);
        }
        return view('pages.rti-applications.edit', compact('data', 'service_field_data', 'service_fields'));

    }
    abort(404);
   }



      public function updateRTIApplication(Request $request, $application_id) {


        $application = RtiApplication::where(['id' => $application_id])->first();
        // return response(['data' => json_decode($application->service_fields)], 500);
        $application_no = $application->application_no;
        $validation = [
             'first_name' => "required|min:1|max:45|regex:/^[a-zA-Z\s.]+$/u",
                'last_name' => "required|min:1|max:45|regex:/^[a-zA-Z\s.]+$/u",
                'email' => "required|email|regex:/(.+)@(.+)\.(.+)/i|max:45",
                'phone_number' => "required|digits:10|".Rule::notIn(['6666666666', '7777777777', '8888888888', '9999999999'])."|regex:/^[6789]\d{9}$/",
                'address' => "required|min:3|max:100",
                'city' => "required|min:3|max:25",
                'state' => "required|min:3|max:25",
                'postal_code' => "required|digits:6",

        ];

        $fields = isset($application->service->fields,) ? json_decode($application->service->fields, true) : [];
        $input = $request->all();
        $filelist = [];
        foreach ($fields['field_type'] ?? [] as $key => $value) {
            // if( isset($fields['form_field_type'][$key]) ) {
            if( isset($fields['form_field_type'][$key]) && $fields['form_field_type'][$key] == "customer") {

                $slug_key = getFieldName($fields['field_lable'][$key]);
                $validation_string = '';
                if (isset($fields['is_required']) && isset($fields['is_required'][$key]) && $fields['is_required'][$key] == 'yes' && $value != 'file') {
                    $validation_string = 'required';
                }
                if (!isset($fields['is_required']) || ( isset($fields['is_required'][$key]) && $fields['is_required'][$key] == 'no')) {
                    $validation_string = 'nullable';
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

                    array_push( $filelist , $slug_key);
                    $field_data[$slug_key] = ['lable' => $fields['field_lable'][$key], 'type' => $fields['field_type'][$key], 'value' =>null];

                }
                else {

                    $field_data[$slug_key] = ['lable' => $fields['field_lable'][$key], 'type' => $fields['field_type'][$key], 'value' => $request[$slug_key]];
                }

            }
        }

        if(isset($request->rti_query)) {
            $validation['rti_query'] = 'required|max:1000';

            if(strtolower($request->pio_addr) == 'yes') {
                $validation['pio_address'] = 'required|max:500';
            }

        }

        $validation['phone_number'] = "required|digits:10|".Rule::notIn(['6666666666', '7777777777', '8888888888', '9999999999'])."|regex:/^[6789]\d{9}$/";
        $phone_number_digits = 10;
        if(!empty($request->phone_number) && $request->phone_number[0] == 0) {
            $validation['phone_number'] = "required|digits:11|".Rule::notIn(['6666666666', '7777777777', '8888888888', '9999999999'])."|regex:/^[0][6789]\d{9}$/";
            $phone_number_digits = 11;
        }

    
        // return response(['data' =>  $validation], 500);
        $validator = Validator::make($request->all(), $validation, [
            'phone_number.digits' => "Please enter a valid ".$phone_number_digits."-digit phone number.",
            'phone_number.regex' => !empty($request->phone_number) && $request->phone_number[0] == 0 ? "Phone number second digit should be started with 6, 7, 8 and 9" : "Phone number should be started with 6, 7, 8 and 9"
        ]);


    
        // return response(['data' =>  $validation], 500);
       

        
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        // return response(['data' =>  $input], 500);
        $application_no = $application->application_no;
        $input = $request->except(['_token', 'template_id']);
        
        $revision = AdminRtiBackup::create([
            'application_id' =>  $application->id,
            'details' => json_decode($application->service_fields, true),
            'user_id' =>  auth()->id(),
        ]);
       
        $input['field_data'] = $field_data;
        
        $data = $request->only(['first_name', 'last_name', 'email', 'phone_number', 'address', 'postal_code', 'city', 'state']);
        $data ['customer_pio_address'] = $request->pio_address ?? '';
        $data ['pio_address'] = $request->pio_address ?? '';
        $data['service_fields'] = json_encode($input);
        
        $application->update($data);

        session()->flash('success', "Application  Number : ".$application_no." is updated successfully.");
        return response(['status' => 'success', 'message1' => "Application  Number : ".$application_no." is sent to user for approval.", 'clean' => false, 'disabled' => true]);

    }



    public function deleteRTIApplicationDocument($id, $index) {
        try {
            $data = RtiApplication::where(['id' => $id])->first();
            if($data) {
                $documents = $data->documents;
                $filePath = public_path($documents[$index]);
                // return response(['error' => $filePath], 500);

                if (File::exists($filePath)) {
                    File::delete($filePath);
                    unset($documents[$index]);
                    $data->update(['documents' => $documents]);
                    return response(['message' => 'Data is successfully deleted']);


                }
               
            }
        
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 500);
        }
    }
    
      public function deleteRTI($id) {
        try {
            $data = $this->serviceRepository->deleteRTI($id);
            return response(['message' => 'Data is successfully deleted']);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 500);
        }
    }

}
