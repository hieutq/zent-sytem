<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassRoomUnitTheory extends Model
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
        'class_room_unit_id', 'theory_id', 
    ];



    public function Theory(){
        return $this->hasMany("Theory","theory_id");
    }




    public static function getTheoriesByID($id){
    	$data=ClassRoomUnitTheory::where('class_room_unit_id','=',$id)->orderby('theory_id','DESC')->select('theory_id')->get();
    	return $data;
    }

    /**
     * kiểm tra unit đã có lý thuyết chưa
     *
     * @var data
     */    
    public static function check_theories($id){
        $data=ClassRoomUnitTheory::where('class_room_unit_id','=',$id)->get()->count();
        return $data;
    }
    /**
     * Các lý thuyết đã được chọn cho unit 
     *
     * @var data
     */    
    public static function theories_choice($id){
        $data=ClassRoomUnitTheory::where('class_room_unit_id','=',$id)->select('theory_id')->get();
        return $data;
    }
    /**
     * Xóa lý thuyết
     *
     * @var data
     */    
    public static function delete_theories($id_unit,$id_theories){
        $data=ClassRoomUnitTheory::where('class_room_unit_id','=',$id_unit)->where('theory_id','=',$id_theories)->delete();
        return $data;
    }

    
    /**
     * check  add theory
     * @var data
     */    
    public static function check_add_theory($data){
        return ClassRoomUnitTheory::withTrashed()->where('class_room_unit_id','=',$data['class_room_unit_id'])->where('theory_id','=',$data['theory_id'])->count();
    }
}
