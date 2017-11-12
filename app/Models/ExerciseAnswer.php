<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExerciseAnswer extends Model
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
        'exercise_id', 'answer_id', 
    ];


    public function exercise(){
        return $this->belongsTo("Exercise","exercise_id");
    }


    public function answer(){
        return $this->belongsTo("Answer","answer_id");
    }
}
