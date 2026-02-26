<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'email',
        'password',
        'address',
        'city',
        'country',
        'postal',
        'about',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
    * @return string
    */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public static function list($pagination, $filters = null) {
        $filter_data = $filters;
        unset($filters['ids']);
        unset($filters['page']);
        
        $list = User::orderBy('id', 'desc');
        if(!empty($filters)) {
            foreach($filters as $key => $filter) {
                if($filter != null) {
                    if($key == 'search') {
                        $list->where(function($query) use($filter) {
                            $query->where('firstname', 'like', '%'.$filter.'%')
                            ->orwhere('email', 'like', '%'.$filter.'%');
                        });
                    }
                    else {
                        $list->where($key, $filter);

                    }
                }
            }
        }

        // if(!empty($filters)) {
        //     $list->where($filters);
        // }
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
        return User::find($id);
    }


}