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
        $data['footer_left']="Footer left";
        $data['footer_right']="Footer right";
        $data['footer_center']="Footer center";

        return $data;
    }

}
