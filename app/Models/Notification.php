<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['linkable_id', 'linkable_type', 'type', 'message', 'from_id', 'from_type', 'to_id', 'to_type', 'additional', 'is_read'];
    protected $casts = [
        'additional' => 'array'
    ];

}
