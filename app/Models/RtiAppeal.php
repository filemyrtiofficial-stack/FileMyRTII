<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RtiAppeal extends Model
{
    use HasFactory;
    protected $fillable = ['application_id', 'appeal_no', 'reason', 'document', 'status', 'received_appeal'];
}
