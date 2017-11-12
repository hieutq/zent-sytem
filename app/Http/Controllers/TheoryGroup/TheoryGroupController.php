<?php

namespace App\Http\Controllers\TheoryGroup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TheoryGroup;
use Validator;
use DB;
use Log;

use App\Models\Theory;
use App\Models\Answer;
use App\Models\Exercise;
use App\Models\Course;
use App\Models\CoureseTheoryGroup;
class TheoryGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $theory_groups = TheoryGroup::orderBy('id','DESC')->paginate(env('PAGES'));
       
        $flag    = TheoryGroup::count() > env('PAGES') ? true : false;

        $list_courses=Course::orderBy('id','desc')->select('short_name','id')->get();

        return view('theoryGroup.index',[
            'theory_groups' => $theory_groups,
            'list_courses'  => $list_courses,
            'flag' => $flag
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
 
        $rules = ['name' => 'required','course_id' => 'required'];

        $messages = ['name.required' => 'Tên không được để trống','courses_id.required' => 'Khóa học không được để trống'];


        $validator = Validator::make($data, $rules, $messages);

      

        if ($validator->fails()) {

            return response()->json([
                    'error' => true,
                    'message' => $validator->errors(),
                ], 200);
        }

        DB::beginTransaction();
        try {
            
            $name=$request->name;

            $group = TheoryGroup::create_theory_group($name);

            if ($group->id) {

                $data_course_theory_group=[
                    'course_id'       =>$request->course_id,
                    'theory_group_id' =>$group->id
                ];
              
                $course_theory_group=CoureseTheoryGroup::create($data_course_theory_group);
                
            }
          

            DB::commit();

            return response()->json([
                    'error' => false,
                    'data' => $group
                ], 200);

        } catch(Exception $e) {
            Log::info('Can not create theory group has name ' . $data['name']);
            DB::rollback();
            response()->json([
                    'error' => true,
                    'message' => 'Internal Server Error'
                ], 200);
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
        DB::beginTransaction();
        try {

            //delete theory
            Theory::where('theory_group_id', $id)->delete();

            //delete answer and excersise
            $exercises = Exercise::select('id')->where('theory_group_id', $id)->get();

            if ($exercises) {
                foreach ($exercises as $key => $exercise) {
                   Answer::where('exercises_id', $exercise->id)->delete();
                   $exercise->delete();
                }
            }
            //delete theory group
            TheoryGroup::find($id)->delete();

            DB::commit();

            return response()->json([
                    'error' => false,
                    'message' => 'Delete success!'
                ], 200);

        } catch(Exception $e) {
            Log::info('Can not delete theory group has id = ' . $id);
            DB::rollback();
            response()->json([
                    'error' => true,
                    'message' => 'Internal Server Error'
                ], 500);
        }
    }

    /**
     * get list theores by theory group id
     * @param  integer $id 
     * @return collections     
     */
    public function getTheories($id) {

        return Theory::where('theory_group_id', $id)->get();
    }
}
