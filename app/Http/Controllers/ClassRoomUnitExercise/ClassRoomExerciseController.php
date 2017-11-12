<?php

namespace App\Http\Controllers\ClassRoomUnitExercise;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use Log;

use App\Models\ClassRoomUnitExercise;

class ClassRoomExerciseController extends Controller
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
        try{
            if ($request->ajax()) {
                $rules=[
                    'class_room_unit_id'        => 'required',
                    'exercise_id'                 => 'required',
                    'answer_id'                 => 'required'
                
                ];
                $messages=[
                    'class_room_unit_id.required'   => 'Bạn vui lòng nhập mã lớp',
                    'exercise_id.required'            => 'Bạn vui lòng nhập tên lớp', 
                    'answer_id.required'            => 'Chưa có câu trả lời'
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
                    $data=$request->all();

                    // dd($data);

                    $check= ClassRoomUnitExercise::onlyTrashed()->where('class_room_unit_id',$data['class_room_unit_id'])->where('exercise_id',$data['exercise_id'])->where('answer_id',$data['answer_id'])->get()->count();
                    
                        if ($check) {
                            // delete exercise exits
                            $dele_exercise=ClassRoomUnitExercise::onlyTrashed()->where('class_room_unit_id',$data['class_room_unit_id'])->where('exercise_id',$data['exercise_id'])->where('answer_id',$data['answer_id'])->forceDelete();

                            // add new
                            $new_exercise_class=ClassRoomUnitExercise::create($request->all());
                        }else{
                            // add new
                            $new_exercise_class=ClassRoomUnitExercise::create($request->all());
                        }
           
                        DB::commit();
                        return response()->json([
                            'error' => false,
                            'data_class' => $new_exercise_class

                        ], 200);
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

            ClassRoomUnitExercise::where('class_room_unit_id',$request->class_room_unit_id)->where('exercise_id',$id)->where('answer_id',$request->answer_id)->delete();

            DB::commit();

            return response()->json([
                    'error' => false,
                    'message' => 'Delete success!'
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
