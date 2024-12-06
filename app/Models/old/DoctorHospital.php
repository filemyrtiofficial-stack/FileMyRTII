<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorHospital extends Model
{
    use HasFactory;
    protected $fillable = ['hospital_id', 'doctor_id', 'times'];

    public function hospitaTimes() {
        return $this->hasMany(DoctorHospitalTime::class, 'doctor_hospital_id', 'id')->orderBy('day_number');
    }

    public function hospitaTiming() {
        return $this->hasMany(DoctorTimeing::class, 'doctor_hospital_id', 'id')->orderBy('day_number');
    }

    public function hospital() {
        return $this->belongsTo(Hospital::class, 'hospital_id', 'id');
    }
}
