<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'icon', 'status', 'description', 'category_id', 'fields'];
    protected $with = ['slug'];
    
    public static function list($pagination, $filters = null) {
        $list = Service::orderBy('id', 'desc');
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
        return Service::find($id);
    }

    public function category() {
        return $this->belongsTo(ServiceCategory::class, 'category_id', 'id');
    }
   
    public function slug() {
        return $this->hasOne(SlugMaster::class, 'linkable_id', 'id')->where('linkable_type', 'services');
    }
   
  
}
