<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\ClassRoom;
use App\Models\ClassRoomUnit;
use App\Models\ClassRoomUnitTheory;
use App\Models\ClassRoomUnitExercise;
use App\Models\TheoryGroup;
use App\Models\Theory;
use App\Models\Student;
use App\Models\Branch;
use App\Models\StudentClassRoom;
use App\Models\UserClassRoom;
use App\Models\Exercise;
use App\Models\Answer;
use App\Http\Requests;
use Validator;
use DB;
use Hash;

class ClassRoomUnitController extends Controller
{
   //load Unit

	public function validate_number_unit(Request $request){
		if ($request->ajax()) {
                		$id_classRoom=$request->id_classRoom;
                		$id_unit_input=$request->id_unit_input;
                		$check_number_unit=ClassRoomUnit::check_add_number_unit($id_classRoom,$id_unit_input);
                		return response()->json([
						'check_number_unit'      => $check_number_unit
					]);               						   
		  }

	}
  // GET LIST UNIT CLASS
	public function getListUnit($id_classRoom){
		$classRoom=ClassRoom::find($id_classRoom);
		$check_class=(count($classRoom) > 0) ? true : false;
		if ($check_class == true) {
			$id_course = $classRoom->course_id;
			//get unit class
			$unit = ClassRoomUnit::where('class_room_id',$id_classRoom)->orderBy('id','desc')->paginate(env('PAGES'));
			//get branch
			$branch =Branch::select('id','address')->get();
	        $flag = (ClassRoomUnit::where('class_room_id',$id_classRoom)->count() > env('PAGES')) ? true : false;
	        //get student class
	        $student_class=StudentClassRoom::student_class($id_classRoom);
	        $flag_student = (StudentClassRoom::where('class_room_id',$id_classRoom)->count() > env('PAGES')) ? true : false;
	        //get manager class
	        $list_manager_class=UserClassRoom::manager_class($id_classRoom);
	        $flag_manager_class = (UserClassRoom::where('class_room_id',$id_classRoom)->count() > env('PAGES')) ? true : false;
	        return view('class_room_units.listUnit',[
	        	'check_class' => $check_class,
	        	'data_unit' => $unit,
	        	'id_classRoom' =>$id_classRoom,
	        	'student_class' => $student_class,
	        	'flag_student' => $flag_student,
	        	'branch' =>$branch,
	        	'list_manager_class' =>$list_manager_class,
	        	'flag' =>$flag,
	        	'flag_manager_class' =>$flag_manager_class
	        ]);			
		}

	}

  // get Add Units
	public function getAddUnits(Request $request,$id_classRoom){
		DB::beginTransaction();
		if ($request->ajax()) {
			    $rules=[
                    'unit'         => 'required|numeric',
                    'unit_name'    => 'required',
                    'status'       => 'required|numeric',
                ];
                $messages=[
                    'unit.required'        => 'Bạn phải nhập số unit!',
                    'unit.numeric'         => 'Số unit phải là số',
                    'unit_name.required'   => 'Bạn phải nhập tên bài học !',
                    'status.required'      => 'Bạn chưa chọn trạng thái cho bài học',
                    'status.numeric'       => 'Trạng thái bài học sai định dạng',
                ];
                $validator=Validator::make($request->all(),$rules,$messages);
                if ($validator->fails()) {
                    return response()->json([
                        'error'      => true,
                        'message'   =>$validator->errors()
                    ],200);
                }else{
                	try{
                		$data=$request->all();
                		$data['class_room_id']=$id_classRoom;

					    $new_unit=ClassRoomUnit::createNewUnit($data,$id_classRoom);

					    $data_unit=ClassRoomUnit::list_unit($id_classRoom);
					    // dd($data_unit);
						$flag=(ClassRoomUnit::where('class_room_id',$id_classRoom)->count() > env('PAGES')) ? true : false; 
				
					    DB::commit();
			// xxxx
						$view= view('class_room_units.data_list_unit')->with(array(
							'data_unit'  => $data_unit,
							'flag'       => $flag
							))->render();
						return $view;					   
					    
	   				}
	   				catch(Exception $e)
			   		{
			   			DB::rollback();
			   			return response()->json([
							'error'      => true,
							'message'   =>$validator->errors()
						],200);
			   			
			   		}
                }
		  }
	}


