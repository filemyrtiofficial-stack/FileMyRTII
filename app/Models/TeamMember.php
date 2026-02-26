<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'expertise', 'image', 'about', 'status', 'sequance'];
    public static function list($pagination, $filters = null) {
        $filter_data = $filters;
        unset($filters['ids']);
        unset($filters['page']);

        $list = TeamMember::orderBy('id', 'desc');
        if(!empty($filters)) {
            foreach($filters as $key => $filter) {
                if($filter != null) {
                    if($key == 'search') {
                        $list->where(function($query) use($filter) {
                            $query->where('name', 'like', '%'.$filter.'%')
                            ->orwhere('expertise', 'like', '%'.$filter.'%');
                        });
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
    public static function get($id) {
        return TeamMember::find($id);
    }

}
