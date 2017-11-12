<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Theory;
use App\Models\Exercise;
use App\Models\CoureseTheoryGroup;

class TheoryGroup extends Model
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
    protected $table="theory_groups";

    protected $fillable = ['name'];
    
    public function exersises(){
    	return $this->hasMany("Exersise","theory_group_id");
    }

    // public function theories(){

    // 	return $this->hasMany('Models\Theory');
    // }

    /**
     * search theory group
     * @param  string $keyword keyword
     * @return collection          
     */
    public static function search($keyword){
    if ($keyword == "") {
        return  TheoryGroup::orderBy('id', 'desc')->paginate(env('PAGES'));
    }
    $finder = TheoryGroup::where('name', 'LIKE', "%" . $keyword. "%")
            ->orderBy('id', 'desc')
            ->paginate(env('PAGES'));
    return $finder;
    }


    /**
     * create theorygroup
     * @return collection          
     */
     public static function create_theory_group($name){
        $theorygroup=new TheoryGroup;
        $theorygroup->name=$name;
        $theorygroup->save();
        return $theorygroup;
     }
    /**
     * get all theories
     * @param  integer $group_id 
     * @return collection           
     */
    public function listTheories($group_id) {
        return Theory::where('theory_group_id', $group_id)->get();
    }

    public function listExercises($group_id) {
        return Exercise::where('theory_group_id', $group_id)->get();
    }

    public function course_id_group_theory($theory_group_id) {

        return CoureseTheoryGroup::where('theory_group_id',$theory_group_id)->select('course_id')->get();

    }
}
