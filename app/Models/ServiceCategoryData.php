<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategoryData extends Model
{
    use HasFactory;
    protected $fillable = ['service_category_id', 'template_section_id', 'data', 'section_key', 'sequance'];

}

