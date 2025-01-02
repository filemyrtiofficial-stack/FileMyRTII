<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;
    protected $fillable = [ 'blog_id', 'first_name', 'last_name','email', 'comment'];
    public static function list($pagination, $filters = null)
    {
        $filter_data = $filters;
        unset($filters['page']);
        unset($filters['search']);
        unset($filters['blog']);

        $filters = array_remove_null($filters);
        $list = BlogComment::orderBy('id', 'desc');
        if (!empty($filters)) {
            foreach ($filters as $key => $filter) {
                if ($filter != null) {
                    if ($key == 'email') {
                        $list->where('email', 'like', '%' . $filter . '%');
                    } else {

                        $list->where($key, $filter);
                    }
                }
            }
        }
        if (isset($filter_data['search']) && !empty($filter_data['search'])) {
            $list->where(function ($query) use ($filter_data) {
                $query->where('first_name', 'like', '%' . $filter_data['search'] . '%')
                    ->orwhere('last_name', 'like', '%' . $filter_data['search'] . '%')
                    ->orwhere('email', 'like', '%' . $filter_data['search'] . '%');
            });
        }
        if (isset($filter_data['blog']) && !empty($filter_data['blog'])) {
            $list->wherehas('blog', function($query) use($filter_data){
                $query->where('title', 'like', '%'.$filter_data['blog'].'%');
            });
        }
        if ($pagination) {
            return $list->paginate(10);
        } else {
            return $list->get();
        }
    }
    public function blog()
    {
  
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }

}
