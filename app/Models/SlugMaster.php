<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlugMaster extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'linkable_id', 'linkable_type'];

}
