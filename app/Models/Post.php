<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
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
        'title', 'image', 'image_icon', 'video', 'description', 'content', 'slug', 'type', 'status', 'user_id'
    ];
    /**
     * get user
     * @return objects 
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    /**
     * get tags
     * @return objects 
     */
    public function tags () {
        return $this->belongsToMany('App\Models\Tag','post_tags','post_id', 'tag_id');
    }


    /**
     * get time convert
     * @return objects 
     */
    public function convertTime () {
        Date::setLocale('vi');
        return Date::parse($this->created_at)->diffForHumans();
    }
}
