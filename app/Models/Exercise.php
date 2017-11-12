<?php

namespace App\Models;
use Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exercise extends Model
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
    protected $table="exercises";
    protected $fillable = [
        'name','theory_group_id', 'content','level_id', 'theory_id','id'
    ];

    public static $rules= [
            'name'                    => 'required',
            'theory_group_id'         => 'required',
            'level_id'                => 'required'  
    ];

    public static $messages = [
        'theory_group_id.required'  => 'Bạn vui lòng chọn nhóm bài tập',
        'level_id.required'         => 'Bạn vui lòng chọn độ khó',
        'name.required'             => 'Vui lòng nhập tiêu đề'
    ];


    public function level(){
    	 return $this->belongsTo("App\Models\Level");  
     }
    public function class_room_unit_exercises(){
    	 return $this->hasMany("ClassRoomUnitExercise","exercise_id");  
     }

    public function theory_group(){
    	return $this->belongsTo("App\Models\TheoryGroup");
    }

    public function theory(){
        return $this->belongsTo("App\Models\Theory");
    }

    //Create 
    public static function newExercise($request) {
        // dd($request);
        $exercise            = Exercise::create($request);
        return $exercise;
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
    //Search
    public static function search($keyword) {
        if ($keyword=="") {
            return Exercise::select('exercises.*','theory_groups.name as nameTheory','levels.name as nameLevel')
                ->leftjoin('levels', 'exercises.level_id', '=', 'levels.id')
                ->leftjoin('theory_groups', 'exercises.theory_group_id', '=', 'theory_groups.id')->orderBy('id','desc')->paginate(env('PAGES'));
        }else{
        $finder = Exercise::select('exercises.*','theory_groups.name as nameTheory','levels.name as nameLevel')
                ->leftjoin('levels', 'exercises.level_id', '=', 'levels.id')
                ->leftjoin('theory_groups', 'exercises.theory_group_id', '=', 'theory_groups.id')
                ->where('exercises.name', 'LIKE', "%".$keyword."%")
                ->orWhere('theory_groups.name', 'LIKE', "%".$keyword."%")
                ->orWhere('levels.name', 'LIKE', "%".$keyword."%")
                ->orWhere('content', 'LIKE', "%".$keyword."%")
                ->orderBy('exercises.id','desc')
                ->paginate(env('PAGES'));
        return $finder;
        }
    }

     //Update
      public static function store($request) {

        $data                       = Exercise::find($request->editID);
        $data->name                 = $request->name;
        $data->theory_group_id      = $request->theory_group_id;
        $data->content              = $request->content;
        $data->level_id             = $request->level_id;
        $data->save();

        return $data;
    }
    //End Update

    //Show
        public static function show($ID) {
        $data = Exercise::find($ID);
        return $data;
    }
    //End Show
}
