<?php

namespace App\Http\Controllers\ClassroomUnit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassRoomUnit;
use App\Models\ClassRoom;
use App\Models\Theory;
use App\Models\CoureseTheoryGroup;
use App\Models\TheoryGroup;
use App\Models\ClassroomUnitTheory;
use App\Models\ClassRoomUnitExercise;
use App\Models\Exercise;
use App\Models\Answer;
use App\Models\Language;
use App\Models\StudentHomeWork;
use App\Models\Attendence;
use App\Models\StudentClassRoom;
use Validator;
use DB;
use Log;


class ClassRoomUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_list_unit($id_class)
    {
        $data_unit=ClassroomUnit::where('class_room_id',$id_class)->orderBy('id','desc')->get();

        if ($data_unit) {
            foreach ($data_unit as $key => &$data) {

               $data->student_apply_late = StudentHomeWork::where('class_room_unit_id', $data->id)
                                            ->where('time_submit', '>', date('Y-m-d H:i:s', strtotime($data->deadline)))
                                            ->count();

                $flag = Attendence::where('class_room_unit_id', $data->id)->first();
                if ($flag) {
                    $data->absent = Attendence::where('class_room_unit_id', $data->id)->whereIn('type', [3,4])->count();
                } else {
                    $data->absent = "<span style='color:#E08283'>Chưa điểm danh</span>";
                }
                

                $data->student_dont_work = StudentClassRoom::where('class_room_id', $data->class_room_id)->count() - $data->student_apply_late;

            }
        }


        $flag=count(ClassroomUnit::where('class_room_id',$id_class)->get()) > env('PAGES') ? true : false;
        
        return view('class_room_units.listUnit',[
                'flag' => $flag,
                'data_unit' => $data_unit,
                'class_room_id' =>$id_class
       

            ]);


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    /**
     * detail unit 
     *
     * @return data detail unit
     */
    public function get_detail_unit($id_class,$id_unit)
    {
        $data_detail_unit=ClassRoomUnit::getDetail($id_class,$id_unit);

        $flag_data=count($data_detail_unit) > 0 ? true : false;

        if ($flag_data == true) {

            $get_id_courese_class=ClassRoom::select('course_id')->where('id',$id_class)->first();
 
            $courese_theory_group=CoureseTheoryGroup::where('course_id',$get_id_courese_class->course_id)->select('theory_group_id')->get();

            // get theory group combobox
       
            $arr_group=array();

            if (count($courese_theory_group) >0) {

                foreach ($courese_theory_group as $key => $data_theory_group) {
                   
                    $data_theory_group_info=TheoryGroup::select('id','name')->where('id',$data_theory_group->theory_group_id)->first();

                    array_push($arr_group,$data_theory_group_info);
                 } 
            }

             $data_theory =Theory::select('id','content','theory_group_id','name','created_at')->orderBy('id','desc')->get();

            $arr_theory_id=array();

             foreach ($data_theory as $db_theory) {

                $db_theory->checked=false;

                $check=ClassroomUnitTheory::where('class_room_unit_id',$id_unit)->where('theory_id',$db_theory->id)->first();

                if ($check) {
                    if ($check->theory_id == $db_theory->id) {

                        array_push($arr_theory_id, $check->theory_id);
                        
                        $db_theory->checked=true;
                    }
                }
                

             }


             // get exercise by theory
                $data_exercise=Exercise::whereIn('theory_id',$arr_theory_id)->orderBy('id','desc')->get();

                foreach ($data_exercise as $db_exercise) {
                    
                    $db_exercise->checked= false;

                    $check =ClassRoomUnitExercise::where('class_room_unit_id',$data_detail_unit->id)->where('exercise_id',$db_exercise->id)->first();

                    if ($check) {
                        if ($check->exercise_id == $db_exercise->id) {

                            $db_exercise->checked= true;
                        }
                    }
                // get answer exercise
                    $db_exercise->answer=Answer::where('exercises_id',$db_exercise->id)->get();

                    foreach ($db_exercise->answer as $db_answer) {

                        $db_answer->selected= false;

                        $check_answer=ClassRoomUnitExercise::select('answer_id')->where('class_room_unit_id',$data_detail_unit->id)->where('exercise_id',$db_exercise->id)->first();

                        if ($check_answer) {

                           if ($check_answer->answer_id == $db_answer->id) {
                            
                                $db_answer->selected= true;
                           }
                        }
                    }
               }
// dd($data_exercise);
               // dd( $data_exercise);


        return view('class_room_units.detail_unit',[
        		'flag_data' => $flag_data,
        		'data_detail_unit' => $data_detail_unit,
                'arr_group'  => $arr_group,
                'data_theory' => $data_theory,
                'data_exercise' => $data_exercise

	        ]);
        }else{
        	return view('class_room_units.detail_unit',[
        		'flag_data' => $flag_data
        	
	        ]);
        }
			
    }
    /**
     * check unit number update
     *
     * @return data check
     */
	public function validate_number_unit(Request $request,$id_class,$id){
		if ($request->ajax()) {
        		$id_unit_input=$request->unit_check;

        		$check_number_unit=ClassRoomUnit::check_add_number_unit($id_class,$id_unit_input,$id);

        		if ($check_number_unit >0) {
        			return response()->json([
    				'error'      => true,
    				'msg'		 =>"Unit này đã tồn tại !"
    				]);       
        		}else{
        			return response()->json([
    				'error'      => false
    				]);                 			
        		}
                		        						   
		  }

	}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        // return view('class_room_units.create_unit');
        $data = $request->all();

        $step = $request->get('step', 1);

        $class_room_id = $request->get('class_room_id', 0);
        $class_room_unit_id = $request->get('class_room_unit_id', 0);


        $groups = $request->get('groups', []);
        if (!empty($groups)) {
            $groups = explode(',', $groups);
        }

        $theory_groups = TheoryGroup::all();
        if ($theory_groups) {
            foreach ($theory_groups as $key => &$theory_group) {
                $theory_group->theories = Theory::where('theory_group_id', $theory_group->id)->get();
            }
        }

        $exercises = Exercise::whereIn('theory_id', function($query) use ($class_room_unit_id) {
            $query->select('theory_id')->from('class_room_unit_theories')->where('class_room_unit_id', $class_room_unit_id)->whereNull('deleted_at')->get();
        })->orderBy('created_at','desc')->get();

        foreach ($exercises as $key => &$exercise) {
            $exercises_id = $exercise->id;
            $exercise->languages = Language::whereIn('id', function($query) use ($exercises_id){
                $query->select('language_id')->from('answers')->where('exercises_id', $exercises_id)->get();
            })->get();
            $exercise->checked = ClassRoomUnitExercise::where('class_room_unit_id', $class_room_unit_id)->where('exercise_id', $exercises_id)->count();
        }

        return view('class_room_units.create', [
            'step' => $step,
            'class_room_id' => $class_room_id,
            'theory_groups' => $theory_groups,
            'groups' => $groups,
            'class_room_unit_id' => $class_room_unit_id,
            'exercises' => $exercises
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
        $datas = $request->all();

        foreach ($datas as $key => $data) {
            if (empty($data)) {
                unset($datas[$key]);
            }
        }


        $rules=[
            'class_room_id'                      => 'required',
            'unit'                => 'required',
            'unit_name'                   => 'required',
            'status'                    => 'required|numeric',
            'deadline'                    => 'required',
        
        ];
        $messages=[
            'class_room_id.required'  => 'Không tồn tại mã lớp',
            'unit.required'           => 'Vui lòng nhập số bài học',
            'unit.unique'             => 'Số bài học đã tồn tại',
            'unit_name.required'      => 'Vui lòng nhập tên bài học',
            'status.required'         => 'Bạn vui lòng chọn trạng thái',
            'status.numeric'          => 'Trạng thái không đúng định dạng',
            'deadline.required'       => 'Vui lòng chọn thời gian deadline',
            
        ];
        $validator=Validator::make($datas,$rules,$messages);
        
        if ($validator->fails()) {
            DB::commit();
            return response()->json([
                'error'      => true,
                'message'   =>$validator->errors()
            ],200);
        }
        else
        {
            try {

                $unit = ClassroomUnit::create($datas);
                    return response()->json([
                    'error'      => false,
                    'data'   => $unit
                ],200);


            } catch(Exception $e) {
                Log::info($e->getMessage());
                DB::rollback();
                return response()->json([
                    'error'      => true,
                    'message'   =>'Error server'
                ],500);
            }
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
        // return view('class_room_units.create_unit');
        $data = $request->all();

        $class_room_unit = ClassroomUnit::find($id);

        $step = $request->get('step', 1);

        $class_room_id = $request->get('class_room_id', 0);
        $class_room_unit_id = $request->get('class_room_unit_id', 0);


        $groups = $request->get('groups', []);
        if (!empty($groups)) {
            $groups = explode(',', $groups);
        }

        $theory_groups = TheoryGroup::all();
        if ($theory_groups) {
            foreach ($theory_groups as $key => &$theory_group) {
                $theory_group->theories = Theory::where('theory_group_id', $theory_group->id)->get();
            }
        }

        $exercises = Exercise::whereIn('theory_id', function($query) use ($class_room_unit_id) {
            $query->select('theory_id')->from('class_room_unit_theories')->where('class_room_unit_id', $class_room_unit_id)->whereNull('deleted_at')->get();
        })->orderBy('created_at','desc')->get();

        foreach ($exercises as $key => &$exercise) {
            $exercises_id = $exercise->id;
            $exercise->languages = Language::whereIn('id', function($query) use ($exercises_id){
                $query->select('language_id')->from('answers')->where('exercises_id', $exercises_id)->get();
            })->get();
            $exercise->checked = ClassRoomUnitExercise::where('class_room_unit_id', $class_room_unit_id)->where('exercise_id', $exercises_id)->count();
        }

        $theores_id = [];

        $thes = ClassroomUnitTheory::where('class_room_unit_id', $id)->select('theory_id')->get();
        if ($thes) {
            foreach ($thes as $key => $the) {
                $theores_id[] = $the->theory_id;
            }
        }

        $theories = Theory::whereIn('id', $thes)->get();

        if ($theories) {
            foreach ($theories as $key => &$theory) {
                $theory->checked = ClassroomUnitTheory::where('class_room_unit_id', $class_room_unit_id)->where('theory_id', $theory->id)->count();
            }
        }


        return view('class_room_units.edit', [
            'step' => $step,
            'class_room_id' => $class_room_id,
            'theory_groups' => $theory_groups,
            'groups' => $groups,
            'class_room_unit_id' => $class_room_unit_id,
            'exercises' => $exercises,
            'class_room_unit' => $class_room_unit,
            'theores_id' => $theores_id,
            'theories' => $theories
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
        $datas = $request->all();

        foreach ($datas as $key => $data) {
            if (empty($data)) {
                unset($datas[$key]);
            }
        }

        $rules=[
            'class_room_id'                      => 'required',
            'unit'                => 'required',
            'unit_name'                   => 'required',
            'status'                    => 'required|numeric',
            'deadline'                    => 'required',
        
        ];
        $messages=[
            'class_room_id.required'  => 'Không tồn tại mã lớp',
            'unit.required'           => 'Vui lòng nhập số bài học',
            'unit.unique'             => 'Số bài học đã tồn tại',
            'unit_name.required'      => 'Vui lòng nhập tên bài học',
            'status.required'         => 'Bạn vui lòng chọn trạng thái',
            'status.numeric'          => 'Trạng thái không đúng định dạng',
            'deadline.required'       => 'Vui lòng chọn thời gian deadline',
            
        ];
        $validator=Validator::make($datas,$rules,$messages);
        
        if ($validator->fails()) {
            DB::commit();
            return response()->json([
                'error'      => true,
                'message'   =>$validator->errors()
            ],200);
        }
        else
        {
            try {

                $unit = ClassroomUnit::where('id', $id)->first();
                $unit->update($datas);

                return response()->json([
                    'error'      => false,
                    'data'   => $unit
                ],200);


            } catch(Exception $e) {
                Log::info($e->getMessage());
                DB::rollback();
                return response()->json([
                    'error'      => true,
                    'message'   =>'Error server'
                ],500);
            }
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
            ClassroomUnitTheory::where('class_room_unit_id', $id)->delete();

            //delete exercise
            ClassRoomUnitExercise::where('class_room_unit_id', $id)->delete();

            Attendence::where('class_room_unit_id', $id)->delete();
            
            StudentHomeWork::where('class_room_unit_id', $id)->delete();

            ClassroomUnit::find($id)->delete();



            DB::commit();

            return response()->json([
                    'error' => false,
                    'message' => 'Delete success!'
                ], 200);

        } catch(Exception $e) {
            Log::info('Can not delete unit has id = ' . $id);
            DB::rollback();
            response()->json([
                    'error' => true,
                    'message' => 'Internal Server Error'
                ], 500);
        }
    }


    /**
     * get list theories
     * @param  Request $request 
     * @return view           
     */
    
    public function getListTheories (Request $request) {

        $datas = $request->get('theory_group_id');

        $class_room_unit_id = $request->get('class_room_unit_id', 0);

        if (empty($datas)) {
            $datas = [];
        } else {
            foreach ($datas as $key => &$data) {
                if (ctype_digit($data)) {
                    $data = (int) $data;
                }
            }
        }

        $theories = Theory::whereIn('id', $datas)->get();

        if ($theories) {
            foreach ($theories as $key => &$theory) {
                $theory->checked = ClassroomUnitTheory::where('class_room_unit_id', $class_room_unit_id)->where('theory_id', $theory->id)->count();
            }
        }

        
        
        $view     = view('class_room_units.data',[
            'theories' => $theories,
            'class_room_unit_id' => $class_room_unit_id
        ])->render();

        return $view;


    }
    
    /**
     * update class theory
     * @param  Request $request 
     * @return            
     */
    public function putUpdateTheory(Request $request) {
        $data = $request->all();
        if ($data['checked']) {
            ClassroomUnitTheory::where('class_room_unit_id', $data['class_room_unit_id'])->where('theory_id', $data['theory_id'])->delete();
            return response()->json([
                'error' => false,
                'message' => 'deleted'
            ], 200);

        } else {
            ClassroomUnitTheory::create($data);
            return response()->json([
                'error' => false,
                'message' => 'added'
            ], 200);
        }


    }  

    /**
     * update class theory
     * @param  Request $request 
     * @return            
     */
    public function putUpdateExercise(Request $request) {
        $data = $request->all();
        if ($data['checked']) {
            ClassRoomUnitExercise::where('class_room_unit_id', $data['class_room_unit_id'])->where('exercise_id', $data['exercise_id'])->delete();
            return response()->json([
                'error' => false,
                'message' => 'deleted'
            ], 200);

        } else {

            $data['answer_id'] =  empty($data['answer_id']) ? null : $data['answer_id'];

            ClassRoomUnitExercise::create($data);
            return response()->json([
                'error' => false,
                'message' => 'added'
            ], 200);
        }


    }  

    
}
