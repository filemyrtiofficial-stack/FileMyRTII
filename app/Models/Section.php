<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'data', 'sequance', 'status', 'title', 'description'];
    
    public static function list($pagination, $filters = null) {
        $filter_data = $filters;
        unset($filters['ids']);
        unset($filters['order_by']);
        unset($filters['order_by_type']);
        unset($filters['limit']);
        unset($filters['page']);


        $order_by_key = $filter_data['order_by'] ?? 'id';
        $order_by_type = $filter_data['order_by_type'] ?? 'desc';


        $list = Section::orderBy($order_by_key, $order_by_type);
          if(!empty($filters)) {
            foreach($filters as $key => $filter) {
                if($filter != null) {
                    if($key == 'title') {
                        $list->where('title', 'like', '%'.$filter.'%');
                    }
                    else {
                        $list->where($key, $filter);

                    }
                }
            }
        }
        // if(!empty($filters)) {
        //     $list->where($filters);
        // }
        if(isset($filter_data['ids'])) {
            $list->wherein('id', $filter_data['ids']);
        }
        if($pagination) {
            $limit = 10;
            if(isset($filter_data['limit'])) {
                $limit = $filter_data['limit'];
            }
            return $list->paginate($limit);
        }
        else {
            return $list->get();

        }
    }
    public static function get($id) {
        return Section::find($id);
    }

}
