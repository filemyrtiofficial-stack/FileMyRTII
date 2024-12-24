<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RtiApplication extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'application_no', 'service_id', 'first_name', 'last_name', 'email', 'phone_number', 'address', 'postal_code', 'service_fields', 'charges', 'status', 'lawyer_id', 'payment_id', 'success_response', 'error_response'];
    public static function list($pagination, $filters = null) {
        unset($filters['page']);

        $list = RtiApplication::orderBy('id', 'desc');
        if(!empty($filters)) {
            $list->where($filters);
        }
        if($pagination) {
            return $list->paginate(10);
        }
        else {
            return $list->get();

        }
    }
}
