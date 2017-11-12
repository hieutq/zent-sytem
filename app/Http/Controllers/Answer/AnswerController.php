<?php

namespace App\Http\Controllers\Answer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use Log;

use App\Models\Answer;
use App\Models\Language;

class AnswerController extends Controller
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
        $data = $request->all();
        

        $rules = [
            'language_id' => 'required',
            'content' => 'required',
            ];

        $messages = [
            'language_id.required' => 'Vui lòng chọn ngôn ngữ',
            'content.required' => 'Vui lòng nhập nội dung'
            ];


        $validator = Validator::make($data, $rules, $messages);


        if ($validator->fails()) {

            return response()->json([
                    'error' => true,
                    'message' => $validator->errors(),
                ], 200);
        }

        DB::beginTransaction();
        try {

            $answer = Answer::create($data);

            DB::commit();


            return response()->json([
                    'error' => false,
                    'data' => $answer
                ], 200);

        } catch(Exception $e) {
            Log::info('Can not create exercise has name ');
            DB::rollback();
            response()->json([
                    'error' => true,
                    'message' => 'Internal Server Error'
                ], 500);
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
        return response()->json([
            'error' => false,
            'data' => Answer::find($id),
            'languages' => Language::get(),
        ], 200);
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
        $data = $request->all();
        
        $rules = ['language_id' => 'required', 'content' => 'required'];

        $messages = ['language_id.required' => 'Vui lòng chọn ngôn ngữ', 'content.required' => 'Nội dung không được để trống'];


        $validator = Validator::make($data, $rules, $messages);


        if ($validator->fails()) {

            return response()->json([
                    'error' => true,
                    'message' => $validator->errors(),
                ], 200);
        }

        DB::beginTransaction();
        try {

            $answer = Answer::where('id', $id);

            $answer->update([
                'language_id' => $data['language_id'],
                'content' => $data['content'],
            ]);
            

            DB::commit();

            return response()->json([
                    'error' => false,
                    'data' => $answer
                ], 200);

        } catch(Exception $e) {
            Log::info('Can not update answer has name ' . $data['name']);
            DB::rollback();
            return response()->json([
                    'error' => true,
                    'message' => 'Internal Server Error'
                ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            //delete theory
            Answer::where('id', $id)->delete();


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
