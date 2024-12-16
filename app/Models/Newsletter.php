<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'status', 'token'];
    public static function list($pagination, $filters = null) {
        $filters = array_remove_null($filters);
        $list = Newsletter::orderBy('id', 'desc');
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
        return Newsletter::find($id);
    }
}
