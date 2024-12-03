<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorTiming extends Model
{
    use HasFactory;
    protected $fillable = ['doctor_hospital_id', 'day_number', 'day', 'start_time', 'end_time'];
}
