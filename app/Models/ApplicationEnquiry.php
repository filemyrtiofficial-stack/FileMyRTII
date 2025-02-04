<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationEnquiry extends Model
{
    use HasFactory;
    protected $fillable = ['application_id', 'query', 'reply', 'documents', 'status'];
}
