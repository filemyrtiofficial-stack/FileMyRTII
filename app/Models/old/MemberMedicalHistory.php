<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberMedicalHistory extends Model
{
    use HasFactory;
    protected $fillable = ['member_id','height', 'weight', 'blood_group', 'allergy', 'habit', 'menstrual_start_date', 'hospitalization'];
}