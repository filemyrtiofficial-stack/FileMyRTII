<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'icon', 'status'];
    public static function list($pagination, $filters = null) {
        $filter_data = $filters;
        unset($filters['ids']);
        unset($filters['page']);

        $list = ServiceCategory::with('services.slug')->orderBy('id', 'desc');
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
       
        if(isset($filter_data['ids'])) {
            $list->wherein('id', $filter_data['ids']);
        }
        if($pagination) {
            return $list->paginate(10);
        }
        else {
            return $list->get();

        }
    }
    public static function get($id) {
        return ServiceCategory::find($id);
    }

    public function services() {
        return $this->hasMany(Service::class, 'category_id', 'id')->where('status', true);
    }
   
      
    public function slug() {
        return $this->hasOne(SlugMaster::class, 'linkable_id', 'id')->where('linkable_type', 'service_category');
    }
    public function seo() {
        return $this->hasOne(SeoMaster::class, 'linkable_id', 'id')->where('linkable_type', 'service_category');
    }
   
    public function serviceData() {
        return $this->hasMany(ServiceCategoryData::class, 'service_category_id', 'id')->orderBy('sequance');
    }
  
}

