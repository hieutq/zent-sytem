<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Student;
use App\Models\StudentClassRoom;
use Auth;
use App\Models\User;
class StudentCare extends Model
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
        'user_id', 'student_id', 'care_type', 'reviver_address', 'content', 'status', 'read_status','title'
    ];

    public static $rules=[

            'student_id'         => 'required',
            'title'              =>'required'   

        ];

    public static $messages = [

        'student_id.required'         => 'Vui lòng chọn học viên',
        'title.requred'              =>'Vui lòng điền tiêu đề'
  
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
     * get user
     * @return objects 
    */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function validate_rules($input, $rules, $messages){
        
        $validator=Validator::make ($input, $rules, $messages);
        
        if ($validator->fails()) {
            return [
                'error'     => true,
                'messages'  => $validator->errors()
            ];
        } 
        return [
                'error'     => false,
                'messages'  => 'successfully'
            ];

    }

    public static function store($request) {

        $data                       = StudentCare::find($request->editID);
        $data->user_id              = $request->user_id;
        $data->student_id           = $request->student_id;
        $data->care_type            = $request->care_type;
        $data->reviver_address      = $request->reviver_address;
        $data->content              = $request->content;               
        $data->status               = $request->status;
        $data->save();

        return $data;
    }

    public static function newStudentCare($request) { 
        $id_user = Auth::User()->id;
        $data = $request->all();
        $data['read_status'] = 1;
        $data['user_id']     = $id_user;
        $datas= StudentCare::create($data);
        return $datas;              
    }

    public static function show($id) {
        $data = StudentClassRoom::select('student_class_rooms.id','student_class_rooms.student_id','class_rooms.class_name as class_name','students.name as studentName','students.mobile','students.email')
                ->leftjoin('students', 'student_class_rooms.student_id', '=', 'students.id')
                ->leftjoin('class_rooms', 'student_class_rooms.class_room_id', '=', 'class_rooms.id')
                ->where('student_class_rooms.student_id','=',$id)
                ->orderBy('student_class_rooms.id','desc')
                ->paginate(env('PAGES'));

        return $data;
    }
    public static function search($keyword) {
        if ($keyword=="") {
            return StudentCare::orderBy('id','desc')->paginate(env('PAGES'));
        }
        $finder = StudentCare::select('student_cares.*','students.name as studentName','users.name as userName')
                ->leftjoin('users', 'student_cares.user_id', '=', 'users.id')
                ->leftjoin('students', 'student_cares.student_id', '=', 'students.id')
                ->where('users.name', 'LIKE', "%".$keyword."%")
                ->orWhere('students.name', 'LIKE', "%".$keyword."%")
                ->orderBy('student_cares.id','desc')
                ->paginate(env('PAGES'));
        return $finder;
    }
    public static function filterStudent($keyword) {
        if ($keyword=="") {
            return StudentClassRoom::select('student_class_rooms.*','students.name as studentName','students.email','students.created_at as studentCreated','students.mobile','courses.name as courseName','students.facebook')
                    ->leftjoin('courses', 'student_class_rooms.course_id', '=', 'courses.id')
                    ->leftjoin('students', 'student_class_rooms.student_id', '=', 'students.id')
                    ->orderBy('student_class_rooms.id','desc')
                    ->paginate(env('PAGES'));;
        }
        $finder = StudentClassRoom::select('student_class_rooms.*','students.name as studentName','students.email','students.created_at as studentCreated','students.mobile','courses.name as courseName','students.facebook')
                ->leftjoin('courses', 'student_class_rooms.course_id', '=', 'courses.id')
                ->leftjoin('students', 'student_class_rooms.student_id', '=', 'students.id')
                ->where('student_class_rooms.class_room_id', '=',$keyword)
                ->orderBy('student_class_rooms.id','desc')
                ->paginate(env('PAGES'));
        return $finder;
    }
}
