<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquiryForm extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'email', 'phone_number', 'subject', 'message','reason'];
    public static function list($pagination, $filters = null) {
        $filter_data = $filters;
        unset($filters['page']);
        unset($filters['search']);

        $filters = array_remove_null($filters);
        $list = EnquiryForm::orderBy('id', 'desc');
        if(!empty($filters)) {
            foreach($filters as $key => $filter) {
                if($filter != null) {
                    if($key == 'email') {
                        $list->where('email' , 'like', '%'.$filter.'%');
                    }
                    else {

                        $list->where($key, $filter);

                    }
                }
            }
        }
        if(isset($filter_data['search']) && !empty($filter_data['search'])) {
            $list->where(function($query) use($filter_data){
                $query->where('name', 'like', '%'.$filter_data['search'].'%')
                ->orwhere('email', 'like', '%'.$filter_data['search'].'%')
                ->orwhere('phone_number', 'like', '%'.$filter_data['search'].'%');

            });
        }
        if($pagination) {
            return $list->paginate(10);
        }
        else {
            return $list->get();

        }
    }
    public static function get($id) {
        return Newsletter::find($id);
    }

}
