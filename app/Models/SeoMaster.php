<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoMaster extends Model
{
    use HasFactory;

    protected $fillable = ['linkable_id', 'linkable_type', 'meta_title', 'meta_keywords', 'meta_description'];

    public static function createUpdateSeo($data) {
        $seo = SeoMaster::where(['linkable_type' => $data['linkable_type'], 'linkable_id' => $data['linkable_id']])->first();
        if($seo) {
            $seo->update($data);
        }
        else {
            SeoMaster::create($data);
        }
    }
}
