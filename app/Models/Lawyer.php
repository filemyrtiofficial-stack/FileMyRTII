<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class Lawyer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $fillable = ['first_name', 'last_name', 'dob', 'phone', 'email', 'status', 'qualification', 'about', 'image', 'experience', 'address', 'password' ];
    public static function list($pagination, $filters = null) {
        $filter_data = $filters;
        unset($filters['ids']);
        unset($filters['page']);
        unset($filters['daterange']);


        $list = Lawyer::orderBy('id', 'desc');
        if(!empty($filters)) {
            foreach($filters as $key => $filter) {
                if($filter != null) {
                    if($key == 'search') {
                        $list->where(function($query) use($filter) {
                            $query->where('first_name', 'like', '%'.$filter.'%')
                            ->orwhere('last_name', 'like', '%'.$filter.'%')
                            ->orwhere('phone', 'like', '%'.$filter.'%')
                            ->orwhere('email', 'like', '%'.$filter.'%');
                        });
                    }
                    else {
                        $list->where($key, $filter);

                    }
                }
            }
        }
         if(!empty($filter_data['daterange'])) {
            $date = explode(' - ', $filter_data['daterange']);
            // dd($date);
            $list->withCount(['rtiApplications' => function ($query) use($date) {
                $query->wheredate('created_at', '>=', Carbon::parse($date[0]))
                ->wheredate('created_at', '<', Carbon::parse($date[1]));
            }])
            ->withCount(['rtiApplications as filed_rti_count' => function ($query) use($date) {
                $query->where('status', 3)
                ->wheredate('created_at', '>=', Carbon::parse($date[0]))
                ->wheredate('created_at', '<', Carbon::parse($date[1]));
            }])
            ->withCount(['rtiApplications as pending_rti_count' => function ($query) use($date) {
                $query->where('status', '!=', 3)
                ->wheredate('created_at', '>=', Carbon::parse($date[0]))
                ->wheredate('created_at', '<', Carbon::parse($date[1]));
            }]);
        }
        else {
            $list->withCount('rtiApplications')
            ->withCount(['rtiApplications as filed_rti_count' => function ($query) {
                $query->where('status', 3);
            }])
            ->withCount(['rtiApplications as pending_rti_count' => function ($query) {
                $query->where('status', '!=', 3);
            }]);
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
    public function lawyerProfile()
    {
        return $this->hasOne(LawyerProfile::class, 'lawyer_id', 'id');
    }

    
}
