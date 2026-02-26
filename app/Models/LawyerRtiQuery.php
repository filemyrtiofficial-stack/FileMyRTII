<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawyerRtiQuery extends Model
{
    use HasFactory;
    protected $fillable = ['application_id', 'message', 'from_id', 'from_user', 'to_id', 'to_user', 'marked_read', 'documents' , 'reply'];
    protected $casts = [
        'documents' => 'array'
    ];


    public function rtiApplication()
    {
        return $this->belongsTo(RtiApplication::class, 'application_id', 'id')->orderBy('id', 'desc');
    }

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class, 'from_id', 'id');
    }


}
