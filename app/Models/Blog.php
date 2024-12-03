<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'short_description', 'description', 'status', 'thumbnail', 'banner', 'publish_date'];
    public static function list($pagination, $filters = null) {
        $list = Blog::orderBy('id', 'desc');
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
        return Blog::find($id);
    }

    public function blogCategories() {
        return $this->hasMany(BlogCategory::class, 'blog_id', 'id');
    }

    public function blogFaqs() {
        return $this->hasMany(BlogFaq::class, 'blog_id', 'id');
    }
}
