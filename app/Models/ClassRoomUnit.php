<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassRoomUnit extends Model
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
        'id','class_room_id', 'unit', 'unit_name', 'note', 'deadline', 'status',
    ];

    /**
     * get attendences
     * @return objects 
    */
    public function attendences() {
        return $this->hasMany('App\Models\Attendence', 'class_room_unit_id');
    }

    /**
     * get student_home_works
     * @return objects 
    */
    public function student_home_works() {
        return $this->hasMany('App\Models\StudentHomeWork', 'class_room_unit_id');
    }
    protected $table="class_room_units";
    //get 5record unit
    public static function getClassRoomUnit(){
        $data= ClassRoomUnit::orderby('id','DESC')->select('id','unit_name')->get();
        return $data;
    }
    /**
     * Lấy Danh Sách Bài Học
     *
     * @var data
     */
    public static function list_unit($id_classRoom){
        $data= ClassRoomUnit::where('class_room_id',$id_classRoom)->orderBy('id','desc')->paginate(env('PAGES'));
        return $data;       
    }
    
     /**
     * Thêm mới unit
     *
     * @var data
     */
    public static function createNewUnit($data,$id_classRoom) {
        $unit_new=ClassRoomUnit::create($data);
        $unit_new->save();
        return $unit_new;
    }

    /**
     * Kiểm tra số unit thêm vào
     *
     * @var int
     */
    public static function check_add_number_unit($id_classRoom,$id_unit_input,$id_unit_current){
        $check=ClassRoomUnit::where('class_room_id','=',$id_classRoom)->where('unit','=',$id_unit_input)->where('unit','<>',$id_unit_current)->count();
        return $check;
    }

    /**
     * Tìm kiếm unit
     *
     * @var array
     */
    public static function search_unit($data_input,$id_classRoom){
        if ($data_input == "") {
            return ClassRoomUnit::where('class_room_id',$id_classRoom)->orderBy('id','desc')->paginate(env('PAGES'));
        }
        if ($data_input =="Mở" || $data_input =="mở") {
            $data_input =1;
        }
        if ($data_input == "Đóng" || $data_input =="đóng") {
            $data_input =0;
        }

        $finder = ClassRoomUnit::where(
                [
                    ['class_room_units.unit','LIKE', "%" . $data_input. "%"],
                    ['class_room_units.class_room_id', '=', $id_classRoom],
                ]
            )
                ->orWhere([
                    ['class_room_units.unit_name','LIKE', "%" . $data_input. "%"],
                    ['class_room_units.class_room_id', '=', $id_classRoom],
                ])
                ->orWhere([
                    ['class_room_units.note','LIKE', "%" . $data_input. "%"],
                    ['class_room_units.class_room_id', '=', $id_classRoom],
                ])
                ->orWhere([
                    ['class_room_units.status','LIKE', "%" . $data_input. "%"],
                    ['class_room_units.class_room_id', '=', $id_classRoom],
                ])
                ->orderBy('id', 'desc')
                ->paginate(env('PAGES'));
        return $finder;
        }


    /**
     * Lấy thông tin chi tiết Bài học
     *
     * @var data
     */

     public static function getDetail($id_class,$id_unit){
        $data_detail=ClassRoomUnit::where('class_room_id','=',$id_class)->where('unit','=',$id_unit)->first();
        return $data_detail;
     } 
    /**
     * kiểm tra số unit 
     *
     * @var data
     */
     public static function check_unit($id_class,$id_unit_request){
        $check=ClassRoomUnit::where('class_room_id','=', $id_class)->where('unit','=', $id_unit_request)->first();
        return $check;
     }

    /**
     * Xóa unit 
     *
     * @var data
     */ 
     public static function delete_class_unit($id_classRoom,$id_unit){
        $delete_unit =ClassRoomUnit::where('class_room_id',$id_classRoom)->where('unit',$id_unit)->delete();
        return $delete_unit;
     }

}
