<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\ClassRoom;
use App\Models\Course;
use App\Models\UserClassRoom;
use App\Models\User;
use App\Models\Branch;
use App\Models\StudentClassRoom;
use App\Models\Student;
use App\Models\ClassRoomUnit;
use App\Models\Clas;
use Validator;
use DB;
class ClassRoomController extends Controller
{

 	public function index(){
		$list_classroom=ClassRoom::getClassRoomInfo();

		$list_course = Course::getListCourse();
		// dd($list_course);

		$flag_class=count($list_classroom) >0 ? true : false;
		if ($flag_class==true) {
				$list_course = Course::getListCourse();
				$list_teacher=User::get_teacher(); 
				$list_tutor=User::get_tutor();
				// dd($list_user);
				foreach ($list_classroom as $db_class) {
					
					$db_class->manager_class=UserClassRoom::where('class_room_id',$db_class->id)->select('user_id','type')->get();

					$db_class->db_current_unit=ClassRoomUnit::where('class_room_id',$db_class->id)->count();
					if ($db_class->manager_class) {
						foreach ($db_class->manager_class as $name_by_type) {
							if ($name_by_type->type==1) {
								$manager_class_by_id=User::where('id',$name_by_type->user_id)->select('name')->first();
								$db_class->teacher_name=$manager_class_by_id->name;
							}
							if ($name_by_type->type==2) {
								
								$get_list_tutors=UserClassRoom::where('class_room_id',$db_class->id)->where('type',2)->select('user_id')->get();
								$arr_tutors = array();
								foreach ($get_list_tutors as $key => $db_tutors) {
									$name=User::where('id',$db_tutors->user_id)->select('name')->first();

									array_push($arr_tutors,$name->name);
								}
									$db_class->tutors_name=$arr_tutors;
							}
						
						}
							
					}
				}

	// dd($list_classroom->orientation_time);
				$flag = (ClassRoom::count() > env('PAGES')) ? true : false;
				return view('classroom.index',[
					'list_classroom'  => $list_classroom,
					'list_course' => $list_course,
					'list_teacher' =>$list_teacher,
					'flag_class' =>$flag_class,
					'list_tutor'=>$list_tutor,
					'flag' =>$flag
					]);
		}else{
				return view('classroom.index',[
					'flag_class' => $flag_class,
					'list_course' => $list_course
			
					]);
		}


	}

	// load danh sách unit thoe lớp

   //---------Search-------------------
	public function search(Request $request) {  
		$keyword = $request->input('keyword');
		$list_classroom = ClassRoom::search($keyword);
		$flag_class=count($list_classroom) >0 ? true : false;
		if ($flag_class==true) {
				foreach ($list_classroom as $db_class) {
					$db_class->manager_class=UserClassRoom::where('class_room_id',$db_class->id)->select('user_id','type')->get();

					$db_class->db_current_unit=ClassRoomUnit::where('class_room_id',$db_class->id)->count();
					if ($db_class->manager_class) {
						foreach ($db_class->manager_class as $name_by_type) {
							if ($name_by_type->type==1) {
								$manager_class_by_id=User::where('id',$name_by_type->user_id)->select('name')->first();
								$db_class->teacher_name=$manager_class_by_id->name;
							}
							if ($name_by_type->type==2) {
								
								$get_list_tutors=UserClassRoom::where('class_room_id',$db_class->id)->where('type',2)->select('user_id')->get();
								$arr_tutors = array();
								foreach ($get_list_tutors as $key => $db_tutors) {
									$name=User::where('id',$db_tutors->user_id)->select('name')->first();

									array_push($arr_tutors,$name->name);
								}
									$db_class->tutors_name=$arr_tutors;
							}
						
						}
							
					}
				}
				$flag = (ClassRoom::count() > env('PAGES')) ? true : false;
				
				$views= view('classroom.data')->with(array(
					'list_classroom'  => $list_classroom,
					'flag_class' =>$flag_class,
					'flag' =>$flag
					))->render();
					return $views;
			

		}else{
			    $flag=false;
				$view= view('classroom.data')->with(array(
					'list_classroom'  => $list_classroom,
					'flag_class'   =>$flag_class,
					'flag' =>$flag
					))->render();
					return $view;
							}
 	}
	//---------End Search---------------

