<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalSpecialization extends Model
{
    use HasFactory;
    protected $fillable = ['speciality_id', 'hospital_id'];
}