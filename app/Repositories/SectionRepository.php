<?php
namespace App\Repositories;
use App\Interfaces\SectionInterface;
use Carbon\Carbon;
use App\Models\Section;
use App\Models\SlugMaster;
use App\Models\TemplateSectionField;
use Session;
use Exception;
class SectionRepository implements SectionInterface {

    public function store($request) {
        $service = Section::create(['title' => $request['title'], 'description' => $request->description, 'type' => $request->section_type, 'status' => $request->status, 'data' => json_encode($request->all()), 'sequance' => $request->sequance ?? 1]);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added", 'redirect' => route('template-section.index')]);
    }
    
    public function update($request, $id) {
        $service = Section::where('id', $id)->update(['title' => $request['title'], 'description' => $request->description,'data' => json_encode($request->all()), 'status' => $request->status, 'sequance' => $request->sequance ?? 1]);
        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    

   

    public function delete($id) {
        $data = Section::where(['id' => $id])->first();
        if($data) {
            if($data->slugMaster) {
                $data->slugMaster()->delete();
            }
            $data->delete();
        }
        else {
            throw new Exception("Invalid section type");

        }
    }

    public function fieldStore($section_id, $request) {
        $service = TemplateSectionField::create([
            'template_section_id' => $section_id,
            'field_lable' => $request['name'],
            'field_key' => $request['field_type'],
            'machine_key' => $request['slug'],
            'status' => $request['status']
        ]);
        SlugMaster::create(['slug' => $request['slug'], 'linkable_id' => $service->id, 'linkable_type' => "template_section_fields"]);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added"]);
       
    }

    public function fieldUpdate($request, $id) {
        $template_field = TemplateSectionField::where('id',$id)->first();
        $template_field->field_lable = $request->name;
        $field_data = [];
        if(!empty($template_field->field_data)) {
            $field_data = json_decode($template_field->field_data, true);
        }
        foreach($request->all() as $key => $value) {
            $field_data[$key] = $value;
        }
        $template_field->field_data = json_encode($field_data);
        $template_field->save();
        Session::flash("success", "Data successfully update");
        return response(['message' => "Data successfully update"]);

    }



}