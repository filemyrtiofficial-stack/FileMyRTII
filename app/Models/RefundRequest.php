<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefundRequest extends Model
{
    use HasFactory;

    protected $fillable = ['rti_application_id', 'reason', 'status', 'comment'];
    public static function list($pagination, $filters = null) {
        $filter_data = $filters;
        unset($filters['page']);
        // unset($filters['search']);
        unset($filters['service_id']);
        unset($filters['order_by']);
        unset($filters['order_by_type']);
        $filters = array_remove_null($filters);
        $order_by_key = $filter_data['order_by'] ?? 'id';
        $order_by_type = $filter_data['order_by_type'] ?? 'desc';
        $list = RefundRequest::wherehas('rtiApplication')->orderBy('id', 'desc');
        if(!empty($filters)) {
            foreach($filters as $key => $filter) {
                if($filter != null) {
                    if ($key == 'search') {
                        $list->wherehas('rtiApplication', function ($query) use ($filter_data) {
                            $query->where('application_no', 'like', "%" . $filter_data['search'] . "%");
                        });
                    }
                    elseif($key == 'reason') {
                        $list->where('reason', 'like', '%'.$filter.'%');
                    }
                    else {
                        $list->where($key, $filter);

                    }
                }
            }
        }
        if($pagination) {
            return $list->paginate(10);
        }
        else {
            return $list->get();

        }
    }

    public function rtiApplication(){
        return $this->belongsTo(RtiApplication::class, 'rti_application_id', 'id');
    }
}
