<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'icon', 'status'];
    
    public static function list($pagination, $filters = null) {
        $list = DiseaseType::orderBy('id', 'desc');
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
    public static function get($id) {
        return DiseaseType::find($id);
    }
    public function activeDiseases() {
        return $this->hasMany(Disease::class, 'disease_type_id', 'id')->where('status', 1);
    }

    public function diseases() {
        return $this->hasMany(Disease::class, 'disease_type_id', 'id');
    }
}
