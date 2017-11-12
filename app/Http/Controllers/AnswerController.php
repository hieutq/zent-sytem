<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Answer;
use App\Models\Language;
use App\Models\Exercise;
use DB;
class AnswerController extends Controller
{
    public function index(){
   	$answer = Answer::orderBy('id','desc')->paginate(env('PAGES'));  
   	$language=Language::all();
   	$exercises=Exercise::all();
   	$flag = Answer::count() > env('PAGES') ? true : false;

   	return view('answers.listAnswers')->with(array(
   		'answer'	  => $answer,
   		'language'	  => $language,
   		'exercises'	  => $exercises,
   		'flag'	  => $flag
   	));
   }
   //Create 
      public function createAnswer(Request $request) {
      $data = Answer::validate_rules ($request->all(), Answer::$rules, Answer::$messages);
        if ($data['error']) {
            return response()->json([
                'error' => true,
                'messages' => $data['messages']
            ], 200);
        }

      DB::beginTransaction();
      try {
        // dd($request->all());
         Answer::newAnswer($request->all());

         $datas = Answer::orderBy('created_at','desc')->paginate(env('PAGES'));
         $flag = Answer::count() > env('PAGES') ? true : false;
         $view = view('answers.dataCreate-edit')->with(array(
            'answer' => $datas,
            'flag' =>$flag
         ))->render();

         DB::commit();
         return $view;         

      } catch (Exception $e) {

         Log::info('can not create Answer');

            DB::rollback();
      }
   }
   //Show
   public function showAnswer(Request $request) {

    if ($request->ajax()) {

      $id=$request->id;

      $data = Answer::show($id);

      return response()->json([
        'result'=>$data,
        'error' => false
        ]);

    }
  }

  //Update
  public function updateAnswer(Request $request) {

    DB::beginTransaction();

    $data = Answer::validate_rules ($request->all(), Answer::$rules, Answer::$messages);

    if ($data['error']) {
      return response()->json([
        'error' => true,
        'messages' => $data['messages']
      ]);
    }
    try {
      
      Answer::store($request);
      $datas = Answer::orderBy('id','desc')->paginate(env('PAGES'));
      $flag = Answer::count() > env('PAGES') ? true : false;

      $view = view('answers.dataCreate-edit')->with(array(
        'answer' => $datas,
        'flag' =>$flag
      ))->render();
      
      DB::commit();
      return $view;

    } catch (Exception $e) {

      Log::info('can not create studentcare');

            DB::rollback();
    }
  }
  // End Update

  //Delete
     public function deleteAnswer(Request $request){

        DB::beginTransaction();
        try {
          if ($request->ajax()) {

            Answer::destroy($request->id);

          $answer = Answer::paginate(env('PAGES'));
          $flag = Answer::count() > env('PAGES') ? true : false;
          $view = view('answers.data')->with(array(
            'answer' => $answer,
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

  //Search
   public function search(Request $request) {
         $keyword = $request->input('keyword');
         $answer = Answer::search($keyword);
         // dd($answer);
         $flag     = Answer::count() > env('PAGES') ? true : false;
         $view  = view('answers.data',[
            'answer' => $answer,
            'flag'     => $flag  
         ])->render();
         return $view;
    }
   //End Search
}