<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageData extends Model
{
    use HasFactory;
    protected $fillable = ['page_id', 'template_section_id', 'data', 'section_key'];

}
