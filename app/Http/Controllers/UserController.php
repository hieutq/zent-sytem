<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\Feedback;
use App\Models\Course;
use DB;
use Hash;
use Validator;
use Auth;

class UserController extends Controller
{
    // trang tru
    public function showIndex() {
        $sumStudent= Student::where('status','=',1)->count();
        $sumClassRoom = ClassRoom::where('status','<>',2)->count();
        $sumFeedback  = Feedback::count();
        $sumCourse    = Course::count();   
        return view('layouts.index',[
            'Student' => $sumStudent,
            'Feedback'=> $sumFeedback,
            'ClassRoom' => $sumClassRoom,
            'Course'    => $sumCourse
        ]);
    }
// validate

    public function Validate_request()
    {
        $rules = [
            'name' => 'required',
            'mobile' => 'required|min:9|numeric',
            'password' => 'required|min:5|max:100',
            'email' => 'required|email',
            'status' => 'numeric',
            'gender' => 'required|numeric',
            'type' => 'numeric',
        ];
        $messages = [
            'name.required' => 'Tên của bạn không được để trống',
            'mobile.required' => 'Bạn vui lòng nhập số điện thoại',
            'mobile.min' => 'Số điện thoại của bạn ít nhất 9 ký tự',
            'mobile.numeric' => 'Số điện thoại của bạn phải là kiểu số (vd :0946760298)',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu có độ dài ít nhất 5 ký tự',
            'password.max' => 'Mật khẩu có độ dài dài nhất 100 ký tự',
            'email.required' => 'Email của bạn không được để trống',
            'email.email' => 'Email của bạn không đúng định dạng (vd: abc@gmail.com)',
            'gender.numeric' => 'Giới tính không đúng',
            'gender.required' => 'Giới tính không được để trống',
        ];
        return $rules;
        return $messages;
    }

    //load profile
    public function getProfile()
    {
        $idUser = Auth::User()->id;
        $profile_user = User::find($idUser);
        return view('users.profile_user', compact('profile_user'));
    }

    public function getAjaxProfile()
    {
        $idUser = Auth::User()->id;
        $profile_user = User::find($idUser);
        return response($profile_user);
    }

    //load User
    public function getUser()
    {
        $idUser = Auth::User()->id;
        $users = User::paginate(env('PAGES'));
        $roles = Role::orderby('id','desc')->get();
        $total = User::count();
        $flag = ($total > env('PAGES')) ? true : false;
        return view('users.listUser')
            ->with(array(
                'users' => $users,
                'idUser' => $idUser,
                'roles' => $roles,
                'flag' => $flag
            ));
    }

