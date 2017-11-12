<?php

namespace App\Http\Controllers\ClassRoomUnitTheory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use Log;

use App\Models\ClassRoomUnitTheory;
use App\Models\ClassRoomUnitExercise;
use App\Models\Exercise;
use App\Models\Answer;
class ClassRoomUnitTheoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function get_exercise_by_theory($theory_unit){

        $exercise = collect();

          foreach ($theory_unit as $get_exercise) {

              $get_exercise->data_exercise_unit=Exercise::where('theory_id',$get_exercise->theory_id)->get();
              // echo $get_exercise->theory_id;
              // echo "</br>";
// dd($data_exercise_unit);
             if (count($get_exercise->data_exercise_unit) > 0) {

                 foreach ($get_exercise->data_exercise_unit as $db_exercise) {

                    $db_exercise->checked= false;
                     // check exercise exits unit
                    $check =ClassRoomUnitExercise::where('class_room_unit_id',$get_exercise->class_room_unit_id)->where('exercise_id',$db_exercise->id)->first();

                    if ($check) {
                        if ($check->exercise_id == $db_exercise->id) {

                            $db_exercise->checked= true;
                        }
                    }

                    // get answer
                    $db_exercise->answer=Answer::where('exercises_id',$db_exercise->id)->get();

                    foreach ($db_exercise->answer as $db_answer) {

                        $db_answer->selected= false;

                        $check_answer=ClassRoomUnitExercise::select('answer_id')->where('class_room_unit_id',$get_exercise->class_room_unit_id)->where('exercise_id',$db_exercise->id)->first();

                            if ($check_answer) {

                               if ($check_answer->answer_id == $db_answer->id) {
                                
                                    $db_answer->selected= true;
                               }
                            }
                        }
                        
                     }

                     $exercise->push($get_exercise->data_exercise_unit);        
             }
          }

            $collapse_exercise=$exercise->collapse();



            $data_exercise=json_decode($collapse_exercise, true);
            
            return $data_exercise;

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
	   				'class_room_unit_id' 		=> 'required',
	   				'theory_id' 				=> 'required'
	   			
	   			];
	   			$messages=[
	   				'class_room_unit_id.required'	=> 'Bạn vui lòng nhập mã lớp',
	   				'theory_id.required'			=> 'Bạn vui lòng nhập tên lớp'	
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

                // check exercise for theory before add new

                    $check_exercise=Exercise::where('theory_id',$data['theory_id'])->get()->count();

                // check theory exits
                    $check=ClassRoomUnitTheory::check_add_theory($data);

                    if ($check > 0) {
                        if ($check_exercise > 0) {
                        // delete theory exits where delete_at
                            $del_theory_exits=ClassRoomUnitTheory::withTrashed()->where('class_room_unit_id',$data['class_room_unit_id'])->where('theory_id',$data['theory_id'])->forceDelete();
                        // add new theory
                            $new_theory= ClassRoomUnitTheory::create($data);

                        // reload exercise
                            DB::commit();
                            // get theory 
                                $theory_unit=ClassRoomUnitTheory::select('theory_id','class_room_unit_id')->where('class_room_unit_id',$data['class_room_unit_id'])->get();
                                // dd($theory_unit->count());
// dd($theory_unit);
                                    $data_exercise=$this->get_exercise_by_theory($theory_unit);

                                    // dd($data_exercise);

                                      $view = view('class_room_units.class_room_unit_exercise.data_exercises')->with(array(

                                        'data_exercise' => $data_exercise

                                      ))->render();
                                      
                                      

                                      return response()->json([
                                            'error'      => false,
                                            'view'       => $view
                                            ], 200);
                            }else{
                                      return response()->json([
                                            'error'      => true,
                                            'msg' =>'Lý thuyết này chưa có bài tập không thể thực hiện thao tác !!'
                                            ]);
                        }

                    }else{

                        if ($check_exercise > 0) {
                        // add new theory

                            $new_theory= ClassRoomUnitTheory::create($data);   

                            DB::commit();
                            // reload exercise

                                // get theory 
                                    $theory_unit=ClassRoomUnitTheory::select('theory_id','class_room_unit_id')->where('class_room_unit_id',$data['class_room_unit_id'])->get();

// dd($theory_unit);
                                        $data_exercise=$this->get_exercise_by_theory($theory_unit);
                                        // dd($data_exercise);
                                        $view = view('class_room_units.class_room_unit_exercise.data_exercises')->with(array(

                                            'data_exercise' => $data_exercise

                                          ))->render();
                                          
                                          

                                          return response()->json([
                                                'error'      => false,
                                                'view'       => $view
                                                ], 200);
                                
                                }else{
                                       return response()->json([
                                            'error'      => true,
                                            'msg' =>'Lý thuyết này chưa có bài tập không thể thực hiện thao tác !!'
                                            ]);                           
                         }                                    
                    }
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
        //
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
        //
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
            // delete theory unit

            ClassRoomUnitTheory::where('class_room_unit_id',$request->class_room_unit_id)->where('theory_id',$id)->delete();

            // reload exercise

            $theory_unit=ClassRoomUnitTheory::select('theory_id','class_room_unit_id')->where('class_room_unit_id',$request->class_room_unit_id)->get();
                    
            $data_exercise=$this->get_exercise_by_theory($theory_unit);

            // view

            $view = view('class_room_units.class_room_unit_exercise.data_exercises')->with(array(

                'data_exercise' => $data_exercise

              ))->render();
                      
            DB::commit();

            return response()->json([
                    'error' => false,
                    'message' => 'Delete success!',
                    'view' =>$view
                ], 200);

        } catch(Exception $e) {
            Log::info('Can not delete theory has id = ' . $id);
            DB::rollback();
            response()->json([
                    'error' => true,
                    'message' => 'Internal Server Error'
                ], 500);
        }
    }
}
