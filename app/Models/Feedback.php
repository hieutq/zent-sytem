<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
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
    
    protected $table = 'feedbacks';
    
    protected $fillable = [
        'student_id', 'comment', 
    ];

    /**
     * get student
     * @return objects 
    */
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    /**
     * get databas
     * @return objects 
    */
    public static function feedbacks()
    {
        $feedback = Feedback::orderby('id','DESC')->paginate(env('PAGES'));
        return $feedback;
    }

     public static function getFeedback($request) {
        $data = Feedback::find($request->id);
        return $data;
     }

    /**
     * get databas
     * @return objects 
    */
    public static function search($keyword) {
        if ($keyword=="") {
            return Feedback::orderBy('id','desc')->paginate(env('PAGES'));
        }
        $finder = Feedback::select('feedbacks.*','students.name')
                ->leftjoin('students', 'feedbacks.student_id', '=', 'students.id')
                ->where('students.name','LIKE','%'.$keyword.'%')
                ->orWhere('comment','LIKE','%'.$keyword.'%')
                ->orderBy('feedbacks.id','desc')
                ->paginate(env('PAGES'));
        return $finder;
    } 
}
