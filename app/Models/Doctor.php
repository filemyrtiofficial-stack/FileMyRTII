<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'address', 'city', 'state', 'country', 'pincode', 'email_id', 'contact_no', 'status', 'experience', 'dob', 'fee', 'profile', 'about', 'qualification'];

    // public function hospitalTimes() {
    //     return $this->hasMany(HospitalTime::class, 'hospital_id', 'id');
    // }

    public function doctorHospitals() {
        return $this->hasMany(DoctorHospital::class, 'doctor_id', 'id')->wherehas('hospital');
    }


    public function doctorSpecialization() {
        return $this->hasMany(DoctorSpeciality::class, 'doctor_id', 'id');
    }

    public static function list($pagination, $filters = null) {
        $doctors = Doctor::whereNotNull('doctors.id');
        if(isset($filters['status'])) {
            $doctors->where('doctors.status' , $filters['status']);
        }

        if(isset($filters['latitude']) && isset($filters['longitude'])) {
            $ownerLongitude = $filters['longitude'];
            $ownerLatitude = $filters['latitude'];
            $radius = 300000;
            $time = Carbon::now();
            $doctors->join('doctor_hospitals', 'doctor_hospitals.doctor_id', '=', 'doctors.id')
            ->join('hospitals', 'hospitals.id', '=', 'doctor_hospitals.hospital_id')
            ->join('doctor_timings', 'doctor_hospitals.id', '=', 'doctor_timings.doctor_hospital_id')
            ->where('doctor_timings.day', strtolower(Carbon::now()->format('l')))
            ->where('start_time', '<=', $time)
            ->where('end_time', '>=', $time)
            ;
    
            $raw = DB::raw(' ( 6371 * acos( cos( radians(' . $ownerLatitude . ') ) * 
                    cos( radians( hospitals.latitude ) ) * cos( radians( hospitals.longitude ) - radians(' . $ownerLongitude . ') ) + 
                    sin( radians(' . $ownerLatitude . ') ) * sin( radians( hospitals.latitude ) ) ) )  AS distance');
                    
            $doctors->select('doctors.*', $raw)
            ->addSelect($raw)
            ->orderBy('distance', 'ASC');
            
        }



        if($pagination) {

            return $doctors->paginate(10);
        }
        else {
            return $doctors->get();
        }
    }
    public static function get($id) {
        return Doctor::find($id);
    }
    public function fullAddress()
    {
       return $this->address." ".$this->city." ".$this->state." ".$this->pincode;
    }

    public function specialities()
    {
        return $this->belongsToMany(Specialization::class, 'doctor_specialities', 'doctor_id', 'speciality_id');
    }

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class, 'doctor_hospitals', 'doctor_id', 'hospital_id');
    }
    
    
}
