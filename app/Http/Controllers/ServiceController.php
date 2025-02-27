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
        if($id != null) {
            $data = ServiceData::where(['service_id' => $page_id, 'id' => $id])->first();
            $data = json_decode($data->data, true);
        }
        $template = templateList()[$section_key];
        // print_r(json_encode( $template));
        $page_type = "service";
       return view('backend.template.pages.section.'.$section_key, compact('template', 'page_id', 'section_key', 'id', 'data', 'page_type'));
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
        // echo "hello";die('kkk');
        $list = RtiApplication::list(true, $request->all());
        return view('pages.rti-applications.index', compact('list'));
        
    }

    public function view(Request $request, $id) {
        $data = RtiApplication::get($id);
        if(!$data) {
            abort(404);
        }
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
       
        
        $validator = Validator::make($request->all(), [
            'message' => "required",
        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        try {
            
       ;
            $data['message'] = $request->message;
            $data['status'] = 1;
            ApplicationCloseRequest::where('id', $id)->update($data);
            $close_data = ApplicationCloseRequest::where('id', $id)->get();
            // print_r($close_data); die;
            $rti_id = $request->application_id;
            $data_rti['lawyer_id'] = 0;
            RtiApplication::where('id', $rti_id)->update($data_rti);
            session()->flash('success', 'Requested Info is sended to admin.');
            return response(['status' => 'success', 'message' => ""]);
                
                
        } catch (\Throwable $th) {
            return response(['errors' => $th->getMessage()], 500);

        }
        // return view('pages.rti-applications.rticloserequest-list', compact('list'));
        
    }

}
