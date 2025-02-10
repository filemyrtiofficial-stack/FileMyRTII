<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationCloseRequest extends Model
{
    use HasFactory;
    protected $fillable = ['application_id', 'message', 'lawyer_id', 'status'];
}
