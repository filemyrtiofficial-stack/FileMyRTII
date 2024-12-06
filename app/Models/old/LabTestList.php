<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTestList extends Model
{
    use HasFactory;
    protected $fillable = ['lab_id', 'lab_test_id', 'status'];
}
