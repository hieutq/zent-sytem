<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'short_name', 'slogan', 'code', 'capacity', 'class_info', 'student_object', 'content', 'orientation_time', 'time_table', 'branch_id', 'class_desire_detail', 'tuition', 'status', 'register_info', 'class_fb_group'
    ];



    public function classRoom() {
        return $this->hasMany('App\Models\ClassRoom', 'course_id');
    }

    /**
     * get StudentClassRoom
     *
     * @var object
     */
    public function StudentClassRoom(){
    	return $this->hasMany('App\Models\StudentClassRoom', 'course_id');   
         }

    public static function getListCourse(){
        $data_course=Course::orderby('id','DESC')->select('id','name','short_name')->get();
        return $data_course;
    }

    /**
     *  search
     * @return search 
    */
    public static function search($keyword){
    if ($keyword == "") {
        return  Course::orderBy('id', 'desc')->paginate(5);
    }
    $finder = Course::where('short_name', 'LIKE', "%" . $keyword. "%")
            ->orWhere('tuition', 'LIKE', "%" . $keyword . "%")
            ->orderBy('id', 'desc')
            ->paginate(5);
    return $finder;
    } 

    /**
     * convert price
     * @param  [type] $priceFloat [description]
     * @return [type]             [description]
     */
    function formatPrice($priceFloat) {
        $symbol = 'đ';
        $symbol_thousand = '.';
        $decimal_place = 0;
        $price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
        return $price.$symbol;
    }

    /**
     * create course
     * @param  array $data array
     * @return collection       [description]
     */
    public static function store($data) {

        return Course::create($data);

    }

     /* get name courese
     * @param  integer $courese_id 
     * @return collection           
     */
    public function courese_info($courses_id) {
        return Course::where('id', $courses_id)->select('short_name')->get();
    }
}
