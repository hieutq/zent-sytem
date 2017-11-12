<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserClassRoom;
use App\Models\User;
use DB;

class UserClassRoomController extends Controller
{
 // search studen
	public function search_user_add_class(Request $request){
		if ($request->ajax()) {
			try {

				$keyword=$request->keyword;
			
				$data_search_user=UserClassRoom::search_add_user_class($keyword);
				
				$view = view('user_class_room.data_search_add')->with(array(
				'data_search_user'      => $data_search_user
				));
			
				return $view;
			} catch (Exception $e) {
				
			}
		}
	}   
 // search studen
	public function add_manager_class(Request $request,$id_classRoom){
        DB::beginTransaction();
        if ($request->ajax()) {
            try {

                $manager_id=$request->manager_id;
                $type_manager=$request->type_manager;
                $class_room_id=$id_classRoom;
                
                // dd($id_student);
                if ($manager_id =="") {
                    return response()->json(['error_unselect_manager'=>'Bạn chưa chọn quản lý !!']); 
                }
                
                else if ($manager_id !="") {
                    $check_manager=UserClassRoom::check_manager_class($class_room_id,$manager_id);
                    
                    if ($check_manager>0) {
                        return response()->json(['error'=>'Quản lý này đã tồn tại !!']);
                    }    
               else{
               	// add manager
                    $add_manager=UserClassRoom::add_manager_class_room($class_room_id,$manager_id,$type_manager);
                    $list_manager_class=UserClassRoom::manager_class($class_room_id);
                    $flag_manager_class =(UserClassRoom::where('class_room_id',$class_room_id)->count() > env('PAGES')) ? true : false;
                     DB::commit();
                    $view= view('user_class_room.list_manager_class')->with(array(
                        'list_manager_class'  => $list_manager_class,
                        'flag_manager_class' =>$flag_manager_class
                        ))->render();
                        return $view;
                        
                    }
                 }           
            } catch (Exception $e) {
                DB::rollback();
            }

            
        }
	}  
}
