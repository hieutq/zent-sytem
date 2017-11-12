<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Answer;

class ClassRoomUnitExercise extends Model
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
        'class_room_unit_id', 'exercise_id', 'answer_id'
    ];

    // public $timestamps = false;

    public function answer(){

    	 return $this->belongsTo("Answer","answer_id");  
     }

     
     public function classRoom(){
    	 return $this->belongsTo("ClassRoom","class_room_id");  
     }

     public function exercise(){
    	 return $this->belongsTo("Exercise","exercise_id");  
     }
    /**
     * Kiểm tra đã có bài tập về nhà chưa
     *
     * @var int
     */ 
    public static function check_exercise($id){
        $data=ClassRoomUnitExercise::where('class_room_unit_id','=',$id)->get()->count();
        return $data;
    }

     /**
     * Kiểm tra đã có bài tập về nhà chưa
     *
     * @var array
     */ 
    public static function exercises_answers_choice($id){
        $data=ClassRoomUnitExercise::where('class_room_unit_id','=',$id)->select("exercise_id","answer_id")->get();
        return $data;
    }   
     /**
     * Xóa Lý Thuyết
     *
     * @var array
     */ 
    public static function delete_exercise_unit($id_class_unit,$id_exercise,$id_answer){
        $data=ClassRoomUnitExercise::where('class_room_unit_id','=',$id_class_unit)->where('exercise_id','=',$id_exercise)->where('answer_id','=',$id_answer)->delete();
        return $data;
    } 
}
