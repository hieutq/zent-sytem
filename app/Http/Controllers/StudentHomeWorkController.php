<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentHomeWork;
use App\Models\ClassRoomUnit;
use App\Models\ClassRoom;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentClassRoom;
use App\Http\Requests;
use Validator;
use DB;
use Hash;


class StudentHomeWorkController extends Controller
{
	//----------Load student Homework ----------
    
    public function getStudentHomeworks($id_class, $id){

        $class_room_unit = ClassRoomUnit::where('class_room_id',$id_class)->where('unit',$id)->first();

        $class_room_name = ClassRoom::find($id_class)->class_name;

        $id_class_room_unit = $class_room_unit->id;
        // dd($id_class_room_unit);
    	$student_home_work = StudentHomeWork::select('student_home_works.id',
                                                    'class_room_units.unit_name',
                                                    'students.mobile',
                                                    'students.name',
                                                    'student_home_works.url',
                                                    'student_home_works.student_id',
                                                    'student_home_works.content',
                                                    'student_home_works.comment',
                                                    'student_home_works.point',
                                                    'student_home_works.point_plus',
                                                    'student_home_works.time_submit',
                                                    'student_home_works.status',
                                                    '.student_home_works.status_submit')
                                                ->join('class_room_units','student_home_works.class_room_unit_id' , '=' , 'class_room_units.id')
                                                ->join('class_rooms' , 'class_room_units.class_room_id' , '=' , 'class_rooms.id' )
                                                ->join('students', 'student_home_works.student_id', '=' , 'students.id')
                                                ->where('student_home_works.status',1)
                                                ->where('class_room_units.id',$id_class_room_unit)
                                                ->where('class_room_units.unit',$id)
    	                                        ->get();
        $arrIds = [];
        if ($student_home_work) {
            foreach ($student_home_work as $key => $value) {
               $arrIds[] = $value->student_id;
            }
        }

        //get all id of students
        $arrAllIds = [];
        $students = StudentClassRoom::select('student_id')->where('class_room_id', $id_class)->get();

        if($students) {
            foreach ($students as $key => $student) {
                $arrAllIds[] = $student->student_id;
            }
        }
        $arr = array_diff($arrAllIds, $arrIds);
        $student_not_works = null;

        if (!empty($arr)) {
            $student_not_works = Student::whereIn('id', $arr)->get();
        } 

    	return view('student.listStudentHomeWork')->with(array(
   		'students_home_work'	  => $student_home_work,
        'class_room_name'         => $class_room_name,
        'unit_id'                    => $id,
        'class_room_unit'         => $class_room_unit,
        'student_not_works'       => $student_not_works
   	));
    }
    public function getInfo(Request $request){
           try{
            if ($request->ajax()) {
                $id_request=$request->id;
                
                $info_student_home_work=StudentHomeWork::find($id_request); 
               
                $unit_id=$info_student_home_work
                            [
                            'class_room_unit_id'
                            ];
                $student_id=$info_student_home_work
                [
                'student_id'
                ];
                $info_class_room_unit=ClassRoomUnit::select('unit_name')->where('id',$unit_id)->get();
                $info_student=Student::select('name')->where('id',$student_id)->get(); 
            
                $data=[ 
                    'info_student_home_work' => $info_student_home_work,
                    'info_class_room_unit'  => $info_class_room_unit,
                    'info_student' => $info_student
                    ];
                return response($data);

            }
             } catch (Exception $e) {
                $info_error=['msg' =>'Lấy thông tin không thành công!!!!'];
                return response($info_error);
        
    }    
    }
       //-------------------Validate Point-------------------------------------
        // public function validatePoint(Request $request){
        //     DB::beginTransaction();
        //         if ($request->ajax()) {
        //              $rules=[
        //             'editPoint'    => 'required|numeric|min:0|max:100',
        //         ];
        //                $messages=[                
        //             'editPoint.required'   => 'Bạn vui lòng nhập điểm!',
        //             'editPoint.numeric'    => 'Nhập đúng định dạng là số',
        //             'editPoint.min'        => 'Điểm nhỏ nhất là 0!',
        //             'editPoint.max'        => 'Điểm lớn nhất là 100!',
        //         ];
        //         $validate=Validator::make($request->all(),$ruler,$messages);
        //                 if ($validator->fails()) {
        //             return response()->json([
        //                 'error'      => true,
        //                 'message'   =>$validator->errors()
        //             ],200);
        //         }else{
        //             try {
        //                 $info_student_home_work=StudentHomeWork::find($request->id);
        //                 $get_point = $info_student_home_work->point;
        //                 $data[
        //                     'info_student_home_work'=$info_student_home_work
        //                 ];
        //                 return response($data);
        //             } catch (Exception $e) {
        //                 $info_error=['msg' =>'Lấy thông tin không thành công!!!!'];
        //                 return response($info_error);
        //             }
        //         }
        //         }
        // }
       //-------------------End validate point --------------------------------
        //----------- update point ---------------
     public function updatePoint(Request $request) {
         DB::beginTransaction();
            if ($request->ajax()) {
                $rules=[
                    'editPoint'    => 'required|numeric|min:0|max:100',
                ];
                $messages=[                   
                    'editPoint.required'   => 'Bạn vui lòng nhập điểm!',
                    'editPoint.numeric'    => 'Nhập đúng định dạng là số',
                    'editPoint.min'        => 'Điểm nhỏ nhất là 0!',
                    'editPoint.max'        => 'Điểm lớn nhất là 100!',
                ];
                $validator=Validator::make($request->all(),$rules,$messages);
                if ($validator->fails()) {
                    $point= StudentHomeWork::find($request->id);
                    $data=[
                        'point' => $point
                    ];
                    return response()->json([
                        'error'      => true,
                        'message'   =>$validator->errors(),
                        'point'     => $point
                    ],200);
                }
                else{
                    try {
                        $point= StudentHomeWork::find($request->id);
                        $get_point=$point->point;
                        // dd($get_point);
                        $point->point=$request->editPoint;
                        $point->save();
                        $student_id = $point->student_id;
                        $class_room_unit_id = $point->class_room_unit_id; 
                        $class_room_unit = ClassRoomUnit::where('id',$class_room_unit_id)->first();
                        
                        $class_room_id = $class_room_unit->class_room_id;
                        $class_room = ClassRoom::where('id',$class_room_id)->first();
                        $class_room_id=$class_room->id;
                        $student_class_room = StudentClassRoom::where('student_id',$student_id)->where('class_room_id',$class_room_id)->first();
                        $sum_point = $student_class_room->sum_point;

                        $avg_point = $student_class_room->avg_point;
                        if($sum_point==0){
                        $sum = $sum_point + $point->point + $point->point_plus;
                        }else{
                        $sum = $sum_point - $get_point + $point->point + $point->point_plus;
                        }
                        $count= ClassRoomUnit::where('class_room_id',$class_room_id)->count();
                       
                        $avg = $sum/$count;
                        $student_class_room->sum_point=$sum;
                        $student_class_room->avg_point=$avg;
                        $student_class_room->save();
                        // $info_student_home_work=StudentHomeWork::find($request->id);
                        // $data[
                        //     'info_student_home_work' => $info_student_home_work,
                        // ];
                        // return response($data);
                    DB::commit();
                    return response()->json($point);
                    } catch (Exception $e) {
                        DB::rollback();
                        return response()->json([
                            'error'      => true,
                            'message'   =>$validator->errors()
                        ],200);
                    }
                    
                }
                
            }   
   }

