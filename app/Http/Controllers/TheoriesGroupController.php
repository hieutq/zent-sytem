<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\TheoryGroup;
use Validator;
use DB;
class TheoriesGroupController extends Controller
{
    public function index(){
   	$theoryGroup = TheoryGroup::orderBy('id','desc')->paginate(env('PAGES'));
   	// $theoriesGroup = Theories::All();
   	$flag = TheoryGroup::count() > env('PAGES') ? true : false;

   	return view('theoryGroup.listTheoryGroup')->with(array(
   		'theoryGroup'=> $theoryGroup,
   		// 'theoriesGroup'=> $theoriesGroup,
   		'flag' => $flag
   	));
   }
    public function createTheoryGroup(Request $request){
   	DB::beginTransaction();
   		try{
   			if ($request->ajax()) {
	   			$rules=[
	   				'name' 						=> 'required',
	   			];
	   			$messages=[
	   				'name.required'					=> 'Bạn vui lòng nhập tên',
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
	   				TheoryGroup::create($data);	   				
	   				$datas = TheoryGroup::orderBy('created_at','desc')->paginate(env('PAGES'));
					$flag = TheoryGroup::count() > env('PAGES') ? true : false;
					$view = view('theoryGroup.data')->with(array(
						'theoryGroup' => $datas,
						'flag' =>$flag
					))->render();
				    DB::commit();
				    return $view;
				  
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
   			
   		}  
   }
   //Edit Class
	public function showTheoryGroup(Request $request){
   	if ($request->ajax()) {
   		$theoryGroup = TheoryGroup::find($request->id);
   		return response($theoryGroup);
   		return view('theoryGroup.listTheoryGroup',compact('theoryGroup'));
   		} 	
    }
   	public function updateTheoryGroup(Request $request) {
   		   	DB::beginTransaction();
   			if ($request->ajax()) {
	   			$rules=[
	   				'name' 		=> 'required'
	   	
	   			];
	   			$messages=[
	   				'name.required'		=> 'Bạn vui lòng nhập Tên'
	   			];
	   			$validator=Validator::make($request->all(),$rules,$messages);
	   			if ($validator->fails()) {
	   				return response()->json([
	   					'error'      => true,
	   					'message'   =>$validator->errors()
	   				],200);
	   			}
	   			else{
	   				try { 
	   					$theoryGroup= TheoryGroup::find($request->editID);
		   				$theoryGroup->name=$request->name;
		   				$theoryGroup->save();
	   				DB::commit();
	   				return response($theoryGroup);
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
		//End Edit

		//Delete
	public function deleteTheorygroup(Request $request){
	   	DB::beginTransaction();
	   	try {
	   		if ($request->ajax()) {
	   		TheoryGroup::destroy($request->id);
	   		$theoryGroup = TheoryGroup::paginate(env('PAGES'));
			$flag = TheoryGroup::count() > env('PAGES') ? true : false;
			$view	 = view('theoryGroup.data',[
				'theoryGroup' => $theoryGroup,
				'flag'	  => $flag	
	   		])->render();
	   		DB::commit();
	        return $view;
	   	}
	   	} catch (Exception $e) {
	   		DB::rollback();
	   	}	   		
   }
		//End delete

   //Search
   	public function search(Request $request) {
   		$keyword = $request->input('keyword');
   		$theoryGroup = TheoryGroup::search($keyword);
   		$flag 	 = TheoryGroup::count() > env('PAGES') ? true : false;
   		$view	 = view('theoryGroup.data',[
   			'theoryGroup' => $theoryGroup,
   			'flag'	  => $flag	
   		])->render();
   		return response($view);
   	}
   //End Search
}