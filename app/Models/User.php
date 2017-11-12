<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable {

    use Notifiable, SoftDeletes, EntrustUserTrait {

        SoftDeletes::restore insteadof EntrustUserTrait;
        EntrustUserTrait::restore insteadof SoftDeletes;

    }

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
		'name', 'gender', 'birthday', 'mobile', 'email', 'password', 'facebook', 'skype', 'avatar', 'work_place', 'education_info', 'skill', 'position', 'note', 'desire', 'type', 'status',
	];


	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	*/

    protected $table="users";

	protected $hidden = [
		'password', 'remember_token',
	];

    /**
     * get roles
     * @return objects 
    */
	public function roles() {
		return $this->belongsToMany('App\Models\Role', 'role_users', 'user_id', 'role_id');
	}

    /**
     * get posts
     * @return objects 
    */
    public function posts () {
        return $this->hasMany('App\Models\Post','user_id');
    }
    /**
     * get user class
     * @return objects 
    */
     public function user_class()
    {
        return $this->hasMany('App\Models\UserClassRoom', 'user_id');
    }

    /**

     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

   //đếm sô eamil đăng ký
    public static function count_email($val_email){
    	$email_data= $data= DB::table('users')->select('email')->where('email',$val_email)->get()->count();
    	return $email_data;
    }
	
   //đếm sô sdt đăng ký
    public static function count_moblie($val_phone){
    	$moblie_data= $data= DB::table('users')->select('mobile')->where('mobile',$val_phone)->get()->count();
    	return $moblie_data;
    }
   //kiểm tra email user
    public static function get_email_user($id){
        $data_email= $data= DB::table('users')->select('email')->where('id',$id)->get();
        return $data_email;
    }
    /**
     * get class_rooms
     * @return objects 
    */
	public function class_rooms() {
		return $this->belongsToMany('App\Models\ClassRoom', 'user_class_rooms', 'user_id', 'class_room_id');
	}

	/**
     * get attendences
     * @return objects 
    */
    public function attendences() {
        return $this->hasMany('App\Models\Attendence', 'user_id');
    }
    /**
     *  search
     * @return search 
    */
    public static function search($keyword){
    if ($keyword == "") {
        return  User::orderBy('id', 'desc')->paginate(env('PAGES'));
    }
    $finder = User::where('name', 'LIKE', "%" . $keyword. "%")
            ->orWhere('mobile', 'LIKE', "%" . $keyword . "%")
            ->orWhere('email', 'LIKE', "%" . $keyword . "%")
            ->orderBy('id', 'desc')
            ->paginate(env('PAGES'));
    return $finder;
    }
    /**
     *  get list teacher
     * @return data 
    */
    public static function get_teacher(){
       $data_user= User::select('id','name','mobile','email')->where('type',2)->where('status',1)->orderBy('id', 'desc')->get();
       return $data_user;
    }
    /**
     *  get list tutor
     * @return data 
    */
    public static function get_tutor(){
       $data_tutor= User::select('id','name','mobile','email')->where('type',3)->where('status',1)->orderBy('id', 'desc')->get();
       return $data_tutor;
    }


    public function scopeType() {

        $name = 'No Name';
        $option = OptionValue::where('option_id', 2)->where('id', $this->type)->first();

        if ( $option ) {
            $name = $option->name;
        }
        return $name;
    }
}

