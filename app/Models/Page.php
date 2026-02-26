<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'status'];
    
    public static function list($pagination, $filters = null) {
        unset($filters['page']);
        $list = Page::orderBy('id', 'desc');
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
        if($pagination) {
            return $list->paginate(10);
        }
        else {
            return $list->get();

        }
    }
    public static function get($id) {
        return Page::find($id);
    }

    public function slugMaster() {
        return $this->hasOne(SlugMaster::class, 'linkable_id', 'id')->where('linkable_type', 'pages');
    }

    public function seo() {
        return $this->hasOne(SeoMaster::class, 'linkable_id', 'id')->where('linkable_type', 'pages');
    }

    public function getData() {
        return $this->hasMany(PageData::class, 'page_id', 'id')->orderBy('sequance');
    }
    
    public function pageData() {
        return $this->hasMany(PageData::class, 'page_id', 'id')->orderBy('sequance');
    }
}
