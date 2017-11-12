<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','address', 'phone',
    ];

    /**
     * get student_class_rooms
     * @return objects 
    */
    public function student_class_rooms() {
        return $this->hasMany('App\Models\StudentClassRoom', 'branch_id');
    }
}
