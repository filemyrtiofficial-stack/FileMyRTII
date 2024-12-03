<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorHospitalTime extends Model
{
    use HasFactory;
    protected $fillable = ['doctor_hospital_id','day', 'times', 'day_number'];
}
