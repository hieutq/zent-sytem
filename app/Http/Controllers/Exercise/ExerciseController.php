<?php

namespace App\Http\Controllers\Exercise;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TheoryGroup;
use App\Models\Theory;
use Validator;
use DB;
use Log;
use App\Models\Exercise;
use App\Models\Level;
use App\Models\Language;
use App\Models\Answer;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $theory_group_id = $request->input('theory_group_id', 0);

        $theory_group_name = 'No Name';

        $theorygroup = TheoryGroup::where('id', $theory_group_id)->first();
        if ($theorygroup) {
            $theory_group_name = $theorygroup->name;
        }

        $theory_id = $request->input('theory_id', 0);

        $theory_name = 'No Name';

        $theory = TheoryGroup::where('id', $theory_id)->first();

        if ($theory) {
            $theory_name = $theory->name;
        }

        $exercises = Exercise::orderBy('id','DESC');

        if ($theory_group_id) {
            $exercises = $exercises->where('theory_group_id', $theory_group_id);
        }

        if ($theory_id) {
            $exercises = $exercises->where('theory_id', $theory_id);
        }

        $exercises = $exercises->paginate(env('PAGES'));
       
        $flag    = Exercise::count() > env('PAGES') ? true : false;

        return view('exercises.index',[
            'exercises' => $exercises,
            'flag' => $flag,
            'theory_group_id' => $theory_group_id,
            'theory_group_name' => $theory_group_name,
            'theory_id' => $theory_id,
            'theory_name' => $theory_name

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


        $theory_group_id = $request->input('theory_group_id', 0);

        $theory_id = $request->input('theory_id', 0);

        $exercise_id = $request->input('exercise_id', 0);

        $groups = TheoryGroup::orderBy('created_at', 'desc')->get();

        $theories = Theory::where('theory_group_id', $theory_group_id)->orderBy('created_at', 'desc')->get();
        
        $step = $request->input('step', 1);
        
        $levels = Level::get();

        $languages = Language::get();

        $answers = Answer::where('exercises_id', $exercise_id)->orderBy('created_at', 'desc')->get();

       
        return view('exercises.create',[
            'theory_group_id' => $theory_group_id,
            'theory_id' => $theory_id,
            'groups' => $groups,
            'theories' => $theories,
            'levels' => $levels,
            'step' => $step,
            'languages' => $languages,
            'exercise_id' => $exercise_id,
            'answers' => $answers

        ]);
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
            'theory_group_id' => 'required',
            'theory_id' => 'required',
            'name' => 'required',
            'level_id' => 'required',
            'content' => 'required',
            ];

        $messages = [
            'theory_group_id.required' => 'Vui lòng chọn nhóm lý thuyết',
            'theory_id.required' => 'Vui lòng chọn lý thuyết',
            'name.required' => 'Tên không được để trống',
            'level_id.required' => 'Vui lòng chọn mức độ',
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

            $exercise = Exercise::create($data);

            DB::commit();

            return response()->json([
                    'error' => false,
                    'data' => $exercise
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        $exercise = Exercise::where('id', $id)->first();

        $theory_group_id = $exercise->theory_group_id;

        $theory_id = $exercise->theory_group_id;

        $exercise_id = $id;

        $groups = TheoryGroup::orderBy('created_at', 'desc')->get();

        $theories = Theory::where('theory_group_id', $theory_group_id)->orderBy('created_at', 'desc')->get();
        
        $step = $request->input('step', 1);

        $edit = $request->input('edit', 1);
        
        $levels = Level::get();

        $languages = Language::get();

        $answers = Answer::where('exercises_id', $exercise_id)->orderBy('created_at', 'desc')->get();

        
        return view('exercises.edit',[
            'theory_group_id' => $theory_group_id,
            'theory_id' => $theory_id,
            'groups' => $groups,
            'theories' => $theories,
            'levels' => $levels,
            'step' => $step,
            'languages' => $languages,
            'exercise_id' => $exercise_id,
            'answers' => $answers,
            'exercise' => $exercise,
            'edit'     => $edit

        ]);
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
        
        $rules = [
            'theory_group_id' => 'required',
            'theory_id' => 'required',
            'name' => 'required',
            'level_id' => 'required',
            'content' => 'required',
            ];

        $messages = [
            'theory_group_id.required' => 'Vui lòng chọn nhóm lý thuyết',
            'theory_id.required' => 'Vui lòng chọn lý thuyết',
            'name.required' => 'Tên không được để trống',
            'level_id.required' => 'Vui lòng chọn mức độ',
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

            $exercise = Exercise::where('id', $id)->first();

            $exercise->update($data);

            DB::commit();

            return response()->json([
                    'error' => false,
                    'data' => $exercise
                ], 200);

        } catch(Exception $e) {
            Log::info('Can not update exercise');
            DB::rollback();
            response()->json([
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


            Exercise::where('id', $id)->delete();

            DB::commit();

            return response()->json([
                    'error' => false,
                    'message' => 'Delete success!'
                ], 200);

        } catch(Exception $e) {
            Log::info('Can not delete exercise has id = ' . $id);
            DB::rollback();
            response()->json([
                    'error' => true,
                    'message' => 'Internal Server Error'
                ], 500);
        }
    }
}
