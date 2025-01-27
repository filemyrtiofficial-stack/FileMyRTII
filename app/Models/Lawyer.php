<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class Lawyer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $fillable = ['first_name', 'last_name', 'dob', 'phone', 'email', 'status', 'qualification', 'about', 'image', 'experience', 'address', 'password' ];
    public static function list($pagination, $filters = null) {
        $filter_data = $filters;
        unset($filters['ids']);
        $list = Lawyer::orderBy('id', 'desc');
        if(!empty($filters)) {
            $list->where($filters);
        }
        if(isset($filter_data['ids'])) {
            $list->wherein('id', $filter_data['ids']);
        }
        if($pagination) {
            return $list->paginate(10);
        }
        else {
            return $list->get();

        }
    }
    public static function get($id) {
        return Lawyer::find($id);
    }

   
    public function getFullNameAttribute()
    {
    	return $this->first_name." ".$this->last_name;
    }

    public function rtiApplications() {
        return $this->hasMany(RtiApplication::class, 'lawyer_id', 'id');
    }
    
}
