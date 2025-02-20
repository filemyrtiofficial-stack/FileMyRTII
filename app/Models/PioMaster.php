<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PioMaster extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone_number', 'address', 'city', 'state', 'pincode', 'image', 'status', 'mandal', 'tahsildar', 'department'];
    public static function list($pagination, $filters = null) {
        $filter_data = $filters;
        unset($filters['ids']);
        unset($filters['page']);
        $list = PioMaster::orderBy('id', 'desc');

        if(!empty($filters)) {
            foreach($filters as $key => $filter) {
                if($filter != null) {
                    if($key == 'address') {
                        $list->where('address', 'like', '%'.$filter.'%');
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
        return PioMaster::find($id);
    }



}