   //----------------- update point plus -------------
   public function createPoint_plus(Request $request){
        DB::beginTransaction();
              if ($request->ajax()) {
                $rules=[
                    'editPoint_plus'    => 'required|numeric|min:0|max:10',

                ];
                $messages=[
                   
                    'editPoint_plus.required'   => 'Bạn vui lòng nhập điểm cộng!',
                    'editPoint_plus.numeric'    => 'Nhập đúng định dạng là số',
                    'editPoint_plus.min'        => 'Điểm cộng nhỏ nhất là 0!',
                    'editPoint_plus.max'        => 'Điểm cộng lớn nhất là 10!',
               

                ];
                $validator=Validator::make($request->all(),$rules,$messages);
                if ($validator->fails()) {
                    $point= StudentHomeWork::find($request->id);
                    return response()->json([
                        'error'      => true,
                        'message'   =>$validator->errors(),
                        'point'     => $point
                    ],200);
                }
                else{
                    try {
                        $point_plus= StudentHomeWork::find($request->id);
                        $get_point_plus=$point_plus->point_plus;
                        $point_plus->point_plus=$request->editPoint_plus;
                        // dd($get_point_plus);
                        $point_plus->save();
                DB::commit();
                    return response()->json($point_plus);
                    } catch (Exception $e) {
                        DB::rollback();
                        return response()->json([
                            'error'      => true,
                            'message'   =>$validator->errors()
                        ],200);
                    }
                    
                }
                
            }   
   }
   //----------------- end point plus ----------------
   //----------------- Delete record------------------
   public function deleteRecord(Request $request){

    DB::beginTransaction();
    if($request->ajax()){
        $rules = [
            'editStatus'    =>     'required',
        ];
        $messages = [
            'editStatus.required'    =>      'Status không được để trống!',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);

         if ($validator->fails()) {
                    return response()->json([
                        'error'      => true,
                        'message'   =>$validator->errors()
                    ],200);
                }
        else
        {
            try {
                $student_home_work = StudentHomeWork::find($request->id);
                $student_home_work->status=0;
                $student_home_work->save();
                DB::commit();
                return response()->json($student_home_work);
            } catch (Exception $e) {
                 DB::rollback();
                        return response()->json([
                            'error'      => true,
                            'message'   =>$validator->errors()
                        ],200);
            }
        }
    }

   } 

