<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\HtmlServiceProvider;
use App\Http\Requests;
use App\Models\Student;
use Carbon\Carbon;
use Validator;
use DB;
class StudentController extends Controller
{
   public function index(){

   	$students = Student::where('status','=',1)->orderby('id','desc')->paginate(env('PAGES'));
   	$flag 	  = Student::where('status','=',1)->count() > env('PAGES') ? true : false;
   	return view('student.listStudent')->with(array(
   		'students'	  => $students,
   		'flag'		  => $flag
   	));
   	}
 // search studen
	public function search_student_add_class(Request $request){
		if ($request->ajax()) {
			try {
				$keyword=$request->value_search;
				$data_search_student=Student::search_add_student_class($keyword);
				$view = view('class_room_units.data_search_student')->with(array(
				'data_search_student'      => $data_search_student,
				));
				return $view;
			} catch (Exception $e) {
				
			}
		}
	}
   	public function search(Request $request) {
   		$keyword = $request->input('keyword');
   		$student = Student::search($keyword);
   		$flag 	 = Student::count() > env('PAGES') ? true : false;
   		$view	 = view('student.data',[
   			'students' => $student,
   			'flag'	  => $flag	
   		])->render();
   		return response($view);
   	}

   	public function validate_email_request(Request $request)
    {
        if ($request->ajax()) {
            $val_email = $request->value;
            $total = Student::count_email($val_email);
            return response()->json($total);
        }
    }

    public function check_email_request_update(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $data_check_email = Student::where('id', '<>', $id)->where('email', $request->value)->count();
            return response($data_check_email);
        }
    }

   	public function validate_mobile_request(Request $request)
    {
        if ($request->ajax()) {
            $val_phone = $request->value;
            $total = Student::count_moblie($val_phone);
            return response()->json($total);
        }
    }

    public function check_phone_request_update(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $data_check_mobile = Student::where('id', '<>', $id)->where('mobile', $request->value)->count();
            return response($data_check_mobile);
        }
    }
   	public function createStudent(Request $request){   
   			if ($request->ajax()) {
	   			$data = Student::Validate_rule ($request->all(), Student::$rules, Student::$messages);
	   			if ($data['error']) {
	   				return response()->json([
	   					'error'      => true,
	   					'messages'   =>$data['messages']
	   				],200);
   				}
   				DB::beginTransaction();
   				try{
   					$data= $request->all();
				    $data['password'] = bcrypt($data['password']);
				    Student::create($data);
				    $students = Student::orderby('created_at','desc')->paginate(env('PAGES'));
						$flag = Student::count() > env('PAGES') ? true : false;
						$view	 = view('student.data',[
			   			'students' => $students,
			   			'flag'	  => $flag	
			   		])->render();
				    DB::commit();
				    return $view;
   				}
   				catch(Exception $e)
		   		{
		   			DB::rollback();
		   			return response()->json([
						'error'      => true,
						'message'   =>$validator->errors()
					],200);
		   			// return response($student);
		   		}
	   		}    
   }
   public function showStudent(Request $request){
   	if ($request->ajax()) {
   		$student = Student::find($request->id);
   		return response($student);
   		return view('student.listStudent',compact('student'));
   	}
   		
   }

   public function updateStudent(Request $request) {
   				$data = Student::Validate_rule ($request->all(), Student::$rules, Student::$messages);
	   			if ($data['error']) {
	   				return response()->json([
	   					'error'      => true,
	   					'messages'   =>$data['messages']
	   				],200);
	   			}
	   			DB::beginTransaction();
   				try { 
   					$student= Student::find($request->editID);
	   				$student->name=$request->name;
	   				$student->mobile=$request->mobile;
	   				$student->email=$request->email;
	   				$student->gender=$request->gender;
	   				$student->birthday=$request->birthday;
	   				$student->facebook=$request->facebook;
	   				$student->skype=$request->skype;
	   				$student->address=$request->address;
	   				$student->school=$request->school;
	   				$student->status=$request->status;
	   				$student->save();
   				DB::commit();
   				return response($student);
   				} catch (Exception $e) {
   					Log::info('can not update student');

           			DB::rollback();
		   			
   				}	
   }
   public function deleteStudent(Request $request){
   	DB::beginTransaction();
   	try {
   		if ($request->ajax()) {
   		Student::destroy($request->id);
   		$students = Student::paginate(env('PAGES'));
  		$flag = Student::count() > env('PAGES') ? true : false;
  		$view	 = view('student.data',[
			'students' => $students,
			'flag'	  => $flag	
   		])->render();
   		DB::commit();
        return $view;
   	}
   	} catch (Exception $e) {
   		DB::rollback();
   	}
   	
   		
   }
}
