<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailTemplate extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'html', 'subject'];
    public static function list($pagination, $filters = null) {
        $filter_data = $filters;
        unset($filters['ids']);
        unset($filters['page']);
        unset($filters['operation']);

        $list = MailTemplate::orderBy('id', 'desc');
        if(!empty($filters)) {
            foreach($filters as $key => $filter) {
                if($filter != null) {
                    if($key == 'search') {
                        $list->where('name', 'like', '%'.$filter.'%')
                        ->orwhere('subject', 'like', '%'.$filter.'%');

                    }
                    else {
                        $list->where($key, $filter);

                    }
                }
            }
        }
     
        if(isset($filter_data['ids'])) {
            $list->wherein('id', $filter_data['ids']);
        }
        if($pagination) {
            return $list->paginate(10);
        }
        else {
            return $list->get();

        }
    }
}
