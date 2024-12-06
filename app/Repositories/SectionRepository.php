<?php
namespace App\Repositories;
use App\Interfaces\SectionInterface;
use Carbon\Carbon;
use App\Models\TemplateSection;
use App\Models\TemplateSectionField;

use App\Models\SlugMaster;
use Session;
use Exception;
class SectionRepository implements SectionInterface {

    public function store($request) {
        $service = TemplateSection::create(['section' => $request['name'], 'description' => $request->description, 'slug' => $request->slug]);
        SlugMaster::create(['slug' => $request['slug'], 'linkable_id' => $service->id, 'linkable_type' => "template_sections"]);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added"]);
    }
    
    public function update($request, $id) {
        $data = ['section' => $request['name'], 'description' => $request->description, 'slug' => $request->slug];
        TemplateSection::where('id', $id)->update($data);
        if(!empty($request['slug'])) {
            SlugMaster::createUpdateSlug(['slug' => $request['slug'], 'linkable_id' => $id, 'linkable_type' => "template_sections"]);
        }
        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    

   

    public function delete($id) {
        $data = TemplateSection::where(['id' => $id])->first();
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
            'machine_key' => $request['slug']
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