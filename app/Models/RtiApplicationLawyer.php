<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RtiApplicationLawyer extends Model
{
    use HasFactory;
    protected $fillable = ['lawyer_id', 'application_id'];
}
