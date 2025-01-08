<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RtiApplication extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'application_no', 'service_id', 'first_name', 'last_name', 'email', 'phone_number', 'address', 'postal_code', 'service_fields', 'charges', 'status', 'lawyer_id', 'payment_id', 'success_response', 'error_response', 'service_category_id'];

    public static function list($pagination, $filters = null)
    {
        $filter_data = $filters;
        unset($filters['page']);
        unset($filters['search']);
        unset($filters['service_id']);

        $filters = array_remove_null($filters);
        $list = RtiApplication::orderBy('id', 'desc');
        if (!empty($filters)) {
            foreach ($filters as $key => $filter) {
                if ($filter != null) {
                    if ($key == 'email') {
                        $list->where('email', 'like', '%' . $filter . '%');
                    } else {

                        $list->where($key, $filter);
                    }
                }
            }
        }
        if (isset($filter_data['search']) && !empty($filter_data['search'])) {
            $list->where(function ($query) use ($filter_data) {
                $query->where('first_name', 'like', '%' . $filter_data['search'] . '%')
                    ->orwhere('last_name', 'like', '%' . $filter_data['search'] . '%')
                    ->orwhere('email', 'like', '%' . $filter_data['search'] . '%')
                    ->orwhere('phone_number', 'like', '%' . $filter_data['search'] . '%');
            });
        }
        if (isset($filter_data['service_id']) && !empty($filter_data['service_id'])) {
            $list->wherehas('service', function($query) use($filter_data){
                $query->where('id', 'like', '%'.$filter_data['service_id'].'%');
            });
        }
        if ($pagination) {
            return $list->paginate(10);
        } else {
            return $list->get();
        }
    }


    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id', 'id');
    }
}
