<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Repositories\SectionRepository;
use App\Interfaces\SectionInterface;
use Validator;
class SectionController extends Controller
{
    private SectionRepository $sectionRepository;

    public function __construct(SectionInterface $sectionRepository)
    {
        $this->sectionRepository = $sectionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Section::list(true, $request->all());
        return view('backend.template.sections.index', compact('list'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.template.sections.create');

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
            'title' => "required|unique:sections,title",
            'description' => "required",


        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->sectionRepository->store($request);
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
        $data = Section::get($id);
        $details = json_decode($data->data, true);
        return view('backend.template.sections.create', compact('data', 'details'));

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
            'name' => "required|unique:template_sections,section,".$id,
            'slug' => "required",
            'description' => "required",

        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $template = TemplateSection::get($id);
        if($template && $template->slug && checkSlug($request->slug, $template->slugMaster->id)) {
            return response(['errors' => ['slug' => "This slug is already exist"]], 422);

        }
        $data = $this->sectionRepository->update($request, $id);
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
            $data = $this->sectionRepository->delete($id);
            return response(['message' => 'Data is successfully deleted']);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 500);
        }
    }

    public function fieldIndex(Request $request, $section_id) {
        $list = TemplateSectionField::list(true, ['template_section_id' => $section_id]);
        return view('backend.template.section.fields.index', compact('list', 'section_id'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fieldCreate($section_id)
    {
        return view('backend.template.section.fields.create', compact('section_id'));

    }
    public function fieldStore(Request $request, $section_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required",
            'slug' => "required|unique:slug_masters,slug",
            'field_type' => "required",


        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->sectionRepository->fieldStore($section_id, $request);
        return $data;
    }
    public function fieldEdit($section_id, $id)
    {
        $data = TemplateSectionField::get($id);
        $field_data = json_decode($data->field_data, true);
        return view('backend.template.section.fields.edit', compact('data', 'field_data'));

    }
    public function fieldUpdate($id, Request $request)
    {
        $validate_data = [
            'name' => "required",
            'number_of_value_type' => 'required'
        ];
        if($request->number_of_value_type == 'limited') {
            $validate_data['number_of_value_count'] = 'required|min:1';
        }
        $validator = Validator::make($request->all(), $validate_data);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $template = TemplateSectionField::get($id);
        if($template && $template->slug && checkSlug($request->slug, $template->slugMaster->id)) {
            return response(['errors' => ['slug' => "This slug is already exist"]], 422);

        }
        $data = $this->sectionRepository->fieldUpdate($request, $id);
        return $data;
    }


    public function getSectionHtml(Request $request) {
        // $template = TemplateSection::get($request->section_id);
        // $data = TemplateSectionField::list(false,['template_section_id' =>  $request->section_id]);
        $template = templateList()[$request->section_id];
        $html = view('backend.template.pages.section.'.$request->section_id, compact('template'))->render();
        return response(['data' =>  $template, 'html' => $html]);

    }

}
