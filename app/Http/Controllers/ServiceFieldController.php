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


class ServiceFieldController extends Controller
{
    private ServiceRepository $serviceRepository;

    public function __construct(ServiceInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
        $this->middleware(['can:Manage Service'], ['only' => ['index', 'destroy', 'create', 'store', 'edit', 'update']]); 
        $this->middleware(['can:Delete Service'], ['only' => ['destroy']]); 
        $this->middleware(['can:Create Service'], ['only' => ['create', 'store']]); 
        $this->middleware(['can:Edit Service'], ['only' => ['edit', 'update']]); 

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $service_id)
    {

        $data = Service::get($service_id);
        $fields = [];
        if($data && !empty($data->fields)) {
            $fields = json_decode($data->fields, true);
        }
        return view('pages.service.fields.index', compact('data','fields'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $categories = ServiceCategory::list(false, ['status' => true]);

        // return view('pages.service.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $service_id)
    {
        $validator = Validator::make($request->all(), [
            // 'name' => "required|unique:services,name",
            'form_field_type.*' => "required",
            'field_type.*' => "required",
            'field_lable.*' => "required",
            'document_placeholder.*' => "required"


        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->serviceRepository->storeFields($request, $service_id);
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
        // $data = Service::get($id);
        // $categories = ServiceCategory::list(false, ['status' => true]);
        // $fields = [];
        // if($data && !empty($data->fields)) {
        //     $fields = json_decode($data->fields, true);
        // }
        // return view('pages.service.create', compact('data', 'categories', 'fields'));

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
        // $validator = Validator::make($request->all(), [
        //     // 'name' => "required|unique:services,name,".$id,
        //     'name' => "required|max:255",

        //     'status' => "required",
        //     'slug' => "required",
        //     'description' => "required",
        //     'category' => "required"
        // ]);
        // if($validator->fails()) {
        //     return response(['errors' => $validator->errors()], 422);
        // }
        // $service = Service::get($id);
        // if($service && $service->slug && checkSlug($request->slug, $service->slug->id)) {
        //     return response(['errors' => ['slug' => "This slug is already exist"]], 422);

        // }
        // $data = $this->serviceRepository->update($request, $id);
        // return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // try {
        //     $data = $this->serviceRepository->delete($id);
        //     return response(['message' => 'Data is successfully deleted']);
        // } catch (Exception $ex) {
        //     return response(['error' => $ex->getMessage()], 500);
        // }
    }
   
}
