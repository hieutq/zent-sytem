<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendence extends Model
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
        'user_id', 'class_room_id', 'class_room_unit_id', 'time_learn', 'student_id', 'type', 'time_join', 'reason' 
    ];

    /**
     * get student
     * @return objects 
    */
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    /**
     * get class_room
     * @return objects 
    */
    public function class_room()
    {
        return $this->belongsTo('App\Models\ClassRoom');
    }

    /**
     * get class_room
     * @return objects 
    */
    public function class_room_unit()
    {
        return $this->belongsTo('App\Models\ClassRoomUnit');
    }
}
