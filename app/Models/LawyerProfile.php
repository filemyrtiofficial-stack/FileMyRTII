<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawyerProfile extends Model
{
    use HasFactory;
    protected $fillable = [
    'lawyer_id' ,
    'father_spouse_name' ,
    'mother_name' ,
    'gender' ,
    'marital_status',
    'alternative_phone_no' ,
    'personal_email_id',
    'date_of_joining',
    'package_details',
    'bank_account_holder',
    'bank_name' ,
    'bank_address' ,
    'bank_account_number',
    'bank_ifsc_code' ,
    'attachments',
    'blood_group' ,
    'exit_date',
    'remarks' ];
    protected $casts = [
        'attachments' => 'array'
    ];
}
