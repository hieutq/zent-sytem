<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Feedback;
use App\Models\Student;
use DB;
class FeedbacksController extends Controller
{
    public function index() {
    	$data= Feedback::feedbacks();
        $flag = Feedback::count() > env('PAGES') ? true : false;
    	$student=Student::all();
    	return view('student.feedback',[
            'flag'      => $flag,
    		'feedbacks' => $data,
    		'student'	=>$student
    	]);
    }

    public function search(Request $request) {
        $keyword = $request->input('keyword');
        $datas   = Feedback::search($keyword);
        $flag    = Feedback::count() > env('PAGES') ? true : false;
        $view    = view('student.dataFeedback',[
            'feedbacks' => $datas,
            'flag'      => $flag
        ])->render();
        return $view;

    }

    public function deleteFeedback(Request $request){
    	if ($request->ajax()) {

    		DB::beginTransaction();

    		try {

    			Feedback::destroy($request->id);
                $datas = Feedback::orderBy('id','desc')->paginate(env('PAGES'));
                $flag    = Feedback::count() > env('PAGES') ? true : false;
                $view    = view('student.dataFeedback',[
                    'feedbacks' => $datas,
                    'flag'      => $flag
                ])->render();
    			DB::commit();

    			return response()->json(['sms'=>'delete successfully']);

    		} catch (Exception $e) {
    			
    			Log::info('can not delete studentcare');

        	DB::rollback();

    		}
    	}
    }

        public function getFeedback(Request $request) {
        	DB::beginTransaction();
        	try {
        		$data = Feedback::find($request->id);
        		DB::commit();
        		return response($data);
        	} catch (Exception $e) {
        		Log::info('can not get Feedback');

            	DB::rollback();
        	}
        }
}
