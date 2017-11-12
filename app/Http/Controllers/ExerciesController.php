<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Exercise;
use App\Models\TheoryGroup;
use App\Models\Level;
use DB;
class ExerciesController extends Controller
{
   public function index(){
   	$exercises = Exercise::orderBy('id','desc')->paginate(env('PAGES'));  
   	$theoryGroup=TheoryGroup::all();
   	$levels=Level::all();
   	$flag = Exercise::count() > env('PAGES') ? true : false;

   	return view('exercises.listExercises')->with(array(
   		'exercises'	  => $exercises,
   		'theoryGroup'	  => $theoryGroup,
   		'levels'	  => $levels,
   		'flag'	  => $flag

   	));
   }
   //Search
    public function search(Request $request) {  
   		$keyword = $request->input('keyword');
  		$exercises = Exercise::search($keyword);
      // dd($exercises);
  		$flag = Exercise::count() > env('PAGES') ? true : false;
  		$view = view('exercises.data')->with(array(
  			'exercises' => $exercises,
  			'flag' =>$flag
  		))->render();
  		return $view;
     	}
   //End Search
   //Create 
      public function createExercise(Request $request) {
      $data = Exercise::validate_rules ($request->all(), Exercise::$rules, Exercise::$messages);
        if ($data['error']) {
            return response()->json([
                'error' => true,
                'messages' => $data['messages']
            ], 200);
        }

      DB::beginTransaction();
      try {
        // dd($request->all());
         Exercise::newExercise($request->all());

         $datas = Exercise::orderBy('created_at','desc')->paginate(env('PAGES'));
         $flag = Exercise::count() > env('PAGES') ? true : false;
         $view = view('exercises.dataCreate-edit')->with(array(
            'exercises' => $datas,
            'flag' =>$flag
         ))->render();

         DB::commit();
         return $view;         

      } catch (Exception $e) {

         Log::info('can not create Exercise');

            DB::rollback();
      }
   }


   //Delete
     public function deleteExercises(Request $request){
        DB::beginTransaction();
        try {
          if ($request->ajax()) {
            Exercise::destroy($request->id);
          $exercises = Exercise::paginate(env('PAGES'));
          $flag = Exercise::count() > env('PAGES') ? true : false;
          $view = view('exercises.data')->with(array(
            'exercises' => $exercises,
            'flag' =>$flag
          ))->render();

            DB::commit();
            return $view;
              
          }
        } catch (Exception $e) {
          DB::rollback();
    }
  }
  //End Delete

   //Show
   public function showExercises(Request $request) {
    if ($request->ajax()) {
      $ID=$request->id;
      $data = Exercise::show($ID);

      return response()->json(['result'=>$data]);

    }
  }

  //Update
  public function updateExercises(Request $request) {

    DB::beginTransaction();

    $data = Exercise::validate_rules ($request->all(), Exercise::$rules, Exercise::$messages);

    if ($data['error']) {
      return response()->json([
        'error' => true,
        'messages' => $data['messages']
      ]);
    }
    try {
      
      Exercise::store($request);
      $datas = Exercise::orderBy('id','desc')->paginate(env('PAGES'));
      $flag = Exercise::count() > env('PAGES') ? true : false;
      $view = view('exercises.dataCreate-edit')->with(array(
        'exercises' => $datas,
        'flag' =>$flag
      ))->render();
      DB::commit();
      return $view;


    } catch (Exception $e) {

      Log::info('can not create');

            DB::rollback();
    }
  }
  // End Update
}
