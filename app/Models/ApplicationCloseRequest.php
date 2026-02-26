<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationCloseRequest extends Model
{
    use HasFactory;
    protected $fillable = ['application_id', 'message', 'lawyer_id', 'status', 'request_type', 'new_lawyer_id'];


    
    public static function list($pagination, $filters = null)
    {
        $filter_data = $filters;
        unset($filters['page']);
        // unset($filters['search']);
        unset($filters['service_id']);
        unset($filters['order_by']);
        unset($filters['order_by_type']);
        $filters = array_remove_null($filters);
        $order_by_key = $filter_data['order_by'] ?? 'id';
        $order_by_type = $filter_data['order_by_type'] ?? 'desc';
        $list = ApplicationCloseRequest::wherehas('rtiApplication')->orderBy($order_by_key, $order_by_type);
        if (!empty($filters)) {
            foreach ($filters as $key => $filter) {
                if ($filter != null) {
                    if ($key == 'search') {
                        $list->wherehas('rtiApplication', function ($query) use ($filter_data) {
                            $query->where('application_no', 'like', "%" . $filter_data['search'] . "%");
                        });
                    }
                        elseif ($key == 'lawyer_id') {
                          
                                $list->where('lawyer_id', 'like', "%" . $filter . "%");
                          
                    } elseif ($key == 'date') {
                        $list->wheredate('created_at', $filter);
                    } else {

                        $list->where($key, $filter);
                    }
                }
            }
        }
        // if (isset($filter_data['service_id']) && !empty($filter_data['service_id'])) {
        //     $list->wherehas('service', function ($query) use ($filter_data) {
        //         $query->where('id', $filter_data['service_id']);
        //     });
        // }
    
        if ($pagination) {
            return $list->paginate(10);
        } else {
            return $list->get();
        }
    }

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class, 'lawyer_id', 'id');
    }
    public function rtiApplication()
    {
        return $this->belongsTo(RtiApplication::class, 'application_id', 'id');
    }
     public function newLawyer()
    {
        return $this->belongsTo(Lawyer::class, 'new_lawyer_id', 'id');
    }
}
