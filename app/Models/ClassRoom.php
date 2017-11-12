<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\ClassRoomUnitTheory;
use App\Models\ClassRoomUnitExercise;

class ClassRoom extends Model
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
        'code', 'class_name', 'orientation_time', 'time_table', 'number_of_unit', 'tuition', 'status', 'course_id', 'icon', 'tuition_policy', 'max_tuition_policy', 'policy', 'facebook_group'
    ];

    /**
     * get users
     * @return objects
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_class_rooms', 'class_room_id', 'user_id');
    }

    /**
     * get attendences
     * @return objects
     */
    public function attendences()
    {
        return $this->hasMany('App\Models\Attendence', 'class_room_id');
    }

    /**
     * get class_room_units
     * @return objects
     */
    public function class_room_units()
    {
        return $this->hasMany('App\Models\ClassRoomUnit', 'class_room_id');
    }

    public function class_room_unit_exercises()
    {
        return $this->hasMany("ClassRoomUnitExercise", "class_room_id");
    }


    public function course()
    {
        return $this->belongsTo("App\Models\Course");
    }
 /**
 * format data request
 * @return objects 
*/
    public static function format_data($dataInput)
    {
        foreach ($dataInput as &$data) {
            if ($data == '') {
                $data = null;
            }
        }
        return $dataInput;
    }
 /**
 * add class room
 * @return objects 
*/
    public static function add_new_class($data_request){
        $data=ClassRoom::format_data($data_request);
        $data['orientation_time']=date('Y-m-d', strtotime($data['orientation_time']));
         $classRoom= new ClassRoom;
         $classRoom->code=$data['code'];
         $classRoom->class_name=$data['class_name'];
         $classRoom->orientation_time=$data['orientation_time'];
         $classRoom->time_table=$data['time_table'] ;
         $classRoom->tuition=$data['tuition'] ;
         $classRoom->status=$data['status'] ;
         $classRoom->course_id=$data['course_id'] ;
         $classRoom->tuition_policy=$data['tuition_policy'] ;
         $classRoom->max_tuition_policy=$data['max_tuition_policy'] ;
         $classRoom->facebook_group=$data['facebook_group'] ;
         $classRoom->number_of_unit=$data['number_of_unit'] ;
         $classRoom->save();
         return $classRoom;

    }
    public static function store($request) {
        $classRoom= ClassRoom::find($request->editID);
        $classRoom->code=$request->code;
        $classRoom->class_name=$request->class_name;
        $classRoom->orientation_time=$request->orientation_time;
        $classRoom->time_table=$request->time_table;
        $classRoom->number_of_unit=$request->number_of_unit;
        $classRoom->tuition=$request->tuition;
        $classRoom->course_id=$request->course_id;
        $classRoom->icon=$request->editIcon;
        $classRoom->tuition_policy=$request->tuition_policy;
        $classRoom->max_tuition_policy=$request->max_tuition_policy;
        $classRoom->policy=$request->editPolicy;
        $classRoom->facebook_group=$request->facebook_group;
        $classRoom->status=$request->status;
        $classRoom->save();
    }


     /**
     * get get StudentClassRoom
     * @return objects 
    */
    public function StudentClassRoom() {
        return $this->hasMany('App\Models\ClassRoomUnit', 'class_room_id');
    }
 // $data_info=ClassRoom::where(DB::raw("CURTIME() <= orientation_time"))->orderBy('orientation_time','desc')->paginate(env('PAGES'));
    public static function getClassRoomInfo(){
        $data_info=ClassRoom::orderby('orientation_time','DESC')->paginate(env('PAGES'));
        return $data_info;
    }
    //Search
    public static function search($keyword){
    if ($keyword == "") {
        return ClassRoom::orderBy('id', 'desc')->paginate(env('PAGES'));
    }
    $finder = ClassRoom::where('class_rooms.class_name', 'LIKE', "%" . $keyword. "%")
            ->orWhere('class_rooms.code', 'LIKE', "%" . $keyword . "%")
            ->orWhere('class_rooms.facebook_group', 'LIKE', "%" . $keyword . "%")
            ->orderBy('id', 'desc')
            ->paginate(env('PAGES'));
    return $finder;
    }  


    public static function duplicate($id) {
        $origin_class= ClassRoom::where('id', $id)->first();

        $classroom = ClassRoom::where('id', $id)->first()->replicate();
        $classroom->class_name = $origin_class->class_name . " (copy)";
        $classroom->status = 16; //chuan bi khai giang
        $classroom->save();

        $class_room_units = ClassRoomUnit::where('class_room_id', $id)->get();

        if ($class_room_units) {
            foreach ($class_room_units as $key => $class_room_unit) {
                //unit
                $class_room_unit_dup = ClassRoomUnit::where('id', $class_room_unit->id)->first()->replicate();
                $class_room_unit_dup->class_room_id = $classroom->id;
                $class_room_unit_dup->save();

                //theories of unit
                $theories = ClassRoomUnitTheory::where('class_room_unit_id', $class_room_unit->id)->get();
                if ($theories) {
                    foreach ($theories as $key => $theory) {
                        $theory_dup = ClassRoomUnitTheory::where('id', $theory->id)->first()->replicate();
                        $theory_dup->class_room_unit_id = $class_room_unit_dup->id;
                        $theory_dup->save();
                    }
                }

                //exercises of unit
                $exercises = ClassRoomUnitExercise::where('class_room_unit_id', $class_room_unit->id)->get();
                if ($exercises) {
                    foreach ($exercises as $key => $exercise) {
                        $exercise_dup = ClassRoomUnitExercise::where('id', $exercise->id)->first()->replicate();
                        $exercise_dup->class_room_unit_id = $class_room_unit_dup->id;
                        $exercise_dup->save();
                    }
                }
            }
        }

    }

}
