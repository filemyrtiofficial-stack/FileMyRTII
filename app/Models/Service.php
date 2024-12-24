<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'icon', 'status', 'description', 'category_id', 'fields', 'faq', 'mobile_banner', 'desktop_banner', 'image_1', 'image_2'];
    protected $with = ['slug'];
    
    public static function list($pagination, $filters = null) {
        unset($filters['page']);

        $list = Service::orderBy('id', 'desc');
        if(!empty($filters)) {
            foreach($filters as $key => $filter) {
                if($filter != null) {
                    if($key == 'name') {
                        $list->where('name', 'like', '%'.$filter.'%');
                    }
                    else {
                        $list->where($key, $filter);

                    }
                }
            }
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
    public function seo() {
        return $this->hasOne(SeoMaster::class, 'linkable_id', 'id')->where('linkable_type', 'services');
    }
   
    public function serviceData() {
        return $this->hasMany(serviceData::class, 'service_id', 'id')->orderBy('sequance');
    }
  
}
