<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RtiApplicationRevision extends Model
{
    use HasFactory;
    protected $fillable = ['application_id', 'details', 'template', 'status', 'signature', 'customer_change_request', 'template_id'];

    public function serviceTemplate() {
        return $this->belongsTo(ServiceTemplate::class, 'template_id', 'id');
    }

    public function rtiApplication() {
        return $this->belongsTo(RtiApplication::class, 'application_id', 'id');
    }
}
