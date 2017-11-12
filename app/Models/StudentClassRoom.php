<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentClassRoom extends Model
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
        'class_room_id', 'student_id', 'branch_id', 'course_id', 'avg_point', 'sum_point', 'status', 'note'
    ];

    public static $rules=[
            'class_room_id' => 'required',
            'student_id'    => 'required',
            'course_id'     => 'required',
            'branch_id'     => 'required',
            'status'        => 'required'
        ];

    public static $messages = [
        'class_room_id.required' => 'Vui lòng chọn lớp học',
        'student_id.required' => 'Vui lòng chọn học viên',
        'course_id.required' => 'Vui lòng chọn khóa học',
        'branch_id.required' => 'Vui lòng chọn địa chỉ lớp học',
        'status.required'    => 'Vui lòng chọn trạng thái'   
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
     * get Course
     * @return objects 
    */

    public function Course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    /**
     * get Branch
     * @return objects 
    */
    public function Branch() 
    {
        return $this->belongsTo('App\Models\Branch');
    }

    /**
     * get Branch
     * @return objects 
    */
    public function ClassRoom() 
    {
        return $this->belongsTo('App\Models\ClassRoom');
    }

    //validate

    public static function validate_rules($input, $rules, $messages){
        
        $validator=Validator::make ($input, $rules, $messages);
        if ($validator->fails()) {
            return [
                'error'=> true,
                'messages' => $validator->errors()
            ];
        } 
        return [
                'error'=> false,
                'messages' => 'successfully'
            ];

    }

    public static function store($request) {
        $data =StudentClassRoom::where('id',$request->editID)->first();

        $data->class_room_id = $request->class_room_id;
        $data->student_id    = $request->student_id;
        $data->course_id     = $request->course_id;
        $data->branch_id     = $request->branch_id;            
        $data->status        = $request->status;
        $data->save();
        return $data;
    }
    public static function createStudent($request) {
        
        $data=$request->all();
        $studentClassRoom=StudentClassRoom::create($data);
        return $studentClassRoom;
    }
    /**
     * get search student class
     * @return search 
    */

    public static function search_student_class($keyword,$id_classRoom) {
        if ($keyword=="") {
           return StudentClassRoom::select('student_class_rooms.id','student_class_rooms.student_id','students.name','students.birthday','students.mobile','students.email')
            ->leftjoin('students', 'students.id', '=', 'student_class_rooms.student_id')
            ->where('student_class_rooms.class_room_id','=',$id_classRoom )
            ->orderBy('id','desc')
            ->paginate(env('PAGES'));
        }

        $finder = StudentClassRoom::select('student_class_rooms.id','student_class_rooms.student_id','students.name','students.birthday','students.mobile','students.email')
            ->leftjoin('students', 'students.id', '=', 'student_class_rooms.student_id')
            ->where('student_class_rooms.class_room_id','=',$id_classRoom )
            ->whereRaw("(students.name LIKE '%".$keyword."%' OR students.mobile LIKE '%".$keyword."%' OR students.birthday LIKE '%".$keyword."%' OR students.email LIKE '%".$keyword."%')")
            ->orderBy('student_class_rooms.id','desc')
            ->paginate(env('PAGES'));
        return $finder;
    }
    /**
     * get search
     * @return search 
    */
    public static function search($keyword) {
        if ($keyword=="") {
           return StudentClassRoom::orderBy('id','desc')->paginate(env('PAGES'));
        }

        $finder = StudentClassRoom::select('student_class_rooms.*','class_rooms.class_name','courses.name','students.name','branches.address')
        ->leftjoin('class_rooms', 'student_class_rooms.class_room_id', '=', 'class_rooms.id')
        ->leftjoin('courses', 'student_class_rooms.course_id', '=', 'courses.id')
        ->leftjoin('students', 'student_class_rooms.student_id', '=', 'students.id')
        ->leftjoin('branches', 'student_class_rooms.branch_id', '=', 'branches.id')
        ->where('class_rooms.class_name', 'LIKE', "%" . $keyword. "%")
        ->orWhere('courses.name', 'LIKE', "%" . $keyword . "%")
        ->orWhere('students.name', 'LIKE', "%" . $keyword . "%")
        ->orWhere('branches.address', 'LIKE', "%" . $keyword . "%")
        ->orderBy('student_class_rooms.id','desc')
        ->paginate(env('PAGES'));
        return $finder;
    }
    /**
     * get student
     * @return student 
    */
    public static function listStudentClassRoom() {
        $finder = StudentClassRoom::select('student_class_rooms.*','students.name as studentName','students.id as id_student','students.email','students.created_at as studentCreated','students.mobile','courses.name as courseName','students.facebook')
        ->leftjoin('courses', 'student_class_rooms.course_id', '=', 'courses.id')
        ->leftjoin('students', 'student_class_rooms.student_id', '=', 'students.id')
        ->orderBy('student_class_rooms.id','desc')
        ->paginate(env('PAGES'));
        return $finder;
    }

    public static function searchStudentCare($keyword) {
        if ($keyword=="") {
            return StudentClassRoom::select('student_class_rooms.*','students.name as studentName','students.id as id_student','students.email','students.created_at as studentCreated','students.mobile','courses.name as courseName','students.facebook')
            ->leftjoin('courses', 'student_class_rooms.course_id', '=', 'courses.id')
            ->leftjoin('students', 'student_class_rooms.student_id', '=', 'students.id')
            ->orderBy('student_class_rooms.id','desc')
            ->paginate(env('PAGES'));
        }
        $finder = StudentClassRoom::select('student_class_rooms.*','students.name as studentName','students.id as id_student','students.email','students.created_at as studentCreated','students.mobile','courses.name as courseName','students.facebook')
                ->leftjoin('courses', 'student_class_rooms.course_id', '=', 'courses.id')
                ->leftjoin('students', 'student_class_rooms.student_id', '=', 'students.id')
                ->where('students.mobile', 'LIKE', "%".$keyword."%")
                ->orWhere('students.name', 'LIKE', "%".$keyword."%")
                ->orWhere('students.email', 'LIKE', "%".$keyword."%")
                ->orWhere('courses.name', 'LIKE', "%".$keyword."%")
                ->orderBy('student_class_rooms.id','desc')
                ->paginate(env('PAGES'));
        return $finder;
    }
    /**
     * check student by class
     * @return student 
    */
    public static function check_student_class($classRoom_id,$id_student){
        $check=StudentClassRoom::where('class_room_id',$classRoom_id)->where('student_id',$id_student)->count();
        return $check ;  
    }
    /**
     * add student by class
     * @return student 
    */
    public static function add_student_class($classRoom_id,$id_student,$id_course,$id_branch){
        $student =new StudentClassRoom;
        $student->class_room_id=$classRoom_id;
        $student->course_id=$id_course;
        $student->branch_id=$id_branch;
        $student->student_id=$id_student;
        $student->save();
        return $student;
    } 
    /**
     * get student by class
     * @return list student  
    */
    public static function student_class($id_classRoom){
        $list=StudentClassRoom::where('class_room_id',$id_classRoom)->select('student_id')->orderby('id','desc')->paginate(env('PAGES'));
        return $list;
    }
    /**
     * get student by class
     * @return list studen of a class 
    */
    public static function getStudent($class_room_id , $class_room_unit_id = null) {

        $arrayId = [];

        $lists = StudentClassRoom::where('class_room_id', '=', $class_room_id)->select('student_id')->get();

        if ($lists) {
            foreach ($lists as $list) {
                $arrayId[] = $list->student_id;
            }
        }

        if (!empty($arrayId)) {
            $students = Student::whereIn('id', $arrayId)->select('id', 'name', 'email', 'mobile')->get();

            if ($students) {
                foreach ($students as $key => $student) {
                    $student->type = 1;
                    $student->reason = null;
                    $att = Attendence::select('type', 'reason')->where('class_room_unit_id', $class_room_unit_id)->where('student_id', $student->id)->where('class_room_id', $class_room_id)->first();
                    if ($att) {
                        $student->type = $att->type;
                        $student->reason = $att->reason;
                    }
                }
            }
            return $students;
        } else return null;
        
    }
    /**
     * delete student in class
     * @return  
    */
    public static function delete_student_class($id_classRoom,$id_student){
        $del_student=StudentClassRoom::where('class_room_id',$id_classRoom)->where('student_id',$id_student)->delete();
        return $del_student;
    }
}