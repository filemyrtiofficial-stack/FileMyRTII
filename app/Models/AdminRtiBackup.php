<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRtiBackup extends Model
{
    use HasFactory;
    protected $fillable = ['rti_application_id', 'backup', 'user_id'];
    protected $casts = [
        'backup' => 'array'
    ];

}
