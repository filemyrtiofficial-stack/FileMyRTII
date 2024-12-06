<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabGallery extends Model
{
    use HasFactory;
    protected $fillable = ['is_primary', 'lab_id', 'image'];

}
