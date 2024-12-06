<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Lab extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'city', 'state', 'country', 'pincode', 'latitude', 'longitude', 'contact_nos', 'email_id', 'status', 'contact_person'];

    public static function list($pagination, $filters = null) {
        $hospitals = Lab::whereNotNull('id');
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

    public function labTimes() {
        return $this->hasMany(LabTime::class, 'lab_id', 'id');
    }

    public function labTestList() {
        return $this->hasMany(LabTestList::class, 'lab_id', 'id');
    }

    public function labTests()
    {
        return $this->belongsToMany(LabTest::class, 'lab_test_lists', 'lab_id', 'lab_test_id');
    }
    
    public function labPrimaryImage() {
        return $this->hasOne(LabGallery::class, 'lab_id', 'id')->where('is_primary', 1);
    }

    public function labGalleryImage() {
        return $this->hasMany(LabGallery::class, 'lab_id', 'id')->where('is_primary', 0);
    }

    
    public static function get($id) {
        return Lab::find($id);
    }

    public function fullAddress()
    {
       return $this->address." ".$this->city." ".$this->state." ".$this->pincode;
    }
   
    

}
