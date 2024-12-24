<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'short_description', 'description', 'status', 'thumbnail', 'banner', 'publish_date'];
    public static function list($pagination, $filters = null) {
        $filter_data = $filters;
        unset($filters['ids']);
        unset($filters['limit']);
        unset($filters['page']);


       
        $list = Blog::orderBy('id', 'desc');
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
        return Blog::find($id);
    }

    public function blogCategories() {
        return $this->hasMany(BlogCategory::class, 'blog_id', 'id');
    }

    public function blogFaqs() {
        return $this->hasMany(BlogFaq::class, 'blog_id', 'id');
    }
    public function slugMaster() {
        return $this->hasOne(SlugMaster::class, 'linkable_id', 'id')->where('linkable_type', 'blogs');
    }

    public function seo() {
        return $this->hasOne(SeoMaster::class, 'linkable_id', 'id')->where('linkable_type', 'blogs');
    }
}
