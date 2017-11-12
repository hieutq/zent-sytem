<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
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
        'language_id', 'content', 'status', 'name', 'exercises_id','id'
    ];
    public static $rules= [
            'name'                    => 'required',
            'language_id'             => 'required',
            'exercises_id'            => 'required',
            'status'                  => 'required'
    ];

    public static $messages = [
        'name.required'                 => 'Vui lòng nhập tên bài giải',
        'language_id.required'          => 'Vui lòng chọn ngôn ngữ',
        'status.required'               => 'Vui lòng chọn trạng thái', 
        'exercises_id.required'         => 'Vui lòng chọn tên bài tập'  
    ];
        public function language(){
    	 return $this->belongsTo("App\Models\Language","language_id");  
     }
  	    public function class_room_unit_exercises(){
    	 return $this->hasMany("ClassRoomUnitExercise","answer_id");  
     }
        public function exercises(){
         return $this->belongsTo("App\Models\Exercise","exercises_id");  
     }

      //Create 
    public static function newAnswer($request) {
        $answer            = Answer::create($request);
        return $answer;
    }
    //End Create
    public static function validate_rules($input, $rules, $messages){
        
        $validator=Validator::make ($input, $rules, $messages);
        
        if ($validator->fails()) {
            return [
                'error'     => true,
                'messages'  => $validator->errors()
            ];
        } 
        return [
                'error'     => false,
                'messages'  => 'successfully'
            ];

    }
    //Update
      public static function store($request) {

        $data                       = Answer::find($request->editID);
        $data->name                 = $request->name;
        $data->language_id          = $request->language_id;
        $data->exercises_id         = $request->exercises_id;
        $data->status               = $request->status;
        $data->save();

        return $data;
    }
    // //End Update

    // //Show
        public static function show($ID) {
        $data = Answer::find($ID);
        return $data;
    }
    // //End Show

    //Search
    public static function search($keyword) {
        if ($keyword=="") {
            return Answer::select('answers.*','languages.name as nameLangues','exercises.name as nameExercises')
                ->leftjoin('languages', 'answers.language_id', '=', 'languages.id')
                ->leftjoin('exercises', 'answers.exercises_id', '=', 'exercises.id')->orderBy('id','desc')->paginate(env('PAGES'));
        }
        $finder = Answer::select('answers.*','languages.name as nameLangues','exercises.name as nameExercises')
                ->leftjoin('languages', 'answers.language_id', '=', 'languages.id')
                ->leftjoin('exercises', 'answers.exercises_id', '=', 'exercises.id')
                ->where('answers.name', 'LIKE', "%".$keyword."%")
                ->orWhere('languages.name', 'LIKE', "%".$keyword."%")
                ->orWhere('exercises.name', 'LIKE', "%".$keyword."%")
                ->orWhere('answers.status', 'LIKE', "%".$keyword."%")
                ->orWhere('answers.content', 'LIKE', "%".$keyword."%")    
                ->orderBy('answers.id','desc')
                ->paginate(env('PAGES'));
        return $finder;
    }


    public function getLanguage() {
        $name = 'No Name';
        $lang = Language::where('id', $this->language_id)->first();
        if ($lang) {
            $name = $lang->name;
        }
        return $name;
    } 
}
