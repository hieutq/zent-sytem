<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use Log;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('id','DESC')->paginate(env('PAGES'));
       
        $flag    = Course::count() > env('PAGES') ? true : false;

        return view('course.listCourse',[
            'courses' => $courses,
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
        return view('course.createCourse');
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

        //update data
        $datas['code'] = str_slug($datas['name']);

        
        DB::beginTransaction();

        try {

            $this->validate($request,[
                    'name'                      => 'required|max:255',
                    'short_name'                => 'required|max:255',               
                    'capacity'                  => 'required',           
                    'status'                    => 'required',      
                    'orientation_time'          => 'required' 
                ],[
                    'name.required'                     => 'Bạn vui lòng nhập tên khóa học',
                    'name.max'                          => 'Tên khóa học không được quá 255 ký tự',
                    'short_name.required'               => 'Bạn vui lòng nhập tên viết tắt khóa học',
                    'short_name.max'                    => 'Tên viết tắt khóa học không được quá 255 ký tự',
                    'capacity.required'                 => 'Bạn vui lòng nhập số lượng học viên',
                    'status.required'                   => 'Bạn vui lòng chọn trạng thái',
                    'orientation_time.required'         => 'Bạn vui lòng chọn thời gian khai giảng'           
                ]);

                // validation successful ---------------------------

                $course = Course::store($datas);

                DB::commit();

                return Redirect(route('courses.index'));

        } catch(Exception $e) {
            Log::info('Can not create course');
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
        $Course = Course::find($id);
        return view('course.viewCourse', ['Course' => $Course]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Course = Course::find($id);
      return view('course.editCourse',['Course' => $Course]);
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

        DB::beginTransaction();
        try {
            
            $this->validate($request,[
                    'name'                      => 'required|max:255',
                    'short_name'                => 'required|max:255',               
                    'capacity'                  => 'required',           
                    'status'                    => 'required',      
                    'orientation_time'          => 'required' 
                ],[
                    'name.required'                     => 'Bạn vui lòng nhập tên khóa học',
                    'name.max'                          => 'Tên khóa học không được quá 255 ký tự',
                    'short_name.required'               => 'Bạn vui lòng nhập tên viết tắt khóa học',
                    'short_name.max'                    => 'Tên viết tắt khóa học không được quá 255 ký tự',
                    'capacity.required'                 => 'Bạn vui lòng nhập số lượng học viên',
                    'status.required'                   => 'Bạn vui lòng chọn trạng thái',
                    'orientation_time.required'         => 'Bạn vui lòng chọn thời gian khai giảng'           
                ]);

                // validation successful ---------------------------

                 $course = Course::where('id',$id)->first();

                 $course->name                 = $request->name;
                 $course->short_name           = $request->short_name;
                 $course->slogan               = $request->slogan;
                 $course->code                 = str_slug($request->name);
                 $course->capacity             = $request->capacity;
                 $course->class_info           = $request->class_info;
                 $course->student_object       = $request->student_object;
                 $course->content              = $request->content;
                 $course->orientation_time     = $request->orientation_time;
                 $course->status               = $request->status;
                 $course->time_table           = $request->time_table;
                 $course->class_desire_detail  = $request->class_desire_detail;
                 $course->tuition              = $request->tuition;
                 $course->register_info        = $request->register_info;
                 $course->class_fb_group       = $request->class_fb_group;
                 
                 $course->save();

                 $datas['code'] = str_slug($datas['name']);;

                 unset($datas['_token']);
                 unset($datas['_method']);

                 Course::where('id', $id)->update($datas);

                 DB::commit();   

                 return Redirect(route('courses.index'));   

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

            Course::find($id)->delete();
            DB::commit();

            return response()->json([
                    'error' => false,
                    'message' => 'Delete success!'
                ], 200);

        } catch(Exception $e) {
            Log::info('Can not delete course has id = ' . $id);
            DB::rollback();
            response()->json([
                    'error' => true,
                    'message' => 'Internal Server Error'
                ], 500);
        }
    }
}
