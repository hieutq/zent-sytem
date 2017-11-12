<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentHomeWork extends Model
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
        'class_room_unit_id', 'student_id', 'content', 'time_submit', 'url', 'comment', 'point', 'point_plus', 'status', 'status_submit', 'fine', 'bonus'
    ];

    /**
     * get student
     * @return objects 
    */
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
    public function class_room_unit(){
        return $this->belongsTo('App\Models\ClassRoomUnit');
    }
       public static function get_point($id){
        $data_email= $data= DB::table('student_home_works')->select('point')->where('id',$id)->get();
        return $data_email;
    }
}
