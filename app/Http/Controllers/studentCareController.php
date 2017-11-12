<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\StudentCare;
use App\Models\User;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\StudentClassRoom;
use DB;
use Auth;
use Mail;
class studentCareController extends Controller
{
	public function studentCares(){
		$studenCare = StudentCare::orderBy('id','desc')->paginate(env('PAGES'));
		$studentClassRoom = StudentClassRoom::listStudentClassRoom();
		// dd($studentClassRoom);
		$classRoom	= ClassRoom::all();
		$flag 		= StudentClassRoom::count() > env('PAGES') ? true : false;
		$id_user 	    = Auth::User()->id;
		$user 		= User::where('id','=',$id_user)->get();
		// dd($user);
		$student    = Student::All();
		return view('student.studentCare',[
			'studentCare' => $studenCare,
			'studentClassRoom' => $studentClassRoom,
			'classRoom'	 => $classRoom,		
			'flag' 		 => $flag,
			'user'		 => $user,
			'student'	 => $student 	
		])->render();
	}
	// search student
	public function search(Request $request) {
   		$keyword = $request->input('keyword');
   		$student = StudentClassRoom::searchStudentCare($keyword);
   		// dd($student);
   		$flag 	 = count($student) > env('PAGES') ? true : false;
   		$view	 = view('student.dataSearch',[
   			'studentCare' => $student,
   			'flag'	  => $flag	
   		])->render();
   		return $view;
   	}
   	//filter Student of class
   	public function FilterStudent(Request $request) {
   		$keyword = $request->input('keyword');
   		$student = StudentCare::filterStudent($keyword);
   		$flag 	 = StudentClassRoom::count() > env('PAGES') ? true : false;
   		$view	 = view('student.datafilter',[
   			'studentClassRoom' => $student,
   			'flag'	  => $flag	
   		])->render();
   		return $view;
   	}
   	
   	/**
     * create new send mail
     *
     * @return \Illuminate\Http\Response
     */
	public function createStudentCare(Request $request) {
		DB::beginTransaction();
		$data = StudentCare::validate_rules ($request->all(), StudentCare::$rules, StudentCare::$messages);

        if ($data['error']) {

            return response()->json([
                'error' => true,
                'messages' => $data['messages']
            ], 200);
        }
		try {
			$id_user=Auth::User()->id;
			$nameUser = Auth::User()->name;
			$email = $request->email;
			$title = $request->title;
			$nameStudent = $request->name;
			$content = $request->content;
			$student_id=$request->student_id;
			
			$create=StudentCare::newStudentCare($request);
			Mail::send('mail',['content'=> $content,'nameStudent'=>$nameStudent,'nameUser'=>$nameUser], function($messages) use ($title,$email,$nameUser,$nameStudent){
	    		$messages->to($email,$nameStudent)->subject($title);
	    		$messages->from(env('MAIL_USERNAME'),$nameUser);
    		});
			$datas = StudentCare::where('student_id','=',$student_id)->orderBy('created_at','desc')->paginate(env('PAGES'));
			$flag = StudentCare::count() > env('PAGES') ? true : false;
			$studentClassRoom = StudentClassRoom::listStudentClassRoom();
			$view = view('student.dataAppendStudent')->with(array(
				'studentCare' => $datas,
				'flag' =>$flag
			))->render();
			DB::commit();
			return $view;
			// $getStudentCare=StudentCare::with('student','user')->get();
			// $studentInfo   = Student::select('id','name')->get();
			// $userInfo	   = User::select('id','name')->get();
			// return response()->json([
			// 	'studentcare' =>$data,
			// 	'studentInfo' => $studentInfo,
			// 	'userInfo'	  => $userInfo
			// ]);
			

		} catch (Exception $e) {

			Log::info('can not create studentcare');

            DB::rollback();
		}
	}

	/**
     * create new for call
     *
     * @return \Illuminate\Http\Response
     */

	public function createStudentCall(Request $request) {
		DB::beginTransaction();
		$data = StudentCare::validate_rules ($request->all(), StudentCare::$rules, StudentCare::$messages);

	    if ($data['error']) {

	        return response()->json([
	            'error' => true,
	            'messages' => $data['messages']
	        ], 200);
	    }
		try {
			$student_id=$request->student_id;
			$delStudent = StudentCare::where('status','=',3)->delete();
			$create=StudentCare::newStudentCare($request);
			$datas = StudentCare::where('student_id','=',$student_id)->orderBy('created_at','desc')->paginate(env('PAGES'));
			$flag =count($datas) > env('PAGES') ? true : false;
			$studentClassRoom = StudentClassRoom::listStudentClassRoom();
			$view = view('student.dataAppendStudent')->with(array(
				'studentCare' => $datas,
				'flag' =>$flag
			))->render();
			DB::commit();
			return $view;
		} catch (Exception $e) {

			Log::info('can not create studentcare');

	        DB::rollback();
		}
	}
	//call page send mail
	public function showStudentEmail($id_student) {
			$data = StudentCare::show($id_student);
			$studentCare = StudentCare::where('student_id','=',$id_student)->orderBy('created_at','desc')->paginate(env('PAGES'));
			$flag = StudentCare::where('student_id','=',$id_student)->count() > env('PAGES') ? true : false;
			return view('student.care_student',['studentClassRoom' => $data,'studentCare'=>$studentCare,'flag'=>$flag]);	
	}
	//call page call student
	public function showStudentCall($id_student) {
			$data = StudentCare::show($id_student);
			$studentCare = StudentCare::where('student_id','=',$id_student)->orderBy('created_at','desc')->paginate(env('PAGES'));
			$flag = StudentCare::where('student_id','=',$id_student)->count() > env('PAGES') ? true : false;
			return view('studentCare.call_student',['studentClassRoom' => $data,'studentCare'=>$studentCare,'flag'=>$flag]);	
	}


	public function updateStudent(Request $request) {

		DB::beginTransaction();

		$data = StudentCare::validate_rules ($request->all(), StudentCare::$rules, StudentCare::$messages);

		if ($data['error']) {
			return response()->json([
				'error' => true,
				'messages' => $data['messages']
			]);
		}
		try {
			
			StudentCare::store($request);
			// $getStudentCare = Student::select('id','name')->get();
			$datas = StudentCare::orderBy('id','desc')->paginate(env('PAGES'));
			$flag = StudentCare::count() > env('PAGES') ? true : false;
			$view = view('student.dataCare')->with(array(
				'studentCare' => $datas,
				'flag' =>$flag
			))->render();
			// $datas = [$studentCare,$getStudentCare];
			DB::commit();
			return $view;

		} catch (Exception $e) {

			Log::info('can not create studentcare');

            DB::rollback();
		}
	}

	public function deleteStudentCare(Request $request) {
		if ($request->ajax()) {
			DB::beginTransaction();
			try {
				StudentCare::destroy($request->id);
				$datas = StudentCare::orderBy('id','desc')->paginate(env('PAGES'));
				$flag = StudentCare::count() > env('PAGES') ? true : false;
				$view = view('student.dataCare')->with(array(
				'studentCare' => $datas,
				'flag' =>$flag
				))->render();
				DB::commit();
				return $view;
			} catch (Exception $e) {
				Log::info('can not delete studentcare');

            	DB::rollback();
			}
		}
	}
}
