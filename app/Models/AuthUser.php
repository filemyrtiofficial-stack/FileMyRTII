<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
class AuthUser extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone_no'];
    /**
    * Get the JWT identifier.
    *
    * @return int
    */
    public function getJWTIdentifier()
    {
        return $this->id;
    }

    /**
    * Get the JWT custom claims.
    *
    * @return array
    */
    public function getJWTCustomClaims()
    {
        return []; // You can add custom claims here if needed
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];
    
   
}