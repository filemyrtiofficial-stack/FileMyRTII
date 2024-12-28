<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlugMaster extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'linkable_id', 'linkable_type'];

    
    public static function createUpdateSlug($data) {
        $seo = SlugMaster::where(['linkable_type' => $data['linkable_type'], 'linkable_id' => $data['linkable_id']])->first();
        if($seo) {
            $seo->update($data);
        }
        else {
            SlugMaster::create($data);
        }
    }

}
