<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTime extends Model
{
    use HasFactory;
    protected $fillable = ['day', 'opening_time', 'closing_time', 'lab_id', 'day_number'];

}
