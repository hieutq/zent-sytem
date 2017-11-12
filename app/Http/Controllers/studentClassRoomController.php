<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\StudentClassRoom;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\Branch;
use App\Models\Course;
use DB;
class StudentClassRoomController extends Controller
{
    public function index(){
    	$studentClassRoom = StudentClassRoom::orderby('id','DESC')->paginate(env('PAGES'));
    	$classRoom=ClassRoom::All();
        $flag       = StudentClassRoom::count() > env('PAGES') ? true : false;
    	$Student=Student::All();
    	$Branch=Branch::All();
        $Course=Course::All();

    	return view('student.studentClassRoom',[
			'studentClassRoom' => $studentClassRoom,
            'flag'             => $flag, 
			'ClassRoom'		   => $classRoom,
			'Student'		   => $Student,
			'Branch'		   => $Branch,
            'Course'           => $Course,
            'id'                
		]);
          }


    // thêm học viên vào lớp
    public function add_student_class(Request $request,$id_classRoom){
        DB::beginTransaction();
        if ($request->ajax()) {
            try {

                $id_branch=$request->branch;
                $classRoom_id=$id_classRoom;
                $id_student=$request->id_student;
                // dd($id_student);
                if ($id_student =="") {
                    return response()->json(['error_unselect'=>'Bạn chưa chọn học viên !!']); 
                }
                
                else if ($id_student !="") {
                    $check_student=StudentClassRoom::check_student_class($classRoom_id,$id_student);
                    
                    if ($check_student>0) {
                        return response()->json(['error'=>'Học viên này đã có trong lớp !!']);
                    }    
               else{
                    $data_class=ClassRoom::where('id',$id_classRoom)->select('course_id')->first();
                    $id_course =$data_class->course_id;
                    $add_student=StudentClassRoom::add_student_class($classRoom_id,$id_student,$id_course,$id_branch);
                    $student_class=StudentClassRoom::student_class($classRoom_id);
                    $flag =(count($student_class) > env('PAGES')) ? true : false;
                     DB::commit();
                    $view= view('classroom.data_student_class')->with(array(
                        'student_class'  => $student_class,
                        'flag' =>$flag
                        ))->render();
                        return $view;
                        
                    }
                 }           
            } catch (Exception $e) {
                DB::rollback();
            }

            
        }
    }
    // xóa học viên trong lớp
    public function delete_student_class(Request $request,$id_classRoom){
        DB::beginTransaction();
        if ($request->ajax()) {
            try {
                    $id_student=$request->id_student;
                    $id_classRoom=$request->id_classRoom;
                    $del_student=StudentClassRoom::delete_student_class($id_classRoom,$id_student);
                    $student_class=StudentClassRoom::student_class($id_classRoom);
                    $flag =(count($student_class) > env('PAGES')) ? true : false;
                     DB::commit();
                    $view= view('classroom.data_student_class')->with(array(
                        'student_class'  => $student_class,
                        'flag' =>$flag
                        ))->render();
                        return $view;
                        dd($view);
                          
            } catch (Exception $e) {
                DB::rollback();
            }

            
        }
    }
    // tìm kiếm học viên trong lớp
    public function search_student_in_class(Request $request,$id_classRoom) {
        if ($request->ajax()) {
            try {
                   
                  $keyword=$request->keyword;
                  $data_search_student=StudentClassRoom::search_student_class($keyword,$id_classRoom);
                  $flag =(StudentClassRoom::where('class_room_id',$id_classRoom)->count() > env('PAGES')) ? true : false;
                  $view= view('classroom.data_search_student_class')->with(array(
                        'data_search_student'  => $data_search_student,
                        'flag' =>$flag
                        ))->render();
                  return $view;
                      
                          
            } catch (Exception $e) {
             
            }
            }
        }
    public function search(Request $request) {
        $keyword = $request->keyword;
        $datas = StudentClassRoom::search($keyword);
        dd( $datas);
        $flag  = StudentClassRoom::count() > env('PAGES') ? true : false;
        $views = view('student.dataRoom',[
            'studentClassRoom' =>$datas,
            'flag'             =>$flag  
        ]);
        return $views;
    }

    public function NewCreate(Request $request){
        $data = StudentClassRoom::validate_rules ($request->all(), StudentClassRoom::$rules, StudentClassRoom::$messages);
        if ($data['error']) {
            return response()->json([
                'error' => true,
                'messages' => $data['messages']
            ], 200);
        }
        DB::beginTransaction();
        try {
            StudentClassRoom::createStudent($request);
            $datas = StudentClassRoom::orderBy('created_at','desc')->paginate(env('PAGES'));
            $flag  = StudentClassRoom::count() > env('PAGES') ? true : false ;
            $views = view('student.dataRoom',[
                'studentClassRoom' => $datas,
                'flag'             => $flag  
            ])->render();
            DB::commit();
            return $views;
            // $getStudent=StudentClassRoom::with('Course', 'student', 'Branch', 'ClassRoom')->get(); 
            // $getClassRoomInfo=ClassRoom::select('id','class_name')->get();
            // $getCourseInfo=Course::select('id','name')->get();
            // $getStudentInfo=Student::select('id','name')->get();
            // $getBranchInfo=Branch::select('id','address')->get();

            // return response()->json([
            // 'studentClassRoom'     =>   $data,
            // 'classRoomInfo'        =>   $getClassRoomInfo,
            // 'courseInfo'           =>   $getCourseInfo,
            // 'studentInfo'          =>   $getStudentInfo,
            // 'branchInfo'           =>   $getBranchInfo
            // ],200);
        } catch (Exception $e) {
            Log::info('can not create student');

            DB::rollback();
        }
    }
    public function showStudent(Request $request) {
        if ($request->ajax()) {

            $data = StudentClassRoom::find($request->id); 

            return response($data);

            return view('student.studentClassRoom',compact('data'));
        }
    }
    public function updateStudent(Request $request) {
        $data = StudentClassRoom::validate_rules ($request->all(), StudentClassRoom::$rules, StudentClassRoom::$messages);

        if ($data['error']) {
            return response()->json([
                'error' => true,
                'messages' => $data['messages']
            ], 200);
        }
        DB::beginTransaction();
        try {

            StudentClassRoom::store($request);
            $datas = StudentClassRoom::paginate(env('PAGES'));
            $flag  = StudentClassRoom::count() > env('PAGES') ? true : false ;
            $views = view('student.dataRoom',[
                'studentClassRoom' => $datas,
                'flag'             => $flag  
            ])->render();
            DB::commit();
            return $views;
            // $getStudent=StudentClassRoom::with('Course', 'student', 'Branch', 'ClassRoom')->get();
            
            // return response()->json([
            //     'studentClassRoom'     =>$data,
            //     'data'                 =>$getStudent
            // ],200);


        } catch( Exeption $e) {

            
        }


    }
    public function delStudent(Request $request) {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();
                StudentClassRoom::destroy($request->id);
                $datas = StudentClassRoom::orderby('id','DESC')->paginate(env('PAGES'));
                $flag  = StudentClassRoom::count() > env('PAGES') ? true : false ;
                $views = view('student.dataRoom',[
                    'studentClassRoom' => $datas,
                    'flag'             => $flag  
                ])->render();
                DB::commit();
                return $views;
                // return response()->json(['sms'=>'Delete sucssesfully']);

            } catch (Exception $e) {
                return response()->json(['sms'=>' Can not Delete']);
            }
        }
    }
}

