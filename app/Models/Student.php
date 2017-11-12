<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use DB;
use Validator;

use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Authenticatable {

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
        'name', 'gender', 'birthday', 'mobile', 'email', 'password', 'facebook', 'skype', 'avatar', 'address', 'school', 'marketing_chanel', 'status'
    ];
    /**
     * validate form.
     *
     * @var array
     */
    public static $rules =[
            'name'      => 'required',
            'gender'    => 'required|numeric',
            'mobile'    => 'required|min:9|numeric',
            'password'  => 'required|min:6',
            'status'    => 'required|numeric',
            'birthday'  => 'required|date',
            'email'     => 'required|email',
        ];
    public static $messages=[
            'name.required'     => 'Bạn Vui long nhập họ tên',
            'gender.required'   => 'Bạn vui lọng chọn giới tính',
            'gender.numeric'    => 'Giới tính không đúng định dạng',
            'mobile.required'   => 'Bạn vui lòng nhập số điện thoại',
            'mobile.min'        => 'Số điện thoại tối thiểu 9 số',
            'mobile.numeric'    => 'Số điện thoại không đúng định dạng',
            'password.required' => 'Bạn vui lòng nhập mật khẩu',
            'password.min'      => 'Mật khẩu tối thiểu 6 ký tự',
            'status.required'   => 'Bạn vui lòng chọn trạng thái',
            'status.numeric'    => 'Trạng thái không đúng định dạng',
            'birthday.required' => 'Bạn vui lòng chọn ngày sinh',
            'birthday.date'     => 'Ngày sinh của bạn không đúng định dạng!',
            'email.email'       => 'Email chưa đúng định dạng. VD: xyz@gmail.com',
            'email.required'    => 'Bạn vui lòng nhập địa chỉ email'

        ];

    protected $table="students";

    /**
     * validate form.
     *
     * @var array
     */
    public static function Validate_rule($input, $rules, $messages) {
        $validator =Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return [
                'error' => true,
                'messages' => $validator->errors()
           ];
        }
        return [
            'error' => false,
            'messages' => 'successfully'
        ];
    }

    /**
     * get feedbacks
     * @return objects 
    */
	public function feedbacks() {
		return $this->hasMany('App\Models\Feedback', 'student_id');
	}

    /**
     * get student cares
     * @return objects 
    */
    public function student_cares() {
        return $this->hasMany('App\Models\StudentCare', 'student_id');
    }

    /**
     * get student_class_rooms
     * @return objects 
    */
    public function student_class_rooms() {
        return $this->hasMany('App\Models\StudentClassRoom', 'student_id');
    }

    /**
     * get student_home_works
     * @return objects 
    */
    public function student_home_works() {
        return $this->hasMany('App\Models\StudentHomeWork', 'student_id');
    }

    /**
     * get attendences
     * @return objects 
    */
    public function attendences() {
        return $this->hasMany('App\Models\Attendence', 'student_id');
    }

    /**
     *  search
     * @return search 
    */
    public static function search($keyword){
    if ($keyword == "") {
        return  Student::where('status','=',1)->orderBy('id', 'desc')->paginate(env('PAGES'));
    }
    $finder = Student::where('status','=',1)
            ->where('name', 'LIKE', "%" . $keyword. "%")
            ->orWhere('mobile', 'LIKE', "%" . $keyword . "%")
            ->orWhere('email', 'LIKE', "%" . $keyword . "%")
            ->orderBy('id', 'desc')
            ->paginate(env('PAGES'));
    return $finder;
    }  

     //đếm sô eamil đăng ký
    public static function count_email($val_email){
        $email_data= $data= DB::table('students')->select('email')->where('email',$val_email)->get()->count();
        return $email_data;
    }
    
   //đếm sô sdt đăng ký
    public static function count_moblie($val_phone){
        $moblie_data= $data= DB::table('students')->select('mobile')->where('mobile',$val_phone)->get()->count();
        return $moblie_data;
    }

    public static function search_add_student_class($keyword){
        if ($keyword=="") {
          $finder = Student::select('name','id','email')->offset(10)
                ->limit(5)
                ->get();
        }else{
            $finder = Student::where('name', 'LIKE', "%" . $keyword. "%")
                    ->orWhere('mobile', 'LIKE', "%" . $keyword . "%")
                    ->orWhere('email', 'LIKE', "%" . $keyword . "%")
                    ->orderBy('id', 'desc')
                    ->select('id','name')->get();
        }
    return $finder;
    } 


}
