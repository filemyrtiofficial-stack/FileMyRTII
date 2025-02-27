<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Repositories\ServiceCategoryRepository;
use App\Interfaces\ServiceCategoryInterface;
use Validator;
use App\Models\ServiceCategoryData;

class ServiceCategoryController extends Controller
{
    private ServiceCategoryRepository $serviceCategoryRepository;

    public function __construct(ServiceCategoryInterface $serviceCategoryRepository)
    {
        $this->serviceCategoryRepository = $serviceCategoryRepository;
        $this->middleware(['can:Manage Service category']); 
        $this->middleware(['can:Delete Service category'], ['only' => ['destroy']]); 
        $this->middleware(['can:Create Service category'], ['only' => ['create', 'store']]); 
        $this->middleware(['can:Edit Service category'], ['only' => ['edit', 'update']]); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = ServiceCategory::list(true, $request->all());
        return view('pages.service.category.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        return view('pages.service.category.create');

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
            'name' => "required|max:255|unique:service_categories,name",
            // 'icon' => "required",
            'status' => "required"
        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->serviceCategoryRepository->store($request);
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
        $data = ServiceCategory::get($id);
        return view('pages.service.category.create', compact('data'));

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
            'name' => "required|max:255|unique:service_categories,name,".$id,
            'status' => "required"
        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->serviceCategoryRepository->update($request, $id);
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
            $data = $this->serviceCategoryRepository->delete($id);
            return response(['message' => 'Data is successfully deleted']);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 500);
        }
    }

    public function getSectionServices($page_id, $section_key, $id = null) {
        $data = [];
        if($id != null) {
            $data = ServiceCategoryData::where(['service_category_id' => $page_id, 'id' => $id])->first();
            $data = json_decode($data->data, true);
        }
        $template = templateList()[$section_key];
        // print_r(json_encode( $template));
        $page_type = "service-category";
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

}
