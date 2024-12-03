<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    use HasFactory;
    protected $fillable = ['hospital_id', 'ambulance_no', 'contact_person', 'contact_no', 'status'];

    public function hospital() {
        return $this->belongsTo(Hospital::class, 'hospital_id', 'id');
    }

    public static function list($pagination, $filters = null) {
        $list = Ambulance::whereNotNull('id');
        if(isset($filters['status'])) {
            $list->where('status' , $filters['status']);
        }

        if($pagination) {

            return $list->paginate(10);
        }
        else {
            return $list->get();
        }

    }

}