	// get detail unit
	public function getDetailUnit($id_class,$id_unit){
				$data_detail_unit=ClassRoomUnit::getDetail($id_class,$id_unit);
				$total=count($data_detail_unit);
				$flag = ($total > 0) ? true : false;
				if ($flag===true) {
				$id_unit=$data_detail_unit->id;
				$check_theories=ClassRoomUnitTheory::check_theories($id_unit);
				$check_exercises=ClassRoomUnitExercise::check_exercise($id_unit);
				$check_avatar=$data_detail_unit['picture'];
				// dd($check_avatar);
				$complete_present=(int)env('PERCENT_UNIT');
				if ($check_theories !=0)  {
					$complete_present=$complete_present+25;
				}
				if ($check_theories ==0) {
					$complete_present=$complete_present+0;
				}
				 if ($check_exercises !=0) {
					$complete_present=$complete_present+25;
				}
				if ($check_exercises ==0) {
					$complete_present=$complete_present+0;
				}
				 if ($check_avatar != NULL) {
					$complete_present=$complete_present+25;
				}
				 if ($check_avatar == Null) {
					$complete_present=$complete_present+0;
				}
				$data_theories=Theory::orderBy('id','desc')->paginate(env('PAGES'));
				$total = Theory::count();
       			$flag_theories = ($total > env('PAGES')) ? true : false;
       			$data_theories_choice=ClassRoomUnitTheory::theories_choice($data_detail_unit->id);
       			$data_exercises=Exercise::orderBy('id','desc')->paginate(env('PAGES'));
       			$total_exercises=Exercise::count();
       			$flag_exercises = ($total_exercises > env('PAGES')) ? true : false;
       			$data_exercises_choice=ClassRoomUnitExercise::exercises_answers_choice($data_detail_unit->id);

       			//answer
       			if (count($data_exercises)) {

       				foreach ($data_exercises as $key => $data_exercise) {
       					$data_exercise->answers = Answer::where('exercises_id', $data_exercise->id)->select('id', 'name')->get();
       					if ($data_exercise->answers) {
       						foreach ($data_exercise->answers as $answer) {
       							$answer->selected = false;
       							$check = ClassRoomUnitExercise::where('class_room_unit_id', $data_detail_unit->id)->where('exercise_id',$data_exercise->id)->select('answer_id')->get();
       							if ($check){
       								foreach ($check as  $ck) {
       									if ($ck->answer_id == $answer->id) {
       										$answer->selected = true;
       										break;
       									}
       								}
       								
       							}
       						}
       					}
       				}
       			}

       			// dd($data_exercises_choice);

       			$data_theories_group=TheoryGroup::all();


				return view('class_room_units.detail_unit',[
					'data_theories_group' =>$data_theories_group,
					'data_theories' =>$data_theories,
					'data_detail_unit' =>$data_detail_unit,
					'check_theories' =>$check_theories,
					'check_exercises' =>$check_exercises,
					'check_avatar' =>$check_avatar,
					'complete_present' =>$complete_present,
					'flag_theories' =>$flag_theories,
					'flag_exercises' =>$flag_exercises,
					'data_exercises_choice' => $data_exercises_choice,
					'data_exercises' =>$data_exercises,
					'data_theories_choice' =>$data_theories_choice,
					'flag' =>$flag
					// 'id'=>$id
					]);
				}else{
					return view('class_room_units.detail_unit',[
					'flag' =>$flag
					]);
				}	
	}

	//get all theories unselected
	public function get_theories_unselected(Request $request){
		DB::beginTransaction();
		if ($request->ajax()) {
			try{

				$data_id= $request->id;
				$data_theories_unit=ClassRoomUnitTheory::getTheoriesByID($data_id);
				$theories_unselected=[];
				foreach ($data_theories_unit as $id_theories) {
						$theories_unselected[]=Theory::where('id','<>',$id_theories['theory_id'])->select()->get();	
					}

			    DB::commit();
			    return response()->json([
						'theories_unselected'      => $theories_unselected
					]);
				}
   				catch(Exception $e)
		   		{
		   			DB::rollback();
		   			return response()->json([
						'error'      => 'Lỗi !! '
					],500);
		   			
		   		}
		  }
	}

