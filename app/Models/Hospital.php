<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Hospital extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'city', 'state', 'country', 'pincode', 'latitude', 'longitude', 'contact_nos', 'email_id', 'status', 'home_service'];
    public static function list($pagination, $filters = null) {
        $hospitals = Hospital::whereNotNull('id');
        if(isset($filters['status'])) {
            $hospitals->where('status' , $filters['status']);
        }

        if(isset($filters['home_service'])) {
            $hospitals->where('home_service' , $filters['home_service']);
        }


        if(isset($filters['latitude']) && isset($filters['longitude'])) {
            $ownerLongitude = $filters['longitude'];
            $ownerLatitude = $filters['latitude'];
            $radius = 300000000;
    
            $raw = DB::raw(' ( 6371 * acos( cos( radians(' . $ownerLatitude . ') ) * 
                    cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $ownerLongitude . ') ) + 
                    sin( radians(' . $ownerLatitude . ') ) * sin( radians( latitude ) ) ) )  AS distance');
                    
            $hospitals->select('*', $raw)
            ->addSelect($raw)
            ->orderBy('distance', 'ASC');
        }

        if($pagination) {

            return $hospitals->paginate(10);
        }
        else {
            return $hospitals->get();
        }

    }

    public function hospitalTimes() {
        return $this->hasMany(HospitalTime::class, 'hospital_id', 'id');
    }

    public function hospitalSpecialization() {
        return $this->hasMany(HospitalSpecialization::class, 'hospital_id', 'id');
    }

    public function hospitalContactPerson() {
        return $this->hasMany(HospitalContactPerson::class, 'hospital_id', 'id');
    }

    public function hospitalPrimaryImage() {
        return $this->hasOne(HospitalGallery::class, 'hospital_id', 'id')->where('is_primary', 1);
    }

    public function hospitalGalleryImage() {
        return $this->hasMany(HospitalGallery::class, 'hospital_id', 'id')->where('is_primary', 0);
    }

    public function specialities()
    {
        return $this->belongsToMany(Specialization::class, 'hospital_specializations', 'hospital_id', 'speciality_id');
    }
    
    public static function get($id) {
        return Hospital::find($id);
    }

    public function fullAddress()
    {
       return $this->address." ".$this->city." ".$this->state." ".$this->pincode;
    }
    
    public function ambulances() {
        return $this->hasMany(Ambulance::class, 'hospital_id', 'id');
    }
    
}