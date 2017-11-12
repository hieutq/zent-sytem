<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use View;
use Validator;
use DB;

use App\Models\Student;
use App\Models\StudentClassRoom;
use App\Models\Rank;
use App\Models\ClassRoom;
use App\Models\ClassRoomUnit;
use App\Models\ClassRoomUnitTheory;
use App\Models\ClassRoomUnitExercise;
use App\Models\Theory;
use App\Models\Exercise;
use App\Models\Answer;
use App\Models\StudentHomeWork;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.student');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $classes = StudentClassRoom::where('student_id', Auth::user()->id)->orderBy('status', 'asc')->get();
        $sum_point = $classes->sum('sum_point');
        $avg_point = $classes->sum('avg_point');
        $level_name = 'Basic';

        $check_level = Rank::where('min', '<=', $sum_point)->where('max', '>=', $sum_point)->first();

        if ($check_level) {
            $level_name = $check_level->name;
        }
        return view('student.dashboard', [
            'classes' => $classes,
            'sum_point' => $sum_point,
            'avg_point' => $avg_point,
            'level_name' => $level_name
        ]);
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

        //update param
        $data['time_submit'] = date("Y-m-d H:i:s");


        $rules = ['content' => 'required'];

        $messages = ['content.required' => 'Nội dung không được để trống'];


        $validator = Validator::make($data, $rules, $messages);


        if ($validator->fails()) {

            return response()->json([
                    'error' => true,
                    'message' => $validator->errors(),
                ], 200);
        }

        DB::beginTransaction();
        try {

            $result = StudentHomeWork::create($data);

            DB::commit();

            return response()->json([
                    'error' => false,
                    'data' => $result
                ], 200);

        } catch(Exception $e) {
            Log::info('Can not submit exercise');
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
    public function destroy($id)
    {
        //
    }

    /**
     * get excercise belong unit
     */

    public function getListUnit($id) {

        $exercises = ClassRoomUnit::where('class_room_id', $id)
                                    ->where('status', 1)
                                    ->orderBy('created_at', 'desc')->get();
        $classes = StudentClassRoom::where('student_id', Auth::user()->id)
                                    ->orderBy('status', 'asc')->get();
        return view('student.list-unit', [
                'exercises' => $exercises,
                'classes'   => $classes
            ]);
    }

    /**
     * get theories belong unit
     */

    public function getListTheory($class_id, $unit_id) {

        $name = 'No Name';

        $class_unit = ClassRoomUnit::where('id', $unit_id)->first();
        if ($class_unit) {
            $name = $class_unit->unit_name;
        }
        $classes = StudentClassRoom::where('student_id', Auth::user()->id)
                                    ->orderBy('status', 'asc')->get();

        $array_ids = ClassRoomUnitTheory::select('theory_id')->where('class_room_unit_id', $unit_id)->get()->toArray();

        $theories = Theory::whereIn('id',  $array_ids)->orderBy('created_at', 'asc')->get();


        return view('student.list-theories', [
                'classes'   => $classes,
                'theories'  => $theories,
                'name'      => $name,
            ]);
    }

    /**
     * get theories belong unit
     */

    public function getListExercise($class_id, $unit_id) {

        $name = 'No Name';

        $class_unit = ClassRoomUnit::where('id', $unit_id)->first();
        if ($class_unit) {
            $name = $class_unit->unit_name;
        }

        $classes = StudentClassRoom::where('student_id', Auth::guard('student')->user()->id)
                                    ->orderBy('status', 'asc')->get();

        $array_ids = ClassRoomUnitExercise::select('exercise_id')->where('class_room_unit_id', $unit_id)->get()->toArray();

        $exercises = Exercise::whereIn('id',  $array_ids)->orderBy('created_at', 'asc')->get();

        $flag = StudentHomeWork::where('class_room_unit_id', $unit_id)->where('student_id', Auth::guard('student')->user()->id)->first();

        $is_submited = false;
        $open_answer = 0;
        if ($flag) {
            $is_submited = true;
            $open_answer = $flag->open_answer;
        }

        $unit_exercises = ClassRoomUnitExercise::where('class_room_unit_id', $unit_id)->get();

        if ($unit_exercises) {
            foreach ($unit_exercises as $key => &$unit_exercise) {
                $unit_exercise->exercise = Exercise::where('id',  $unit_exercise->exercise_id)->first();
                $unit_exercise->answer = Answer::where('id', $unit_exercise->answer_id)->first();
            }
        }

        // dd($unit_exercises);

        return view('student.list-exercises', [
                'classes'   => $classes,
                'exercises'  => $exercises,
                'name'      => $name,
                'class_room_unit_id' => $unit_id,
                'is_submited' => $is_submited,
                'open_answer' => $open_answer,
                'unit_exercises' => $unit_exercises
            ]);
    }
}























