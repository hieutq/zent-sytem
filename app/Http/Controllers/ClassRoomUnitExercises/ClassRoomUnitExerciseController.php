<?php

namespace App\Http\Controllers\ClassRoomUnitExercises;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ClassRoomUnitExercise;
use DB;

class ClassRoomUnitExerciseController extends Controller
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
    public function store(Request $request)
    {
       DB::beginTransaction();
        try {
            if ($request->ajax()) {
                
                $data=$request->all();
                // check exercise exits

                // dd($data);
                
                $check=ClassRoomUnitExercise::withTrashed()->where('class_room_unit_id',$data['class_room_unit_id'])->where('exercise_id',$data['exercise_id'])->where('answer_id',$data['answer_id'])->get()->count();


                    if ($check >0) {
                        $delete_exercise_exits=ClassRoomUnitExercise::withTrashed()->where('class_room_unit_id',$data['class_room_unit_id'])->where('exercise_id',$data['exercise_id'])->where('answer_id',$data['answer_id'])->forceDelete();
                        // create new
                        $new_exercise_unit=ClassRoomUnitExercise::create($data);
                    }else{

                        //create new
                        $new_exercise_unit=ClassRoomUnitExercise::create($data);
                    }
                

                DB::commit();

                return response()->json([
                    'error'      => false,
                    'new_exercise_unit' =>$new_exercise_unit
                    ]);  
            }
            
        } catch (Exception $e) {
            DB::rollback();
               return response()->json([
                    'error'      => true,
                    'msg' =>'Add new Exercise unit Error !!'
                    ]);
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
            if ($request->ajax()) {
                
                $data=$request->all();

                //delete exercise unit 

                $delete_exercise_unit=ClassRoomUnitExercise::where('class_room_unit_id',$data['class_room_unit_id'])->where('exercise_id',$data['exercise_id'])->where('answer_id',$data['answer_id'])->delete();

                DB::commit();

                return response()->json([
                'error'      => false,
                'msg' =>'Xóa bài tập thành công !!'
                ]);  
            }
        } catch (Exception $e) {
            DB::rollback();
                return response()->json([
                'error'      => true,
                'msg' =>'Xóa bài tập không thành công !!'
                ]); 
        }
    }
}
