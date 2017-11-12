<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Models\Exercise;

class Theory extends Model
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
    protected $table="theories";

    // protected $appends = ['exercises'];

    protected $fillable = [
        'id','name','theory_group_id', 'content' , 'theory_id'
    ];

    public static $rules= [
            'name'                    => 'required',
            'theory_group_id'         => 'required',
            'theory_id'         => 'required',
    ];

    public static $messages = [
        'name.required'                => 'Vui lòng nhập tên lý thuyết',
        'theory_group_id.required'     => 'Vui lòng chọn nhóm lý thuyết',
        'theory_id.required'     => 'Vui lòng chọn lý thuyết',
    ];

    public function TheoryGroup(){
    	return $this->belongsTo("App\Models\TheoryGroup","theory_group_id");
    }

    public function Course(){
        return $this->belongsTo("App\Models\Course","course_id");
    }

    public function ClassRoomUnitTheory(){
        return $this->belongsTo("ClassRoomUnitTheory","theory_id");
    }

    /**
     * load tất cả lý thuyết khi chọn selectbox
     *
     * @var array
     */
    public static function getTheoryManySelect($last_data_id){
        $data=Theory::whereIn('theory_group_id',$last_data_id)->get();
        return $data;
    }

    public static function countTheoryManySelect($last_data_id){
        $data=Theory::whereIn('theory_group_id',$last_data_id)->get()->count();
        return $data;
    }

    public static function getTheoryOneSelect($id){
        $data=Theory::where('theory_group_id',$id)->get();
        return $data;
    }

    /**
     * tìm kiếm lý thuyết
     *
     * @var data
     */    
    public static function search($keyword) {
        if ($keyword=="") {
            return Theory::orderBy('id','desc')->paginate(env('PAGES'));
        }
        $finder = Theory::select('theories.*','t.name')
                ->leftjoin('theory_groups as t', 'theories.theory_group_id', '=', 't.id')
                ->where('theories.name', 'LIKE', "%".$keyword."%")
                ->orWhere('t.name', 'LIKE', "%".$keyword."%")
                ->orWhere('theories.content', 'LIKE', "%".$keyword."%")
                ->orderBy('theories.id','desc')
                ->paginate(env('PAGES'));
        return $finder;
    }

    //Create 
    public static function newTheory($request) {
        // dd($request);
        $theory            = Theory::create($request);
        return $theory;
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

        $data                       = Theory::find($request->editID);
        $data->name                 = $request->name;
        $data->theory_group_id      = $request->theory_group_id;
        $data->content              = $request->content;
        $data->save();

        return $data;
    }
    //End Update

    //Show
        public static function show($ID) {
        $data = Theory::find($ID);
        return $data;
    }
    //End Show
    
    
    /**
     * get list excercise
     * @return [type] [description]
     */
    public function listExercises($id) {
        return Exercise::where('theory_id', $id)->get();
    }
}


