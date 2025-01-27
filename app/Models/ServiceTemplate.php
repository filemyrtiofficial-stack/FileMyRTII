<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTemplate extends Model
{
    use HasFactory;
    protected $fillable = ['service_id', 'template_name', 'template', 'title', 'sub_title'];
    public static function list($pagination, $filters = null) {
        unset($filters['page']);
        unset($filters['order_by']);
        unset($filters['order_by_type']);
        unset($filters['limit']);
        


        $order_by_key = $filter_data['order_by'] ?? 'id';
        $order_by_type = $filter_data['order_by_type'] ?? 'desc';

        $list = ServiceTemplate::orderBy('id', 'desc');
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
        return ServiceTemplate::find($id);
    }

}
