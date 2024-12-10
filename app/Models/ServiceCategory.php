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
        $list = ServiceCategory::with('services')->orderBy('id', 'desc');
        if(!empty($filters)) {
            $list->where($filters);
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
   
  
}