   public function createClass(Request $request){
   	DB::beginTransaction();
   		try{
   			if ($request->ajax()) {
	   			$rules=[
	   				'code' 						=> 'required',
	   				'class_name' 				=> 'required',
	   				'tuition'					=> 'required|numeric',
	   				'status' 					=> 'required|numeric',
	   				'number_of_unit'			=> 'required|numeric',

	   				'course_id'					=> 'required|numeric',
	   				'max_tuition_policy'		=> 'required|numeric',
	   			];
	   			$messages=[
	   				'code.required'					=> 'Bạn vui lòng nhập mã lớp',
	   				'class_name.required'			=> 'Bạn vui lòng nhập tên lớp',
	   				'tuition.required'				=> 'Bạn vui lòng nhập số số tiền học phí',
	   				'tuition.numeric'				=> 'Học phí không đúng định dạng',
	   				'number_of_unit.required'		=> 'Bạn vui lòng nhập số buổi học',
	   				'number_of_unit.numeric'		=> 'Số buổi học không đúng định dạng',
	   				'course_id.required'			=> 'Bạn vui lòng chọn khóa học',
	   				'course_id.numeric'				=> 'Khóa học không đúng định dạng',
	   				'status.required'				=> 'Bạn vui lòng chọn trạng thái',
	   				'status.numeric'				=> 'Trạng thái không đúng định dạng',
	   				'max_tuition_policy.required'	=> 'Bạn vui lòng nhập số tiền giảm tối đa',
	   				'max_tuition_policy.numeric'	=> 'Dữ liệu phải là kiểu số',
	   			];
	   			$validator=Validator::make($request->all(),$rules,$messages);
	   			
	   			if ($validator->fails()) {
	   				DB::commit();
	   				return response()->json([
	   					'error'      => true,
	   					'message'   =>$validator->errors()
	   				],200);
   				}
	   			else
	   			{
	   				$data= $request->all();
	   		// add class
	   				$new_class=ClassRoom::create($data);	
	   				$id_class=$new_class->id;
	   		//add manager class	

	   			// dd( isset($data['tutors_name_class']));
	   				$flag_tutor=isset($data['tutors_name_class']) ;
	   					if ($flag_tutor==true) {
	   						$arr_manager=$data['tutors_name_class'];
	   					}
	   				if ($data['id_teacher'] != "" || $flag_tutor != false) {
	   					if ($data['id_teacher'] != "") {
	   						$manager_id=$data['id_teacher'];
	   						$type_manager=1;
	   						$new_manager_class=UserClassRoom::add_manager_class_room($id_class,$manager_id,$type_manager);
	   					}
	   					if ($flag_tutor==true) {
	   						$type_manager=2;
	   						foreach ($arr_manager as $value) {
	   							$new_manager_class=UserClassRoom::add_manager_class_room($id_class,$value,$type_manager);
	   						}
	   						
	   					}   					
	   				}
	   				$datas = ClassRoom::orderBy('created_at','desc')->paginate(env('PAGES'));
	   				$flag_class=count($datas) >0 ?true : false;
					$flag = ClassRoom::count() > env('PAGES') ? true : false;
					if ($flag_class==true) {
						foreach ($datas as $db_class) {
							$db_class->manager_class=UserClassRoom::where('class_room_id',$db_class->id)->select('user_id','type')->get();

							$db_class->db_current_unit=ClassRoomUnit::where('class_room_id',$db_class->id)->count();
							if ($db_class->manager_class) {
								foreach ($db_class->manager_class as $name_by_type) {
									if ($name_by_type->type==1) {
										$manager_class_by_id=User::where('id',$name_by_type->user_id)->select('name')->first();
										$db_class->teacher_name=$manager_class_by_id->name;
									}
									if ($name_by_type->type==2) {
										
										$get_list_tutors=UserClassRoom::where('class_room_id',$db_class->id)->where('type',2)->select('user_id')->get();
										$arr_tutors = array();
										foreach ($get_list_tutors as $key => $db_tutors) {
											$name=User::where('id',$db_tutors->user_id)->select('name')->first();

											array_push($arr_tutors,$name->name);
										}
											$db_class->tutors_name=$arr_tutors;
									}
								
								}
									
							}
						}
					
						$view= view('classroom.data')->with(array(
							'list_classroom'  => $datas,
							'flag_class' =>$flag_class,
							'flag' =>$flag
							))->render();

					}else{
						$view= view('classroom.data')->with(array(
							'list_classroom'  => $datas,
							'flag' =>$flag
						))->render();
					}	
				    
				    DB::commit();
				    return $view;
				    // return response($classR);
	   			}
	   		}
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

    //------------DELETE---------------
    public function deleteClass(Request $request){

		   	DB::beginTransaction();
		   	try {
		   		if ($request->ajax()) {

		   			ClassRoom::destroy($request->id);

					$datas = ClassRoom::orderBy('id','desc')->paginate(env('PAGES'));
	   				$flag_class=count($datas) >0 ?true : false;
					$flag = ClassRoom::count() > env('PAGES') ? true : false;
					if ($flag_class==true) {
						foreach ($datas as $db_class) {
							$db_class->manager_class=UserClassRoom::where('class_room_id',$db_class->id)->select('user_id','type')->get();

							$db_class->db_current_unit=ClassRoomUnit::where('class_room_id',$db_class->id)->count();
							if ($db_class->manager_class) {
								foreach ($db_class->manager_class as $name_by_type) {
									if ($name_by_type->type==1) {
										$manager_class_by_id=User::where('id',$name_by_type->user_id)->select('name')->first();
										$db_class->teacher_name=$manager_class_by_id->name;
									}
									if ($name_by_type->type==2) {
										
										$get_list_tutors=UserClassRoom::where('class_room_id',$db_class->id)->where('type',2)->select('user_id')->get();
										$arr_tutors = array();
										foreach ($get_list_tutors as $key => $db_tutors) {
											$name=User::where('id',$db_tutors->user_id)->select('name')->first();

											array_push($arr_tutors,$name->name);
										}
											$db_class->tutors_name=$arr_tutors;
									}
								
								}
									
							}
						}
					
						$view= view('classroom.data')->with(array(
							'list_classroom'  => $datas,
							'flag_class' =>$flag_class,
							'flag' =>$flag
							))->render();

					}else{
						$view= view('classroom.data')->with(array(
							'list_classroom'  => $datas,
							'flag' =>$flag
						))->render();
					}	

			   		DB::commit();
			   		return $view;
			        
		   		}
		   	} catch (Exception $e) {
		   		DB::rollback();
		}
	}
	//--------end Delete------------
    //Show detail
    public function showDetailClass(Request $request){
        if ($request->ajax()) {
            $classR = ClassRoom::find($request->id);
            $getClass=ClassRoom::with('course')->get();
            return response($classR);
            return view('classroom.index',compact('classR'));
        }
    }
    //End Show Detail
    //Edit Class
	public function showClass(Request $request){
   	if ($request->ajax()) {
   		$list_classroom = ClassRoom::find($request->id);
   		return response($list_classroom);
   		return view('classroom.listClassRoom',compact('list_classroom'));
   		} 	
    }
   	public function updateClass(Request $request) {
   		DB::beginTransaction();
   		try{
   			if ($request->ajax()){
   				$rules=[
	   				'code' 						=> 'required',
	   				'class_name' 				=> 'required',
	   				'tuition'					=> 'required|numeric',
	   				'status' 					=> 'required|numeric',
	   				'number_of_unit'			=> 'required|numeric',
	   				'orientation_time'			=> 'required|date',
	   				'time_table'				=> 'required|date',
	   				'course_id'					=> 'required|numeric',
	   				'max_tuition_policy'		=> 'required|numeric',
	   			];
	   			$messages=[

	   				'code.required'					=> 'Bạn vui long nhập mã lớp',
	   				'class_name.required'			=> 'Bạn vui lòng nhập tên lớp',
	   				'tuition.required'				=> 'Bạn vui lòng nhập số số tiền học phí',
	   				'tuition.numeric'				=> 'Học phí không đúng định dạng',
	   				'orientation_time.required'		=> 'Bạn vui lòng chọn ngày ',
	   				'orientation_time.date'			=> 'Ngày của bạn không đúng định dạng!',
	   				'time_table.required'			=> 'Bạn vui lòng chọn ngày ',
	   				'time_table.date'				=> 'Ngày của bạn không đúng định dạng!',
	   				'number_of_unit.required'		=> 'Bạn vui lòng nhập số buổi học',
	   				'number_of_unit.numeric'		=> 'Số buổi học không đúng định dạng',
	   				'course_id.required'			=> 'Bạn vui lòng chọn khóa học',
	   				'course_id.numeric'				=> 'Khóa học không đúng định dạng',
	   				'status.required'				=> 'Bạn vui lòng chọn trạng thái',
	   				'status.numeric'				=> 'Trạng thái không đúng định dạng',
	   				'max_tuition_policy.required'	=> 'Bạn vui lòng nhập học phí giảm tối đa',
	   				'max_tuition_policy.numeric'	=> 'Dữ liệu phải là kiểu số',
	   			];
	   			$validator=Validator::make($request->all(),$rules,$messages);
   			}
   			if ($validator->fails()){
	   				DB::commit();
	   				return response()->json([
	   					'error'      => true,
	   					'message'   =>$validator->errors()
	   				],200);
	   			}else{
	   				ClassRoom::store($request);
	   				$datas = ClassRoom::orderBy('id','desc')->paginate(env('PAGES'));
	   				$flag_class=count($datas) >0 ?true : false;
					$flag = ClassRoom::count() > env('PAGES') ? true : false;
					if ($flag_class==true) {
						foreach ($datas as $db_class) {
							$db_class->manager_class=UserClassRoom::where('class_room_id',$db_class->id)->select('user_id','type')->get();

							$db_class->db_current_unit=ClassRoomUnit::where('class_room_id',$db_class->id)->count();
							if ($db_class->manager_class) {
								foreach ($db_class->manager_class as $name_by_type) {
									if ($name_by_type->type==1) {
										$manager_class_by_id=User::where('id',$name_by_type->user_id)->select('name')->first();
										$db_class->teacher_name=$manager_class_by_id->name;
									}
									if ($name_by_type->type==2) {
										
										$get_list_tutors=UserClassRoom::where('class_room_id',$db_class->id)->where('type',2)->select('user_id')->get();
										$arr_tutors = array();
										foreach ($get_list_tutors as $key => $db_tutors) {
											$name=User::where('id',$db_tutors->user_id)->select('name')->first();

											array_push($arr_tutors,$name->name);
										}
											$db_class->tutors_name=$arr_tutors;
									}
								
								}
									
							}
						}
					
						$view= view('classroom.data')->with(array(
							'list_classroom'  => $datas,
							'flag_class' =>$flag_class,
							'flag' =>$flag
							))->render();

					}else{
						$view= view('classroom.data')->with(array(
							'list_classroom'  => $datas,
							'flag' =>$flag
						))->render();
					}	
	   				// $getClass=ClassRoom::with('course')->get();
	   				DB::commit();
	   				return $view;
	   			}
   		}catch(Exception $e){
   			DB::rollback();
   			return response()->json([
				'error'      => true,
				'message'   =>$validator->errors()
			],200);	
   		}
   	}	
	//---------End Edit-----------------

	
}