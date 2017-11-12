<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Theory;
use App\Models\TheoryGroup;
use DB;
class TheoriesController extends Controller
{
    public function index(){
   	$theory = Theory::orderBy('id','desc')->paginate(env('PAGES'));
   	$theoryGroup = TheoryGroup::All();
   	$flag = Theory::count() > env('PAGES') ? true : false;

   	return view('theories.listTheories')->with(array(
   		'theory'=> $theory,
   		'theoryGroup'=> $theoryGroup,
   		'flag' => $flag
   	));
   }

   //Search
   public function search(Request $request) {
         $keyword = $request->input('keyword');
         $theory = Theory::search($keyword);
         $flag     = Theory::count() > env('PAGES') ? true : false;
         $view  = view('theories.data',[
            'theory' => $theory,
            'flag'     => $flag  
         ])->render();
         return $view;
      }
   //End Search

   //Create 
      public function createTheory(Request $request) {

      
      $data = Theory::validate_rules ($request->all(), Theory::$rules, Theory::$messages);
        if ($data['error']) {
            return response()->json([
                'error' => true,
                'messages' => $data['messages']
            ], 200);
        }

      DB::beginTransaction();
      try {
        // dd($request->all());
         Theory::newTheory($request->all());

         $datas = Theory::orderBy('created_at','desc')->paginate(env('PAGES'));
         $flag = Theory::count() > env('PAGES') ? true : false;
         $view = view('theories.data')->with(array(
            'theory' => $datas,
            'flag' =>$flag
         ))->render();

         DB::commit();
         return $view;         

      } catch (Exception $e) {

         Log::info('can not create Theory');

            DB::rollback();
      }
   }
   //Show
   public function showTheory(Request $request) {
    if ($request->ajax()) {
      $ID=$request->id;
      $data = Theory::show($ID);

      return response()->json(['result'=>$data]);

    }
  }

  //Update
  public function updateTheory(Request $request) {

    DB::beginTransaction();

    $data = Theory::validate_rules ($request->all(), Theory::$rules, Theory::$messages);

    if ($data['error']) {
      return response()->json([
        'error' => true,
        'messages' => $data['messages']
      ]);
    }
    try {
      
      Theory::store($request);
      $datas = Theory::orderBy('id','desc')->paginate(env('PAGES'));
      $flag = Theory::count() > env('PAGES') ? true : false;
      $view = view('theories.data')->with(array(
        'theory' => $datas,
        'flag' =>$flag
      ))->render();
      // $getTheoryGroup = TheoryGroup::select('id','name')->get();
      // $datas = [$studentCare,$getStudentCare];
      DB::commit();
      return $view;
      // $getStudentCare=StudentCare::with('student','user')->get();

      
      // return response()->json([
      //   'theory' => $theory,
      //   'getTheoryGroup' => $getTheoryGroup  
      // ],200);

    } catch (Exception $e) {

      Log::info('can not create studentcare');

            DB::rollback();
    }
  }
  // End Update

  //Delete
     public function deleteTheory(Request $request){

        DB::beginTransaction();
        try {
          if ($request->ajax()) {

            Theory::destroy($request->id);

          $theory = Theory::paginate(env('PAGES'));
          $flag = Theory::count() > env('PAGES') ? true : false;
          $view = view('theories.data')->with(array(
            'theory' => $theory,
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

}
