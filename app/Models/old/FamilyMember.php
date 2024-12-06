<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'age', 'dob', 'address', 'emergency_name', 'emergency_mobile', 'relation', 'marital_status', 'member_relation', 'profile'];

    public function memberMedicalHistory() {
        return $this->hasOne(MemberMedicalHistory::class, 'member_id', 'id');
    }
}