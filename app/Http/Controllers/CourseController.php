<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use DB;


class CourseController extends Controller
{
    /**
     * Load data to view.
     *
     *
     */
    public function getCourse()
    {    
       $courses = Course::orderBy('id','DESC')->paginate(env('PAGES'));
       
       $flag    = Course::count() > env('PAGES') ? true : false;
       return view('course.listCourse',['courses' => $courses,'flag' => $flag]);
    }

    public function getCreateCourse(){
        $courses = Course::orderBy('id','DESC')->get();
        return view('course.createCourse',['courses' => $courses]);
    }
   
    public function createCourse(Request $request)
    {   

        $data = $request->all();
        $Course = Course::create($data);

        return Redirect(url('courses/list'));
    }

    public function viewCourse($id){
      $Course = Course::find($id);
      return view('course.viewCourse',['Course' => $Course]);
    }

    public function deleteCourse($id){
      $Course = Course::find($id);
      $Course->delete();
      return Redirect(url('courses/list'));
    }

    public function getEditCourse($id){
      $Course = Course::find($id);
      return view('course.editCourse',['Course' => $Course]);
    }
    public function editCourse(Request $request,$id)
    {
         $Course = Course::find($id);
         $Course->name                 = $request->name;
         $Course->short_name           = $request->short_name;
         $Course->slogan               = $request->slogan;
         $Course->code                 = $request->code;
         $Course->class_img            = $request->class_img;
         $Course->capacity             = $request->capacity;
         $Course->class_info           = $request->class_info;
         $Course->student_object       = $request->student_object;
         $Course->content              = $request->content;
         $Course->orientation_time     = $request->orientation_time;
         $Course->status               = $request->status;
         $Course->time_table           = $request->time_table;
         $Course->class_desire_detail  = $request->class_desire_detail;
         $Course->tuition              = $request->tuition;
         $Course->header_bg_img        = $request->header_bg_img;
         $Course->register_bg_img      = $request->register_bg_img;
         $Course->footer_bg_img        = $request->footer_bg_img;
         $Course->register_info        = $request->register_info;
         $Course->class_fb_group       = $request->class_fb_group;

        $Course->save();
        return Redirect(url('courses/list'));
    }

    public function search(Request $request) {
        $keyword = $request->input('keyword');
        $courses = Course::search($keyword);
        $view    = view('course.data',[
            'courses' => $courses,
        ])->render();
        return $view;
    }

}
