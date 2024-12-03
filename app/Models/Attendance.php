<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [ 'date_time_string', 'no', 'tmno', 'empno', 'name', 'gmno', 'mode', 'in_out', 'anti_pass', 'proxy', 'date_time', 'attendance_date', 'attendance_time'];
}
