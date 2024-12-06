<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\TemplateSection;
use App\Repositories\TemplateRepository;
use App\Interfaces\TemplateInterface;
use Validator;
use App\Models\PageData;
class TemplateController extends Controller
{
    private TemplateRepository $templateRepository;

    public function __construct(TemplateInterface $templateRepository)
    {
        $this->templateRepository = $templateRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Page::list(true, $request->all());
        return view('backend.template.pages.index', compact('list'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = TemplateSection::list(false);

        return view('backend.template.pages.create', compact('sections'));

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
            'title' => "required|unique:pages,title",
            'slug' => "required|unique:slug_masters,slug",
            'description' => "required",


        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->templateRepository->store($request);
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
        $data = Page::get($id);
        $template_data = isset($data->getData) ? json_decode($data->getData, true) : [];
        $page_data = PageData::where(['page_id' => $id])->get();
        return view('backend.template.pages.edit', compact('data', 'template_data', 'page_data'));

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
            'title' => "required|unique:pages,title,".$id,
            'slug' => "required",
            'description' => "required",

        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $template = Page::get($id);
        if($template && $template->slug && checkSlug($request->slug, $template->slugMaster->id)) {
            return response(['errors' => ['slug' => "This slug is already exist"]], 422);

        }
        $data = $this->templateRepository->update($request, $id);
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
            $data = $this->templateRepository->delete($id);
            return response(['message' => 'Data is successfully deleted']);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 500);
        }
    }

    public function uploadImages(Request $request) {
        $key = "file";
        $path = "test";
        $file_list = [];
        $path = '/upload/'.$path;
        $image_list = uploadFile($request, 'file', 'test');
        return response(['data'=>$image_list]);
        
        if($request->hasFile($key))
        {
            $files = $request->file($key);
            foreach($files as $file){
    
                $filenameWithExt = $file->getClientOriginalName();
                return response(['data'=>$filenameWithExt]);
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $destinationPath = public_path().$path ;
                $file->move($destinationPath,$fileNameToStore);
    
                // $path = $file->storeAs('public/'.$path,$fileNameToStore);
                array_push($file_list, $path."/".$fileNameToStore);
            }
        }
        return response(['data'=>$file_list]);


    }

    public function updateSectionDetails(Request $request, $page_id) {
        
        $data = $this->templateRepository->updateSectionDetails($request, $page_id);
        return $data;
    }

    public function addPageSection(Request $request, $page_id) {

    }

    public function getSectionPage($page_id, $section_key, $id = null) {
        $data = [];
        if($id != null) {
            $data = PageData::where(['page_id' => $page_id, 'id' => $id])->first();
            $data = json_decode($data->data, true);
        }
        $template = templateList()[$section_key];
        // print_r(json_encode( $template));
       return view('backend.template.pages.section.'.$section_key, compact('template', 'page_id', 'section_key', 'id', 'data'));
    }
}
