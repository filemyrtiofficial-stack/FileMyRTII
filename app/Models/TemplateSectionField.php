<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSectionField extends Model
{
    use HasFactory;
    protected $fillable = ['template_section_id', 'field_lable', 'machine_key', 'field_key', 'field_data'];
    
    public static function list($pagination, $filters = null) {
        unset($filters['page']);

        $list = TemplateSectionField::orderBy('id', 'desc');
        if(!empty($filters)) {
            $list->where($filters);
        }
        if($pagination) {
            return $list->paginate(10);
        }
        else {
            return $list->get();

        }
    }
    public static function get($id) {
        return TemplateSectionField::find($id);
    }

    public function slugMaster() {
        return $this->hasOne(SlugMaster::class, 'linkable_id', 'id')->where('linkable_type', 'template_section_fields');
    }

}
