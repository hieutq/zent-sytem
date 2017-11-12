<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\HtmlServiceProvider;
use App\Http\Requests;
use App\Models\Attendence;
use App\Models\StudentClassRoom;
use App\Models\ClassRoom;
use Carbon\Carbon;
use Validator;
use DB;
use App\Models\OptionValue;

class AttendenceController extends Controller
{
   public function index($class_room_id, $unit_id){

   	//option_id = 1 la trang thai diem danh
   	$types = OptionValue::select('id', 'name')->where('option_id', 1)->get();

   	$attendences = StudentClassRoom::getStudent($class_room_id, $unit_id);

   	$class_room_name = ClassRoom::find($class_room_id)->class_name;

   	return view('class_room_units.listAttendence')->with(array(
   		'attendences'	  => $attendences,
   		'types'           => $types,
   		'class_room_id'	  => $class_room_id,
   		'unit_id' 		  => $unit_id,
   		'class_room_name' => $class_room_name
   	));

   	}

   public function createAttendence(Request $request){
   	
		$data = $request->all();
		$data_without_token = array();

		// tạo array mới không có token
		foreach ($data as $key => $value) {
			if($key != "_token"){
				array_push($data_without_token, $value);
			}
		}
		// chuyển mảng 1 chiều thành mảng 2 chiều
		$new_data = array_chunk($data_without_token, 6);

		// Xóa tất cả dữ liệu điểm danh của Unit thuộc lớp tướng ứng với các id truyền vào
		Attendence::where('class_room_unit_id', $data_without_token[5])->where('class_room_id', $data_without_token[4])->delete();
		// Thêm dữ liệu điểm danh
		foreach ($new_data as $key => $value) {
			$Attendence = new Attendence;
			$Attendence->user_id = $value[2];
			$Attendence->class_room_id = $value[4];
			$Attendence->class_room_unit_id = $value[5];
			$Attendence->student_id = $value[3];
			$Attendence->type = $value[0];
			$Attendence->reason = $value[1];
			$Attendence->save();
		}

        return Redirect(route('attendances.list',['class_room_id' => $data_without_token[4], 'unit_id' => $data_without_token[5]]));
	   
   }
 }

