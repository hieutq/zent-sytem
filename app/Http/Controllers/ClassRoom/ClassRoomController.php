<?php

namespace App\Http\Controllers\ClassRoom;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\ClassRoom;
use App\Models\Course;
use App\Models\UserClassRoom;
use App\Models\User;
use App\Models\Branch;
use App\Models\StudentClassRoom;
use App\Models\Student;
use App\Models\ClassRoomUnit;
use App\Models\OptionValue;
use Validator;
use DB;
use Log;

class ClassRoomController extends Controller
{
    /**
     * load index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$list_classroom=ClassRoom::getClassRoomInfo();
		$list_course = Course::getListCourse();
		// dd($list_course);
		// dd("xxx");

		$flag_class=count($list_classroom) >0 ? true : false;
		if ($flag_class==true) {
				$list_course = Course::getListCourse();
				$list_teacher=User::get_teacher(); 
				$list_tutor=User::get_tutor();
				
				foreach ($list_classroom as $db_class) {
					//get  course name by class
					$course_name=Course::where('id',$db_class->course_id)->select('short_name')->first();
					// dd($course_name['short_name']);
					$db_class->course_name=$course_name['short_name'];
					// get class current unit
					$db_class->db_current_unit=ClassRoomUnit::where('class_room_id',$db_class->id)->count();

					$db_class->students=StudentClassRoom::where('class_room_id',$db_class->id)->count();

					// compare date -> warning orientation_time

						//get today -> in
						$today =date('Y-m-d');
						$int_today=strtotime($today);

						// get oientation_time from db convent to int
						$int_orientation_time = strtotime($db_class->orientation_time);

						//results date 
						$results_date = $int_orientation_time-$int_today;

								if ($results_date  <= 0) {
									$db_class->color ="green-haze";
								}

								 if ($results_date > 0 && $results_date >env('DANGER_DATE')) {
									$db_class->color ="warning-haze";
								}
								 if ($results_date > 0 && $results_date <= env('DANGER_DATE')  ) {
									$db_class->color ="danger-haze";
								}

					

					// get manager class
					$db_class->manager_class=UserClassRoom::where('class_room_id',$db_class->id)->select('user_id','type')->get();
					if ($db_class->manager_class) {
						foreach ($db_class->manager_class as $name_by_type) {
							if ($name_by_type->type==1) {
								$get_list_teacher=UserClassRoom::where('class_room_id',$db_class->id)->where('type',1)->select('user_id')->get();
								$arr_teacher = array();
								foreach ($get_list_teacher as $db_teacher) {
									$name=User::where('id',$db_teacher->user_id)->select('name')->first();
									array_push($arr_teacher,$name->name);
								}
								$db_class->teacher_name=$arr_teacher;
							}
							if ($name_by_type->type==2) {
								
								$get_list_tutors=UserClassRoom::where('class_room_id',$db_class->id)->where('type',2)->select('user_id')->get();
								$arr_tutors = array();
								foreach ($get_list_tutors as $db_tutors) {
									$name=User::where('id',$db_tutors->user_id)->select('name')->first();
									array_push($arr_tutors,$name->name);
								}
									$db_class->tutors_name=$arr_tutors;
							}
						
						}
							
					}
				}

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$list_course = Course::getListCourse();
		$list_teacher=User::get_teacher(); 
		$list_tutor=User::get_tutor();

		$statuses=OptionValue::where('option_id', 4)->get();

		 return view('classroom.add_class')->with(array(
				'list_course'  => $list_course,
				'list_teacher' =>$list_teacher,
				'list_tutor' =>$list_tutor,
				'statuses'     => $statuses
				));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	DB::beginTransaction();
   		try{
   			if ($request->ajax()) {
	   			$rules=[
	   				'code' 						=> 'required',
	   				'class_name' 				=> 'required',
	   				'tuition'					=> 'required',
	   				'status' 					=> 'required|numeric',
	   				'number_of_unit'			=> 'required|numeric',
	   				'course_id'					=> 'required|numeric',
	   			
	   			];
	   			$messages=[
	   				'code.required'					=> 'Bạn vui lòng nhập mã lớp',
	   				'class_name.required'			=> 'Bạn vui lòng nhập tên lớp',
	   				'tuition.required'				=> 'Bạn vui lòng nhập số số tiền học phí',
	   				'number_of_unit.required'		=> 'Bạn vui lòng nhập số buổi học',
	   				'number_of_unit.numeric'		=> 'Số buổi học không đúng định dạng',
	   				'course_id.required'			=> 'Bạn vui lòng chọn khóa học',
	   				'course_id.numeric'				=> 'Khóa học không đúng định dạng',
	   				'status.required'				=> 'Bạn vui lòng chọn trạng thái',
	   				'status.numeric'				=> 'Trạng thái không đúng định dạng',
	   				
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
	   				$new_class=ClassRoom::add_new_class($data);	
	   				$id_class=$new_class->id;
	   				//add manager class	

	   					if ($data['id_teacher'] != "") {
	   						$type_manager=1;
	   						foreach ($data['id_teacher'] as $value) {
	   							$new_manager_class=UserClassRoom::add_manager_class_room($id_class,$value,$type_manager);
	   						}
	   					
	   					}
	   				
	   					if ($data['tutors_name_class']!="") {
	   						$type_manager=2;
	   						foreach ($data['tutors_name_class'] as $value) {
	   							$new_manager_class=UserClassRoom::add_manager_class_room($id_class,$value,$type_manager);
	   						}
	   						
	   					}   					
	   			
	   		
			
						DB::commit();
						return response()->json([
		                    'error' => false,
		                    'data_class' => $new_class
		                ], 200);
	   			}
	   		}
   		}
   		catch(Exception $e)
   		{
   			Log::info($e->getMessage());
   			DB::rollback();
   			return response()->json([
				'error'      => true,
				'message'   => $validator->errors()
			],200);
   			// return response($student);
   		}  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $detail_class = ClassRoom::find($id);
        $list_course = Course::getListCourse();
		$list_teacher=User::get_teacher(); 
		$list_tutor=User::get_tutor();

		$arr_teacher = [];
		$arr_tutor = [];

		$teachers = UserClassRoom::where('class_room_id',$id)->where('type', 1)->get();
		if ($teachers) {
			foreach ($teachers as $key => $teacher) {
				$arr_teacher[] = $teacher->user_id;
			}
		}

		$tutors = UserClassRoom::where('class_room_id',$id)->where('type', 2)->get();
		if ($teachers) {
			foreach ($tutors as $key => $tutor) {
				$arr_tutor[] = $tutor->user_id;
			}
		}
		$statuses=OptionValue::where('option_id', 4)->get();

		// $list_course = Course::getListCourse();

		// dd($list_teacher);
		return view('classroom.edit-class')->with(array(
				'list_course'  => $list_course,
				'list_teacher' =>$list_teacher,
				'list_tutor' =>$list_tutor,
				'detail_class' => $detail_class,
				'arr_teacher' => $arr_teacher,
				'arr_tutor' => $arr_tutor,
				'statuses' => $statuses
				));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

		$rules=[
			'code' 						=> 'required',
			'class_name' 				=> 'required',
			'tuition'					=> 'required',
			'status' 					=> 'required|numeric',
			'number_of_unit'			=> 'required|numeric',
			'course_id'					=> 'required|numeric',
		
		];
		$messages=[
			'code.required'					=> 'Bạn vui lòng nhập mã lớp',
			'class_name.required'			=> 'Bạn vui lòng nhập tên lớp',
			'tuition.required'				=> 'Bạn vui lòng nhập số số tiền học phí',
			'number_of_unit.required'		=> 'Bạn vui lòng nhập số buổi học',
			'number_of_unit.numeric'		=> 'Số buổi học không đúng định dạng',
			'course_id.required'			=> 'Bạn vui lòng chọn khóa học',
			'course_id.numeric'				=> 'Khóa học không đúng định dạng',
			'status.required'				=> 'Bạn vui lòng chọn trạng thái',
			'status.numeric'				=> 'Trạng thái không đúng định dạng',
			
		];
		$validator=Validator::make($request->all(),$rules,$messages);
		
		if ($validator->fails()) {
			DB::commit();
			return response()->json([
				'error'      => true,
				'message'   =>$validator->errors()
			],500);
		}
		else
		{
			try {

				$data= $request->all();
	   			

	   			$class_room = ClassRoom::where('id', $id)->first();
	   			$class_room->update($data);	

				//add manager class	

				if ($data['id_teacher'] != "") {
					$type_manager=1;

					//delete first
					UserClassRoom::where('class_room_id', $id)->where('type', $type_manager)->delete();

					foreach ($data['id_teacher'] as $value) {

						$new_manager_class=UserClassRoom::add_manager_class_room($id,$value,$type_manager);
					}
				
				}
			
				if ($data['tutors_name_class']!="") {
					$type_manager=2;
					//delete first
					UserClassRoom::where('class_room_id', $id)->where('type', $type_manager)->delete();

					foreach ($data['tutors_name_class'] as $value) {
						$new_manager_class=UserClassRoom::add_manager_class_room($id,$value,$type_manager);
					}
					
				}  
			
				DB::commit();
				return response()->json([
                    'error' => false,
                    'data_class' => $class_room
                ], 200);


			} catch (Exception $e) {
				Log::info($e->getMessage());
				DB::rollback();
	   			return response()->json([
					'error'      => true,
					'message'   => $validator->errors()
				],500);
			}
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
		   	DB::beginTransaction();
		   	try {
		   		if ($request->ajax()) {
		   			// delete class
		   				$delete_class=ClassRoom::where('id',$id)->delete();
			   		DB::commit();
			   		return response()->json([
		                    'error' => false,
		                    'delete_class' => $delete_class

		                ], 200);
			        
		   		}
		   	} catch (Exception $e) {
		   		DB::rollback();
		}
    }

    /**
     * Duplicate class room
     * @param  integer $id 
     * @return json     
     */
    
    public function postDuplicate($id) {

        DB::beginTransaction();
        try {

            ClassRoom::duplicate($id);

            // Commit db
            DB::commit();
            return response()->json(array(
                'error' => false,
                'message' => 'Duplicate success'
            ), 200);
            

        } catch (\Exception $e) {

            DB::rollback();
            Log::error($e->getMessage());
            Log::error('Rolled back in: ' . __FILE__ . 'line: ' . __LINE__);

            return response()->json(array(
                'error' => true,
                'message' => 'Duplicate not success'
            ), 200);
        }
    }
}