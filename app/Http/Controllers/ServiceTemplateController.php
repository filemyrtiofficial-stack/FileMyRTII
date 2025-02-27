<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Repositories\ServiceRepository;
use App\Interfaces\ServiceInterface;
use Validator;
use Illuminate\Support\Str;
use App\Models\ServiceTemplate;
class ServiceTemplateController extends Controller
{
    private ServiceRepository $serviceRepository;

    public function __construct(ServiceInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
        $this->middleware(['can:Manage Service Template']); 
        $this->middleware(['can:Delete Service Template'], ['only' => ['destroy']]); 
        $this->middleware(['can:Create Service Template'], ['only' => ['create', 'store']]); 
        $this->middleware(['can:Edit Service Template'], ['only' => ['edit', 'update']]); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $service_id)
    {
        $request->merge(['service_id' => $service_id]);
        $list = ServiceTemplate::list(true, $request->all());
        $service = Service::find($service_id);
        return view('pages.service.template.index', compact('list', 'service'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($service_id)
    {
        $service = Service::find($service_id);
        $data = [];
        $fields = [];
        if($service && !empty($service->fields)) {
            $fields = json_decode($service->fields, true);
        }

        return view('pages.service.template.create', compact('service', 'data', 'fields'));


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
            'name' => "required|max:255",
            'description' => "required",

        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->serviceRepository->storeTemplate($request, $service_id);
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($service_id, $id)
    {
        $service = Service::find($service_id);
        $data = ServiceTemplate::get($id);
        return view('pages.service.template.show', compact('service', 'data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($service_id, $id)
    {
        $service = Service::find($service_id);
        $data = ServiceTemplate::get($id);
        $fields = [];
        if($service && !empty($service->fields)) {
            $fields = json_decode($service->fields, true);
        }

        return view('pages.service.template.create', compact('service', 'data', 'fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $service_id, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required|max:255",
            'description' => "required",

        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->serviceRepository->updateTemplate($request, $id);
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
        //
    }
}