    //get infor
    public function getInfo(Request $request)
    {
        try {
            if ($request->ajax()) {
                $id_request = $request->id;
                $info_user = User::find($id_request);
                $info_roles_user = RoleUser::getRolesUser($id_request);
                $data = [
                    'info_user' => $info_user,
                    'info_roles_user' => $info_roles_user
                ];
                return response($data);
            }
        } catch (Exception $e) {
            $info_error = ['msg' => 'Lấy thông tin không thành công!!!!'];
            return response($info_error);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function getUpdate(Request $request)
    {
        try {
            if ($request->ajax()) {
                $get_user_update = User::find($request->id);
                $roles_user_info = RoleUser::getRolesUser($request->id);
                $data = [
                    'get_user_update' => $get_user_update,
                    'roles_user_info' => $roles_user_info
                ];
                return response($data);
                return view('layouts.listUser', compact('user'));
            }
        } catch (Exception $e) {
            return response($data);
        }
    }


    /**
     * @param $dataInput
     * @return mixed
     */
    public function format_data($dataInput)
    {
        foreach ($dataInput as &$data) {
            if ($data == '') {
                $data = null;
            }
        }
        return $dataInput;
    }

//Post Update
    public function postUpdate(Request $request)
    {
        try {
            if ($request->ajax()) {
                $rules = [
                    'editName' => 'required',
                    'editGender' => 'required',
                    'editEmail' => 'required|email',
                    'editMobile' => 'numeric|min:9',
                    // 'date'         => 'date',
                    'editStatus' => 'required|numeric',
                    'editType' => 'required|numeric',
                ];
                $messages = [
                    'editName.required' => 'Tên của bạn không được để trống',
                    'editGender.required' => 'Giới tính của bạn phải được chọn',
                    'editEmail.required' => 'Email của bạn không được để trống',
                    'editEmail.email' => 'Email của bạn không đúng định dạng (vd: abc@gmail.com)',
                    'editMobile.min' => 'Số điện thoại của bạn ít nhất 9 ký tự',
                    'editMobile.numeric' => 'Số điện thoại không đúng định dạng (vd: 0946760298)',
                    // 'date.date'             =>'Ngày sinh của bạn không đúng định dạng',
                    'editStatus.numeric' => 'Trạng thái không đúng định dạng',
                    'editType.numeric' => 'Loại User không đúng định dạng',
                ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    return response()->json([
                        'error' => true,
                        'message' => $validator->errors()
                    ], 200);
                } else {
                    $dataInput = $request->all();
                    $data = $this->format_data($dataInput);
                    // dd($dataInput);
                    $user = User::find($data['editID']);
                    $user->name = $data['editName'];
                    $user->status = $data['editStatus'];
                    $user->type = $data['editType'];
                    $user->gender = $data['editGender'];
                    $user->email = $data['editEmail'];
                    $user->birthday = $data['date'];
                    $user->mobile = $data['editMobile'];
                    $user->facebook = $data['editFacebook'];
                    $user->skype = $data['editSkype'];
                    $user->work_place = $data['editWorkFace'];
                    $user->address = $data['editAddress'];
                    $user->skill = $data['editSkill'];
                    $user->position = $data['editPosition'];
                    $user->education_info = $data['editEducation'];
                    RoleUser::where('user_id', $data['editID'])->delete();
                    if (!empty($data['editRole'])) {
                        foreach ($data['editRole'] as $role) {
                            $user->roles()->attach($role);
                        }
                    }
                    $user->save();
                    $data_update = ['user' => $user, 'role_update' => $data['editRole']];
                    return response()->json($data_update);
                }
                // return response($user);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ], 200);
        }
    }

//---------------------------Validate Email-------------------------------------

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validate_email_request(Request $request)
    {
        if ($request->ajax()) {
            $val_email = $request->value;
            $total = User::count_email($val_email);
            return response()->json($total);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function check_email_request_update(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $data_check_email = User::where('id', '<>', $id)->where('email', $request->value)->count();
            return response($data_check_email);
        }
    }

//-------------------------Validate Mobile Request-------------------------------------
    public function validate_mobile_request(Request $request)
    {
        if ($request->ajax()) {
            $val_phone = $request->value;
            $total = User::count_moblie($val_phone);
            return response()->json($total);
        }
    }

    public function check_phone_request_update(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $data_check_mobile = User::where('id', '<>', $id)->where('mobile', $request->value)->count();
            return response($data_check_mobile);
        }
    }

    //Create New
    public function createUser(Request $request)
    {
        try {
            if ($request->ajax()) {
                $rules = [
                    'name' => 'required',
                    'mobile' => 'required|min:9|numeric',
                    'password' => 'required|min:5|max:100',
                    'email' => 'required|email',
                    'status' => 'numeric',
                    'gender' => 'required|numeric',
                    'type' => 'numeric',
                ];
                $messages = [
                    'name.required' => 'Tên của bạn không được để trống',
                    'mobile.required' => 'Bạn vui lòng nhập số điện thoại',
                    'mobile.min' => 'Số điện thoại của bạn ít nhất 9 ký tự',
                    'mobile.numeric' => 'Số điện thoại của bạn phải là kiểu số (vd :0946760298)',
                    'password.required' => 'Mật khẩu không được để trống',
                    'password.min' => 'Mật khẩu có độ dài ít nhất 5 ký tự',
                    'password.max' => 'Mật khẩu có độ dài dài nhất 100 ký tự',
                    'email.required' => 'Email của bạn không được để trống',
                    'email.email' => 'Email của bạn không đúng định dạng (vd: abc@gmail.com)',
                    'gender.numeric' => 'Giới tính không đúng',
                    'gender.required' => 'Giới tính không được để trống',
                ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    return response()->json([
                        'error' => true,
                        'message' => $validator->errors()
                    ], 200);
                } else {
                    $dataInput = $request->all();
                    $data = $this->format_data($dataInput);
                    $data['password'] = bcrypt($data['password']);
                    $roles_user = $data['roles'];
                    $user = User::create($data);
                    if (!empty($data['roles'])) {
                        foreach ($data['roles'] as $role) {
                            $user->roles()->attach($role);
                        }
                    }
                    $data_create = ['user' => $user, 'roles_user' => $roles_user];
                    return response($data_create);
                }
            }
        } catch (Exception $e) {
            return response($user);
        }
    }

    //Delete User
    public function postDelete(Request $request)
    {
        if ($request->ajax()) {
            // $idUser=Auth::User()->id;
            User::destroy($request->id);
            return response()->json(['sms' => 'Xoa thanh cong!']);
        }
    }

    // Edit Profile
    public function postUpdateProfile(Request $request)
    {
        if ($request->ajax()) {
            $rules = [
                'name' => 'required',
                'mobile' => 'required|min:9|numeric',
                'email' => 'required|email',
                'gender' => 'required|numeric',
            ];
            $messages = [
                'name.required' => 'Tên của bạn không được để trống',
                'mobile.required' => 'Bạn vui lòng nhập số điện thoại',
                'mobile.min' => 'Số điện thoại của bạn ít nhất 9 ký tự',
                'mobile.numeric' => 'Số điện thoại của bạn phải là kiểu số (vd :0946760298)',
                'email.required' => 'Email của bạn không được để trống',
                'email.email' => 'Email của bạn không đúng định dạng (vd: abc@gmail.com)',
                'gender.numeric' => 'Giới tính không đúng',
                'gender.required' => 'Giới tính không được để trống',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors()
                ], 200);
            } else {
                try {
                    $dataInput = $request->all();
                    $data = $this->format_data($dataInput);

                    $idUser = Auth::User()->id;
                    $user = User::find($idUser);
                    $user->update($data);
                    return response()->json($user);
                } catch (Exception $e) {
                    $error = ['msg' => 'Lỗi ! sửa không thành công !'];
                    return response($error);
                }
            };
        }
    }

    // Edit Password Profile
    public function postPasswordProfile(Request $request)
    {
        if ($request->ajax()) {
            $rules = [
                'new_password' => 'required|min:6|max:100',
                're_new_password' => 'required|same:new_password',
            ];
            $messages = [
                'new_password.required' => 'Mật khẩu không được để trống',
                'new_password.min' => 'Mật khẩu ít nhất 6 ký tự',
                'new_password.max' => 'Mật khẩu của bạn dài nhất là 100 ký tự',
                're_new_password.required' => 'Bạn chưa nhập lại mật khẩu',
                're_new_password.same' => 'Nhập lại mật khẩu không đúng',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors()
                ], 200);
            } else {
                try {
                    $dataEdit = $request->all();
                    $new_password = bcrypt($request->new_password);
                    $idUser = Auth::User()->id;
                    $user = User::find($idUser);
                    $user->password = $new_password;
                    $user->save();
                    return response()->json($user);
                } catch (Exception $e) {
                    $error = ['msg' => 'Lỗi ! sửa không thành công !'];
                    return response($error);
                }
            };
        }
    }

    // Get Avatar Profile
    public function postAvatarProfile(Request $request)
    {
        if ($request->ajax()) {
            // $rules=[
            // 'avatar'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=225,min_height=225',
            // ];
            // $messages=[
            // 'avatar.required'         =>'Bạn chưa chọn ảnh',
            // 'avatar.image'              =>'File bạn chọn phải là ảnh',
            // 'avatar.max'              =>'Kích thước File lớn nhất là 2048kb',
            // 'avatar.min_width'      =>'Chiều rộng nhỏ nhất ảnh phải là 225px',
            // 'avatar.min_height'          =>'Chiều cao nhỏ nhất ảnh phải là 225px',
            // ];
            // $validator=Validator::make($request->all(),$rules,$messages);
            // if ($validator->fails()) {
            //   return response()->json([
            //   'error' =>true,
            //   'message' => $validator->errors()
            //   ],500);
            // }else{
            try {
                $idUser = Auth::User()->id;
                dd($request->all());
                $user = User::find($idUser);
                if ($request->hasFile('avatar')) {
                    $file = $request->file('avatar');
                    // dd($file);
                    $name = $file->getClientOriginalName();
                    $image = str_random(4) . "_" . $name;
                    while (file_exists("upload/avatar/" . $image)) {
                        $image = str_random(4) . "_" . $name;
                    }
                    $file->move("upload/avatar", $image);
                    $user->avatar = $image;
                } else {
                    $request->avatar = "";
                }

                $user->save();

                return response($user->avatar);
            } catch (Exception $e) {
                return response($user->avatar);
            }
            // }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('users.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('display_name', 'id')->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }
        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::lists('display_name', 'id');
        $userRole = $user->roles->lists('id', 'id')->toArray();
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('role_user')->where('user_id', $id)->delete();
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    // ================Search=============
    public function search(Request $request) {
        $keyword = $request->input('keyword');
        $user = User::search($keyword);
        $flag    = User::count() > env('PAGES') ? true : false;
        $view    = view('users.data',[
            'users' => $user,
            'flag'    => $flag  
        ])->render();
        return $view;
    }
}