<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSection extends Model
{
    use HasFactory;
    protected $fillable = ['section', 'description', 'slug'];
    
    public static function list($pagination, $filters = null) {
        unset($filters['page']);

        $list = TemplateSection::orderBy('id', 'desc');
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
        return TemplateSection::find($id);
    }

    public function slugMaster() {
        return $this->hasOne(SlugMaster::class, 'linkable_id', 'id')->where('linkable_type', 'template_sections');
    }

    
   
}