	//search unit
	public function search_unit(Request $request,$id_classRoom){
		if ($request->ajax()) {
			try {
				$data_input=$request->keyword;
				$data_unit=ClassRoomUnit::search_unit($data_input,$id_classRoom);
				$flag = (ClassRoomUnit::where('class_room_id',$id_classRoom)->count() > env('PAGES')) ? true : false;
				$data_search=view('class_room_units.data_list_unit')->with(array(
						'data_unit'      => $data_unit,
						'flag'  =>$flag
					))->render();
					return $data_search;
			} catch (Exception $e) {
				
			}
		}
	}
	// reset-theory
	public function reset_theory($id_class,$id_unit){
		$data_detail_unit=ClassRoomUnit::getDetail($id_class,$id_unit);
		$data_theories=Theory::orderBy('id','desc')->paginate(env('PAGES'));
		$total = Theory::count();
		$flag_theories = ($total > env('PAGES')) ? true : false;
		$flag=true;
		$data_theories_choice=ClassRoomUnitTheory::theories_choice($data_detail_unit->id);
		$view_table_theory=view('class_room_units.data_table_theory')->with(array(
								'data_theories'      => $data_theories,
								'flag_theories' =>$flag_theories,
								'data_theories_choice' => $data_theories_choice,
								'flag'=>$flag
							))->render();
		// dd($view_table_theory);
					return $view_table_theory;
	}
	//tìm kiếm theory
   	public function search_theory(Request $request,$id_class,$id_unit) {
   		if ($request->ajax()) {
	   			$data_detail_unit=ClassRoomUnit::getDetail($id_class,$id_unit);
	   			$data_theories_choice=ClassRoomUnitTheory::theories_choice($data_detail_unit->id);
		   		$keyword = $request->input('keyword');
		   		$theory_search = Theory::search($keyword);
		   		$flag 	 = (count($theory_search) > env('PAGES')) ? true : false;
				$view_search_theory=view('class_room_units.data_search_theory')->with(array(
								'theory_search'      => $theory_search,
								'data_theories_choice' => $data_theories_choice,
								'flag'=>$flag
							))->render();
		   		return $view_search_theory;
   		}

   	}

