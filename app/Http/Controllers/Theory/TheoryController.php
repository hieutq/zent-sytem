<?php

namespace App\Http\Controllers\Theory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Theory;
use App\Models\TheoryGroup;
use Validator;
use DB;
use Log;

class TheoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $theories = Theory::where('theory_group_id', $id)->orderBy('theories.id','DESC')->paginate(env('PAGES'));
        
        $flag    = Theory::count() > env('PAGES') ? true : false;

        $theory_group_name = TheoryGroup::find($id)->name;

        return view('theories.index',[
            'theories' => $theories,
            'flag' => $flag,
            'theory_group_name' => $theory_group_name,
            'id'   => $id
        ]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        
        $rules = ['name' => 'required', 'content' => 'required'];

        $messages = ['name.required' => 'Tên không được để trống', 'content.required' => 'Nội dung không được để trống'];


        $validator = Validator::make($data, $rules, $messages);


        if ($validator->fails()) {

            return response()->json([
                    'error' => true,
                    'message' => $validator->errors(),
                ], 200);
        }

        DB::beginTransaction();
        try {

            $theory = Theory::create($data);

            DB::commit();

            return response()->json([
                    'error' => false,
                    'data' => $theory
                ], 200);

        } catch(Exception $e) {
            Log::info('Can not create theory has name ' . $data['name']);
            DB::rollback();
            return response()->json([
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
            'data'  => Theory::find($id)
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
        
        $rules = ['name' => 'required', 'content' => 'required'];

        $messages = ['name.required' => 'Tên không được để trống', 'content.required' => 'Nội dung không được để trống'];


        $validator = Validator::make($data, $rules, $messages);


        if ($validator->fails()) {

            return response()->json([
                    'error' => true,
                    'message' => $validator->errors(),
                ], 200);
        }

        DB::beginTransaction();
        try {

            $group = Theory::where('id', $id);

            $group->update([
                'name' => $data['name'],
                'content' => $data['content'],
            ]);
            

            DB::commit();

            return response()->json([
                    'error' => false,
                    'data' => $group
                ], 200);

        } catch(Exception $e) {
            Log::info('Can not update theory group has name ' . $data['name']);
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
            Theory::where('id', $id)->delete();


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
