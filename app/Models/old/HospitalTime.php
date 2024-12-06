<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalTime extends Model
{
    use HasFactory;
    protected $fillable = ['day', 'opening_time', 'closing_time', 'hospital_id', 'day_number'];
}