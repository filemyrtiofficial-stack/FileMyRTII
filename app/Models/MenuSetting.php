<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuSetting extends Model
{
    use HasFactory;
    protected $fillable = [
		'name','position','data', 'status'
	];


	public static function MenuPositions()
    {
        $data['header']="Header";
        $data['second_header']="Second Header";
        $data['quick_links']="Quick Links";
        $data['footer_links']="Footer Links";


        return $data;
    }

    public static function getMenuData($type) {
        $data =  MenuSetting::where('position', $type)->where('status', 1)->first();
        if($data) {
            return json_decode($data['data'], true);
        }
        return [];
    }

}
