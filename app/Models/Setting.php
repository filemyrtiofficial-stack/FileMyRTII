<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'data'];

    public static function getSettingData($type) {
        $setting = Setting::where(['type' => $type])->first();
        if($setting) {
            return json_decode($setting->data, true);
        }
        return [];
    }
}