    public function getInfoGrade(Request $request){
           try{
            if ($request->ajax()) {
                $id_request=$request->id;
                
                $info_student_home_work=StudentHomeWork::find($id_request); 
               
                $unit_id=$info_student_home_work
                            [
                            'class_room_unit_id'
                            ];
                $student_id=$info_student_home_work
                [
                'student_id'
                ];
                $info_class_room_unit=ClassRoomUnit::select('unit_name')->where('id',$unit_id)->get();
                $info_student=Student::select('name')->where('id',$student_id)->get();     
                $data=[ 
                    'info_student_home_work' => $info_student_home_work,
                    'info_class_room_unit'  => $info_class_room_unit,
                    'info_student' => $info_student
                    ];
                return response($data);

            }
             } catch (Exception $e) {
                $info_error=['msg' =>'Lấy thông tin không thành công!!!!'];
                return response($info_error);
        
    }    
    }

        public function ToGrade(Request $request){

            $rules=[
                    'editComment'       => 'required',
                    'editPoint'         => 'required|numeric|min:0|max:100',
                    'editPoint_plus'    => 'required|numeric|min:0|max:20',

            ];
            $messages=[
                'editComment.required'     => 'Hãy nhận xét bài của học viên!' , 
                'editPoint.required'   => 'Bạn vui lòng nhập điểm!',
                'editPoint.numeric'    => 'Nhập đúng định dạng là số',
                'editPoint.min'        => 'Điểm nhỏ nhất là 0!',
                'editPoint.max'        => 'Điểm lớn nhất là 100!',
                'editPoint_plus.required'   => 'Bạn vui lòng nhập điểm cộng!',
                'editPoint_plus.numeric'    => 'Nhập đúng định dạng là số',
                'editPoint_plus.min'        => 'Điểm cộng nhỏ nhất là 0!',
                'editPoint_plus.max'        => 'Điểm cộng lớn nhất là 20!',
            ];

            $validator=Validator::make($request->all(),$rules, $messages);

            if ($validator->fails()) {

                return response()->json([
                    'error'      => true,
                    'message'   =>$validator->errors(),
                ],200);
            }
            else{

                DB::beginTransaction();
                try {

                        $point= StudentHomeWork::find($request->id);

                        $get_point=$point->point;
                        $get_point_plus=$point->point_plus;
                        $get_comment=$point->comment;
                        $point->point=$request->editPoint;
                        $point->point_plus=$request->editPoint_plus;
                        $point->comment=$request->editComment;
                     // dd($get_point_plus);
                        $point->save();

                        $point->sum_point = $point->point + $point->point_plus;

                        $student_id = $point->student_id;
                        $class_room_unit_id = $point->class_room_unit_id; 
                        $class_room_unit = ClassRoomUnit::where('id',$class_room_unit_id)->first();
                        
                        $class_room_id = $class_room_unit->class_room_id;
                        $class_room = ClassRoom::where('id',$class_room_id)->first();
                        $class_room_id=$class_room->id;
                        $student_class_room = StudentClassRoom::where('student_id',$student_id)->where('class_room_id',$class_room_id)->first();
                        $sum_point = $student_class_room->sum_point;

                        $avg_point = $student_class_room->avg_point;

                        if($sum_point==0){
                            $sum = $sum_point + $point->point + $point->point_plus;
                        }else{
                            $sum = $sum_point - $get_point + $point->point + $point->point_plus;
                        }
                        $count= ClassRoomUnit::where('class_room_id',$class_room_id)->count();
                       
                        $avg = $sum/$count;
                        $student_class_room->sum_point=$sum;
                        $student_class_room->avg_point=$avg;
                        $student_class_room->save();

                        DB::commit();

                        return response()->json([
                                'error' => false,
                                'data'  => $point
                        ], 200);

                } catch (Exception $e) {

                    DB::rollback();
                    return response()->json([
                        'error'      => true,
                        'message'   => $e->getMessage()
                    ],500);
                }

            }
   }


}
   