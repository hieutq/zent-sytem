<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class CoureseTheoryGroup extends Model
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
    protected $table ="course_theory_group";

    public $timestamps = false;

    protected $fillable = [
        'course_id', 'theory_group_id', 
    ];


    /**
     * GET ID COURESE
     * @return collection   
     */
   

}
