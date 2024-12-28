<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'status', 'token'];
    public static function list($pagination, $filters = null) {
        unset($filters['page']);
        $filters = array_remove_null($filters);
        $list = Newsletter::orderBy('id', 'desc');
        if(!empty($filters)) {
            foreach($filters as $key => $filter) {
                if($filter != null) {
                    if($key == 'email') {
                        $list->where('email' , 'like', '%'.$filter.'%');
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
        return Newsletter::find($id);
    }
}
