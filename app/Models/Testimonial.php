<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = ['client_name', 'image', 'status', 'comment'];
    
    public static function list($pagination, $filters = null) {
        unset($filters['page']);

        $list = Testimonial::orderBy('id', 'desc');
        if(!empty($filters)) {
            foreach($filters as $key => $filter) {
                if($filter != null) {
                    if($key == 'search') {
                        $list->where(function($query) use($filter) {
                            $query->where('client_name', 'like', '%'.$filter.'%')
                            ->orwhere('comment', 'like', '%'.$filter.'%');
                        });
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
        return Testimonial::find($id);
    }

   
}