   	// Tìm kiếm Bài Tập
   	public function search_exercise(Request $request,$id_class,$id_unit) {
   		if ($request->ajax()) {
	   			$data_detail_unit=ClassRoomUnit::getDetail($id_class,$id_unit);
	   			$data_theories_choice=ClassRoomUnitTheory::theories_choice($data_detail_unit->id);
		   		$keyword = $request->input('keyword');
		   		$theory_search = Theory::search($keyword);
		   		$flag 	 = (count($theory_search) > env('PAGES')) ? true : false;
				$view_search_theory=view('class_room_units.data_search_theory')->with(array(
								'theory_search'      => $theory_search,
								'data_theories_choice' => $data_theories_choice,
								'flag'=>$flag
							))->render();
		   		return $view_search_theory;
   		}

   	}
	// Lọc nhóm lý thuyết selectbox
	public function getDataSelectBox(Request $request, $id_class,$id_unit){

		if ($request->ajax()) {
			try{
				$data_id_theory= $request->all();
				$str=strlen($data_id_theory['data']);
				$data_theory_group=TheoryGroup::select('id','name')->get();
				$id=$data_id_theory['data'];
				$data_detail_unit=ClassRoomUnit::getDetail($id_class,$id_unit);
				// dd($id_unit);
				$data_theories_choice=ClassRoomUnitTheory::theories_choice($data_detail_unit->id);

				if ($str>=3) {
					
					$last_data_id = explode(",",$data_id_theory['data']);
					$theory_info=Theory::getTheoryManySelect($last_data_id);
					$count=Theory::countTheoryManySelect($last_data_id);
					$flag_theories= ($count > env('PAGES')) ? true : false;
				
					$view = view('class_room_units.data_unit_theory')->with(array(
								'theory_info'      => $theory_info,
								'data_theories_choice' =>$data_theories_choice,
								'data_theory_group' => $data_theory_group,
								'flag_theories' =>$flag_theories
							))->render();
					return $view;
				}else{
					$theory_info=Theory::getTheoryOneSelect($id);
					$count=count($theory_info);
					$flag_theories= ($count > env('PAGES')) ? true : false;
					// dd($flag_theories);
					// dd($theory_info);
					$view = view('class_room_units.data_unit_theory')->with(array(
								'theory_info'      => $theory_info,
								'data_theories_choice' =>$data_theories_choice,
								'data_theory_group' => $data_theory_group,
								'flag_theories' =>$flag_theories
							))->render();
					return $view;	
					
					}


				}
   				catch(Exception $e)
		   		{
		   	
		   			return response()->json([
						'error'      => 'Lỗi !! '
					],500);
		   			
		   		}
		}
	}
	// Sửa thông tin
	public function update_unit(Request $request){
		DB::beginTransaction();
		if ($request->ajax()) {
		    $rules=[
                'unit'         => 'required|numeric',
                'unit_name'    => 'required',
                'status'       => 'required|numeric',
            ];
            $messages=[
               
                'unit.required'        => 'Bạn phải nhập số unit!',
                'unit.numeric'         => 'Số unit phải là số',
                'unit_name.required'   => 'Bạn phải nhập tên bài học !',
                'status.required'      => 'Bạn chưa chọn trạng thái cho bài học',
                'status.numeric'       => 'Trạng thái bài học sai định dạng',
            ];
            $validator=Validator::make($request->all(),$rules,$messages);
            if ($validator->fails()) {
                return response()->json([
                    'error'      => true,
                    'message'   =>$validator->errors()
                ],200);
            }else{
            	try{

   					$data= $request->all();
   					$unit=ClassRoomUnit::find($data['id']);
				   	$unit->unit=$data['unit'];
				   	$unit->unit_name=$data['unit_name'];
				   	$unit->note=$data['note'];
				   	$unit->status=$data['status'];
				   	$unit->save();
				    DB::commit();

				    return response($unit);
   				}
   				catch(Exception $e)
		   		{
		   			DB::rollback();
		   			return response()->json([
						'error'      => true,
						'message'   =>$validator->errors()
					],500);
		   			
		   		}
            }			
		}

	}
	//kiểm tra unit
	public function validateUnit(Request $request,$id_class,$id_unit){
			if ($request->ajax()) {
					$unit_current=ClassRoomUnit::getDetail($id_class,$id_unit);
					$id_unit_request=$request->unit_late;
					$check_unit=ClassRoomUnit::check_unit($id_class,$id_unit_request);
					if (count($check_unit)==0) {
						echo "dung";
					}else if (count($check_unit)>0) {

						if ($check_unit->id==$unit_current->id) {
							echo "dang sua unit hien tai";
						}
					}
			  }				
	}
// Thêm theories
	public function addTheoriesUnit(Request $request,$id_class,$id_unit){
		DB::beginTransaction();
		if ($request->ajax()) {
		   
            	try{
					$data_detail_unit=ClassRoomUnit::getDetail($id_class,$id_unit);
					$class_room_unit_theories =new ClassRoomUnitTheory;
					$class_room_unit_theories->class_room_unit_id=$data_detail_unit->id;
					$class_room_unit_theories->theory_id=$request->id_theory;
					$class_room_unit_theories->save();
					$count_current=ClassRoomUnitTheory::check_theories($data_detail_unit->id);
					$check_exercises_unit=ClassRoomUnitExercise::check_exercise($data_detail_unit->id);
				
					$data_add=['class_room_unit_theories' =>$class_room_unit_theories,'count_current'=>$count_current,'check_exercises_unit'=>$check_exercises_unit,'data_detail_unit' =>$data_detail_unit];
				    DB::commit();

				    return response($data_add);
   				}
   				catch(Exception $e)
		   		{
		   			DB::rollback();  			
		   		}
  		
		}
	}
// xóa theories 
	public function deleteTheoriesUnit(Request $request,$id_class,$id_unit){
		DB::beginTransaction();
		if ($request->ajax()) {
		   
            	try{
            		$data_detail_unit=ClassRoomUnit::getDetail($id_class,$id_unit);
            		$id_unit=$data_detail_unit->id;
            		$id_theories=$request->id_theory;
					$del_theory=ClassRoomUnitTheory::delete_theories($id_unit,$id_theories);
					$count_current=ClassRoomUnitTheory::check_theories($data_detail_unit->id);
					$check_exercises_unit=ClassRoomUnitExercise::check_exercise($data_detail_unit->id);
					$data_del=['del_theory' =>$del_theory,'count_current'=>$count_current,'check_exercises_unit' =>$check_exercises_unit];

				    DB::commit();
				    // dd($data_del);
				    return response($data_del);
   				}
   				catch(Exception $e)
		   		{
		   			DB::rollback();
		   			
		   		}
  		
		}
	}
 // thêm exercise
	public function addExerciseUnit(Request $request,$id_class,$id_unit){
		DB::beginTransaction();
		if ($request->ajax()) {
		   
            	try{
					$data_detail_unit=ClassRoomUnit::getDetail($id_class,$id_unit);
					$id_unit=$data_detail_unit->id;
					$class_room_unit_exercise =new ClassRoomUnitExercise;
					$class_room_unit_exercise->class_room_unit_id=$data_detail_unit->id;
					$class_room_unit_exercise->exercise_id=$request->id_exercise;
					$class_room_unit_exercise->answer_id=$request->id_answer;
					$class_room_unit_exercise->save();
					$check_theory_unit=ClassRoomUnitTheory::check_theories($data_detail_unit->id);
					$count_current=ClassRoomUnitExercise::check_exercise($data_detail_unit->id);
					$data_add=['data_detail_unit' =>$data_detail_unit,'count_current'=>$count_current,'check_theory_unit' =>$check_theory_unit];
				    DB::commit();
				    return response($data_add);
   				}
   				catch(Exception $e)
		   		{
		   			DB::rollback(); 
		   			return response("Không thêm được bài tập !!"); 			
		   		}
  		
		}

}
 // thêm exercise
	public function deleteExerciseUnit(Request $request,$id_class,$id_unit){
		DB::beginTransaction();
		if ($request->ajax()) {
            	try{
					$data_detail_unit=ClassRoomUnit::getDetail($id_class,$id_unit);
            		$id_unit=$data_detail_unit->id;
					$del_exercise=ClassRoomUnitExercise::delete_exercise_unit($data_detail_unit->id,$request->id_exercise,$request->id_answer);
					$check_theory_unit=ClassRoomUnitTheory::check_theories($data_detail_unit->id);
					$count_current=ClassRoomUnitExercise::check_exercise($data_detail_unit->id);
					$data_del=['data_detail_unit' =>$data_detail_unit,'count_current'=>$count_current,'check_theory_unit' =>$check_theory_unit];

				    DB::commit();
				    return response($data_del);
   				}
   				catch(Exception $e)
		   		{
		   			DB::rollback(); 
		   			return response("Xóa bài tập không thành công !!"); 			
		   		}
  		
		}

}

// Update Image
	public function updateImage(Request $request,$id){
		// dd("cmmm");
			DB::beginTransaction();
			try {
				$data_detail_unit=ClassRoomUnit::find($id);
	
        if ($request->hasFile('picture')) {
          $file = $request->file('picture');

          $name = $file->getClientOriginalName();
          $image = str_random(4)."_".$name;
          while (file_exists("upload/img-unit/".$image)) {
            $image = str_random(4)."_".$name;
          };
          if(isset($data_detail_unit) && $data_detail_unit->image > 0){
          unlink("upload/img-unit/".$post->image);
          $file->move("upload/img-unit",$image);
          $data_detail_unit->picture = $image;}
          else {
          $file->move("upload/img-unit",$image);
          $data_detail_unit->picture = $image;
        
          }
          
        }
				
				$data_detail_unit->save();		
				 DB::commit();	
			return redirect('detail-unit/class-id/'.$data_detail_unit->class_room_id.'/unit/'.$data_detail_unit->unit.'');
			} catch (Exception $e) {
				DB::rollback();
			}

	}
// filter class by course
	public function filter_class(Request $request){
		try {
			dd($request->all());
		} catch (Exception $e) {
			
		}

	}
// delete class room unit
	public function delete_unit(Request $request){
		DB::beginTransaction();
		if ($request->ajax()) {
            	try{
					$id_unit=$request->id_unit;
					$id_classRoom=$request->id_classRoom;
					$del_unit=ClassRoomUnit::delete_class_unit($id_classRoom,$id_unit);

					$data_unit=ClassRoomUnit::list_unit($id_classRoom);
					$flag=(count($data_unit) > env('PAGES')) ? true : false; 
				    DB::commit();
				
					$view= view('class_room_units.data_list_unit')->with(array(
						'data_unit'  => $data_unit,
						'flag' =>$flag
						))->render();
					
					return $view;
				
   				}
   				catch(Exception $e)
		   		{
		   			DB::rollback(); 
		   			return response("Xóa bài học không thành công !!"); 			
		   		}
  		
		}		
	}

}
