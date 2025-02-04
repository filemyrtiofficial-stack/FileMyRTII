<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RtiApplication extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id', 'application_no', 'service_id', 'first_name', 'last_name', 'email', 'phone_number', 'address', 'postal_code', 'service_fields', 'charges', 'status', 'lawyer_id', 'payment_id', 'success_response', 'error_response', 'service_category_id', 'payment_status', 'payment_details', 'signature_type', 'signature_image', 'documents'];

    protected $casts = [
        'documents' => 'array'
    ];


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

        $list = RtiApplication::with('service')->orderBy($order_by_key, $order_by_type);
        if (!empty($filters)) {
            foreach ($filters as $key => $filter) {
                if ($filter != null) {
                    if ($key == 'email') {
                        $list->where('email', 'like', '%' . $filter . '%');
                    }
                    elseif ($key == 'search') {
                        $list->where(function($query) use($filter){
                            $query->where('application_no', 'like', "%".$filter."%")
                            ->orwhere('first_name', 'like', "%".$filter."%")
                            ->orwhere('last_name', 'like', "%".$filter."%")
                            ->orwhere('email', 'like', "%".$filter."%")
                            ->orwhere('phone_number', 'like', "%".$filter."%");

                        });
                    }
                    elseif ($key == 'date') {
                        $list->wheredate('created_at', $filter);
                    }
                    else {

                        $list->where($key, $filter);
                    }
                }
            }
        }
       
        if (isset($filter_data['service_id']) && !empty($filter_data['service_id'])) {
            $list->wherehas('service', function($query) use($filter_data){
                $query->where('id',$filter_data['service_id']);
            });
        }
        if ($pagination) {
            return $list->paginate(10);
        } else {
            return $list->get();
        }
    }

    public static function get($id) {
        
        return RtiApplication::find($id);
    }


    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id', 'id');
    }

    public function lawyers()
    {
        return $this->belongsToMany(Lawyer::class, 'rti_application_lawyers', 'application_id', 'lawyer_id')->orderByPivot('created_at', 'desc');
    }

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class, 'lawyer_id', 'id');
    }

    public function getFullNameAttribute()
    {
    	return $this->first_name." ".$this->last_name;
    }


    public function lastRevision()
    {
        return $this->hasOne(RtiApplicationRevision::class, 'application_id', 'id')->orderBy('id', 'desc');
    }


    public static function draftedApplication( $data) {
        $revision = $data->lastRevision;
        if($revision) {
            $field_data = json_decode($revision->details, true);
            $html = $revision->serviceTemplate->template;
            foreach($field_data as $key => $value) {
                $html = str_replace("[".$key."]", $value, $html);
            }
            $signature = "";

            if(!empty($data->signature_image)) {

                
                        $signature = public_path($data->signature_image);
                        $signature = "data:image/png;base64,".base64_encode(file_get_contents($signature));
            }

            $html = view('frontend.profile.rti-file-pdf', compact('data', 'field_data', 'revision', 'html', 'signature'))->render();
            return $html;
        }
        return "";
    }

    public function courierTracking()
    {
        return $this->hasOne(RtiApplicationTracking::class, 'application_id', 'id');
    }



}
