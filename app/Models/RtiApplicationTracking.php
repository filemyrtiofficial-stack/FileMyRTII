<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RtiApplicationTracking extends Model
{
    use HasFactory;
    protected $fillable = ['courier_name', 'courier_date', 'courier_tracking_number', 'charges', 'address', 'revision_id', 'application_id', 'documents'];
    protected $casts = [
        'documents' => 'array'
    ];

}
