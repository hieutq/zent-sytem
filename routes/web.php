<?php
use App\Models\Exercise;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//-----------------Route news page -------------------------
Route::group(['prefix' => 'news'], function () {
    Route::get('post', ['as' => 'news.post', 'uses' => 'NewsController@getNews']);
    Route::get('post/{slug}', ['as' => 'news.detail', 'uses' => 'NewsController@getDetail']);
    Route::get('category/{slug}', ['as' => 'news.category', 'uses' => 'NewsController@getCategory']);
});

# Auth user

Route::auth();

# Auth student

Route::get('students/login', 'AuthStudent\LoginController@showLoginForm')->name('students/login');
Route::post('students/login', 'AuthStudent\LoginController@login');
Route::post('students/logout', 'AuthStudent\LoginController@logout')->name('students/logout');

// Registration Routes...
Route::get('students/register', 'AuthStudent\RegisterController@showRegistrationForm');
Route::post('register', 'AuthStudent\RegisterController@register');

// Password Reset Routes...
Route::get('students/password/reset', 'AuthStudent\ForgotPasswordController@showLinkRequestForm');
Route::post('students/password/email', 'AuthStudent\ForgotPasswordController@sendResetLinkEmail');
Route::get('students/password/reset/{token}', 'AuthStudent\ResetPasswordController@showResetForm');
Route::post('students/password/reset', 'AuthStudent\ResetPasswordController@reset');


Route::group(['middleware' => ['auth']], function () {

    Route::get('', 'HomeController@index');
    Route::get('dashboard', 'HomeController@index');

    

//-----------------User------------------------------------

    // load profile
    Route::get('users-profile', ['as' => 'user.profile', 'uses' => 'UserController@getProfile']);
    Route::get('get-profile', ['as' => 'user.get.profile', 'uses' => 'UserController@getAjaxProfile']);
    // update profile
    Route::put('user-update-profile', 'UserController@postUpdateProfile');
    // update Password profile
    Route::put('edit-password-profile', 'UserController@postPasswordProfile');
    // update avatar
    Route::put('edit-avatar-profile', 'UserController@postAvatarProfile');
    // load all user
    Route::get('users-list', ['as' => 'user.getUser', 'uses' => 'UserController@getUser']);
    // Thông tin chi tiết
    Route::get('user-info', 'UserController@getInfo');
    // load thông tin để sửa
    Route::get('user-update', 'UserController@getUpdate');
    // request thông tin sửa lên server
    Route::put('user-update', 'UserController@postUpdate');
    // checkEmail create
    Route::get('check-email', 'UserController@validate_email_request');
    // check Email Update
    Route::get('check-email-update', 'UserController@check_email_request_update');
    // check Phone
    Route::get('check-phone', 'UserController@validate_mobile_request');
    // check Email Update
    Route::get('check-mobile-update', 'UserController@check_phone_request_update');
    // thêm mới
    Route::post('user-create', 'UserController@createUser');
    // xóa
    Route::delete('user-delete', 'UserController@postDelete');
    // search
    Route::get('user/search', array('as' => 'user.search', 'uses' => 'UserController@search'));
//--------------------------UNIT-------------------------------
    // go to class
    Route::get('classroom/info/class-id/{id_class}',['as'=>'units.detail','uses'=>'ClassRoomUnit\ClassRoomUnitController@get_list_unit']);

    // detail unit

    Route::get('classroom/detail-unit/class-id/{id_class}/unit/{id}',['as'=>'units.detail.unit','uses'=>'ClassRoomUnit\ClassRoomUnitController@get_detail_unit']);

    // validate unit number
    Route::get('classroom/detail-unit/class-id/{id_class}/unit/{id}/validate-number-unit','ClassRoomUnit\ClassRoomUnitController@validate_number_unit'); 


        // Route::get('/detail-unit/class-id/{id_class}/unit/{id_unit}/check-unit','ClassRoomUnitController@validateUnit');

    Route::post('classroom-unit/get-list-theories','ClassRoomUnit\ClassRoomUnitController@getListTheories');

    Route::put('classroom-unit/update-theory','ClassRoomUnit\ClassRoomUnitController@putUpdateTheory');
    Route::put('classroom-unit/update-exercise','ClassRoomUnit\ClassRoomUnitController@putUpdateExercise');

    Route::resource('classroom-unit','ClassRoomUnit\ClassRoomUnitController');





// --------------------------CLASSROOM UNIT THEORY-------------------------------

    Route::resource('classroom-unit-theory','ClassRoomUnitTheory\ClassRoomUnitTheoryController');

// --------------------------CLASSROOM UNIT EXERCISE-------------------------------

    Route::resource('classroom-unit-exercise','ClassRoomUnitExercises\ClassRoomUnitExerciseController');


//--------------------Student Manager--------------------------
    Route::get('students', ['as' => 'student.listStudent', 'uses' => 'StudentController@index']);
    // create new student
    Route::post('students', ['as' => 'student.listStudent', 'uses' => 'StudentController@createStudent']);
    // show học viên theo id
    Route::get('student-edit', ['as' => 'student.edit', 'uses' => 'StudentController@showStudent']);
    //update student
    Route::put('student-edit', ['as' => 'student.edit', 'uses' => 'StudentController@updateStudent']);
    // delete student
    Route::delete('student-delete', ['as' => 'student.deleteStudent', 'uses' => 'StudentController@deleteStudent']);
    // search
    Route::get('student/search', array('as' => 'student.search', 'uses' => 'StudentController@search'));
    // check Phone
    Route::get('student/check-phone', 'StudentController@validate_mobile_request');
    // check Email Update
    Route::get('student/check-mobile-update', 'StudentController@check_phone_request_update');
    // checkEmail create
    Route::get('student/check-email', 'StudentController@validate_email_request');
    // check Email Update
    Route::get('student/check-email-update', 'StudentController@check_email_request_update');
    // check Phone

//---------StudentCare------------
    Route::get('student-cares', ['as' => 'studentCares', 'uses' => 'studentCareController@studentCares']);
    Route::post('student-care-edit/student_cares', ['as' => 'studentCares.create', 'uses' => 'studentCareController@createStudentCare']);
    //call page send mail
    Route::get('student-care-email/{id}', ['as' => 'studentCares-emai.get', 'uses' => 'studentCareController@showStudentEmail']);
    // call page call student
    Route::get('student-care-call/{id}', ['as' => 'studentCares-call.get', 'uses' => 'studentCareController@showStudentCall']);
    //create for a call
    Route::post('student-care-call/student_cares', ['as' => 'studentCares.call', 'uses' => 'studentCareController@createStudentCall']);
    Route::put('student-care-edit', ['as' => 'studentCares-edit.post', 'uses' => 'studentCareController@updateStudent']);
    Route::delete('student-care-del', ['as' => 'studentCares-delete', 'uses' => 'studentCareController@deleteStudentCare']);
    // search
    Route::get('student-care/search', array('as' => 'studentCares.search', 'uses' => 'studentCareController@search'));
    // filter student follow Class
    Route::get('student-care/filter', array('as' => 'studentCares.filter', 'uses' => 'studentCareController@FilterStudent'));


//---------StudentClassRoom------------
    Route::get('student-class-rooms', ['as' => 'StudentClassRooms', 'uses' => 'StudentClassRoomController@index']);
    Route::post('student-class-rooms', ['as' => 'StudentClassRooms', 'uses' => 'StudentClassRoomController@NewCreate']);
    Route::get('student-class-room-edit', ['as' => 'StudentClassRooms-edit', 'uses' => 'StudentClassRoomController@showStudent']);
    Route::put('student-class-room-edit', ['as' => 'StudentClassRooms-edit', 'uses' => 'StudentClassRoomController@updateStudent']);
    Route::delete('student-class-room-del', ['as' => 'StudentClassRooms-delete', 'uses' => 'StudentClassRoomController@delStudent']);
    // call add student class
    Route::post('load-units/{id_classRoom}/add-student-class',['as'=>'units.add.student','uses'=>'StudentClassRoomController@add_student_class']);
    // call delete student class
    Route::delete('load-units/{id_classRoom}/delete-sudent-class',['as'=>'units.delete.student','uses'=>'StudentClassRoomController@delete_student_class']); 
    // call search student class
    Route::get('load-units/{id_classroom}/search-student-class', ['as' => 'student.search-student-class','uses' =>'StudentClassRoomController@search_student_in_class']);
    //search
    Route::get('student-class-rooms/search', array('as' => 'studentCares.search', 'uses' => 'studentClassRoomController@search'));
//--------------------------------------Student-------------------------------------------------
    // call search student add class
    Route::get('load-units/{id_classroom}/search-student', ['as' => 'class-search-add-student','uses' =>'StudentController@search_student_add_class']);
//----------------FeedBacks----------------
    Route::get('feedbacks', ['as' => 'feedbacks', 'uses' => 'FeedbacksController@index']);
    Route::get('feedback-detail', ['as' => 'feedbacks-detail', 'uses' => 'FeedbacksController@getFeedback']);
    Route::delete('feedback-del', ['as' => 'feedbacks-delete', 'uses' => 'FeedbacksController@deleteFeedback']);
    Route::get('feedbacks/search', array('as' => 'feedbacks.search', 'uses' => 'FeedbacksController@search'));
//-----------------------------------------
    // Route::get('/', 'UserController@getUser');
    
    // Route::resource('users', 'UserController');
    
    Route::resource('users', 'User\UserController');
    

    Route::get('roles', ['as' => 'roles.index', 'uses' => 'RoleController@index', 'middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
    Route::get('roles/create', ['as' => 'roles.create', 'uses' => 'RoleController@create', 'middleware' => ['permission:role-create']]);
    Route::post('roles/create', ['as' => 'roles.store', 'uses' => 'RoleController@store', 'middleware' => ['permission:role-create']]);
    Route::get('roles/{id}', ['as' => 'roles.show', 'uses' => 'RoleController@show']);
    Route::get('roles/{id}/edit', ['as' => 'roles.edit', 'uses' => 'RoleController@edit', 'middleware' => ['permission:role-edit']]);
    Route::patch('roles/{id}', ['as' => 'roles.update', 'uses' => 'RoleController@update', 'middleware' => ['permission:role-edit']]);
    Route::delete('roles/{id}', ['as' => 'roles.destroy', 'uses' => 'RoleController@destroy', 'middleware' => ['permission:role-delete']]);

    //--------------------------------User class room------------------------------------
    Route::get('load-units/{id_classRoom}/search-user-add-class',['as'=>'user.class.search.add','uses'=>'UserClassRoomController@search_user_add_class']); 
    // call add manager class
    Route::post('load-units/{id_classRoom}/add-manager-class',['as'=>'units.add.manager','uses'=>'UserClassRoomController@add_manager_class']);
    //-----------CLassRoom-----------

    // Route::get('class-edit', ['as' => 'class.edit', 'uses' => 'ClassRoomController@showClass']);
    Route::post('classroom/duplicate/{id}', 'ClassRoom\ClassRoomController@postDuplicate');
    Route::resource('classroom', 'ClassRoom\ClassRoomController');
    
    Route::resource('coursewares/exercises', 'Exercise\ExerciseController');

    Route::get('coursewares/theory/{id}',['as' => 'theories.list', 'uses' => 'Theory\TheoryController@index']);

    Route::resource('coursewares/theories', 'Theory\TheoryController');

    Route::resource('coursewares/answers', 'Answer\AnswerController');

    Route::get('coursewares/get-theories/{id}', 'TheoryGroup\TheoryGroupController@getTheories');

    Route::resource('coursewares', 'TheoryGroup\TheoryGroupController');


    //Theories
    Route::get('theories',['as'=>'theories.listTheories','uses'=>'TheoriesController@index']);
    Route::get('theories/search', array('as' => 'theories.search', 'uses' => 'TheoriesController@search'));
    Route::post('theories', ['as' => 'theories.listTheories', 'uses' => 'TheoriesController@createTheory']);
    Route::get('theories-edit', ['as' => 'theories-edit', 'uses' => 'TheoriesController@showTheory']);
    Route::put('theories-edit', ['as' => 'theories-edit', 'uses' => 'TheoriesController@updateTheory']);
    Route::delete('theories-delete', ['as' => 'theories.delete', 'uses' => 'TheoriesController@deleteTheory']);

    //----------------Answer---------------
    Route::get('answer',['as'=>'answer.listAnswer','uses'=>'AnswerController@index']); 

    Route::post('answer', ['as' => 'answer.listAnswer', 'uses' => 'AnswerController@createAnswer']);    
    Route::get('answer-edit', ['as' => 'answer-edit', 'uses' => 'AnswerController@showAnswer']);
    Route::put('answer-edit', ['as' => 'answer-edit', 'uses' => 'AnswerController@updateAnswer']);
    Route::delete('answer-delete', ['as' => 'answer.delete', 'uses' => 'AnswerController@deleteAnswer']);
    Route::get('answer/search', array('as' => 'answer.search', 'uses' => 'AnswerController@search'));

    //--------Courses--------
    
    // Route::group(['prefix' => 'courses'], function() {
    //     Route::get('list',['as'=>'list.Courses','uses'=>'CourseController@getCourse']);
    //     Route::get('create','CourseController@getCreateCourse');
    //     Route::post('createCourse','CourseController@createCourse');
    //     Route::get('view/{id}','CourseController@viewCourse');
    //     Route::get('delete/{id}','CourseController@deleteCourse');
    //     Route::get('edit/{id}','CourseController@getEditCourse');
    //     Route::post('edit/{id}','CourseController@editCourse');
    //     Route::get('search', 'CourseController@search');
    // });

    Route::resource('courses', 'Course\CourseController');


    // Route::get('class', ['as' => 'class.listClass', 'uses' => 'ClassRoomController@index']);
    // Route::get('class-detail', ['as' => 'class.detail', 'uses' => 'ClassRoomController@showDetailClass']);
    // Route::post('class', ['as' => 'class.listClass', 'uses' => 'ClassRoomController@createClass']);
    // Route::delete('class-delete', ['as' => 'class.deleteClass', 'uses' => 'ClassRoomController@deleteClass']);
    
    // Route::put('class-edit', ['as' => 'class.edit', 'uses' => 'ClassRoomController@updateClass']);
    // Route::get('class/search', array('as' => 'class-search', 'uses' => 'ClassRoomController@search'));


//--------StudentHomeWork--------
    Route::get('home-work/{id_class}/{id}', ['as' => 'student.listStudentHomeWork', 'uses' => 'StudentHomeWorkController@getStudentHomeworks']);
    // Route::get('home-work', ['as' => 'student.listStudentHomeWork', 'uses' => 'StudentHomeWorkController@index']);
    Route::get('home-work-info', ['as' => 'student.details', 'uses' => 'StudentHomeWorkController@getInfo']);
    Route::put('home-work-edit', 'StudentHomeWorkController@updatePoint');
    Route::put('home-work-edit-point-plus', 'StudentHomeWorkController@createPoint_plus');
    Route::put('home-work-delete', 'StudentHomeWorkController@deleteRecord');
    Route::get('home-work-info-grade', ['as' => 'student.Grade', 'uses' => 'StudentHomeWorkController@getInfoGrade']);
    Route::put('home-work-grade', 'StudentHomeWorkController@ToGrade');

    

//--------Answers--------
    // Route::group(['prefix' => 'dapan'], function () {
    //     Route::get('danhsach', 'AnswersController@getAnswers');
    //     Route::get('themdapan', 'AnswersController@getCreateAnswers');
    //     Route::post('themdapan', 'AnswersController@postCreateAnswers');
    //     Route::get('xoa/{id}', 'AnswersController@deleteAnswers');
    //     Route::get('edit/{id}', 'AnswersController@getEditAnswers');
    //     Route::post('edit/{id}', 'AnswersController@postEditAnswers');
    // });



    

    Route::group(['prefix' => 'tintuc'], function () {

        Route::get('danhsach', 'PostsController@getPosts');
        Route::get('create', 'PostsController@getCreatePosts');
        Route::post('postCreate', 'PostsController@postCreatePosts');
        Route::get('view/{id}', 'PostsController@viewPosts');
        Route::get('xoa/{id}', 'PostsController@deletePosts');
        Route::get('edit/{id}', 'PostsController@getEditPosts');
        Route::post('edit/{id}', 'PostsController@postEditPosts');
    });



});

//--------------------  Attendances  --------------------------
    Route::get('attendances/{class_room_id}/{unit_id}', ['as' => 'attendances.list', 'uses' => 'AttendenceController@index']);

    Route::post('attendances', ['as' => 'attendances.create', 'uses' => 'AttendenceController@createAttendence']);


   

Auth::routes();

Route::get('/home', 'HomeController@index');



# students
Route::group(['prefix' => 'students'], function () {
    Route::get('dashboard', ['as' => 'students.dashboard', 'uses' => 'Student\HomeController@index']);

    Route::get('class-room/{id}', ['as' => 'students.list-unit', 'uses' => 'Student\HomeController@getListUnit']);

    Route::get('class-room/{class_id}/theories/{unit_id}', ['as' => 'students.list-theory', 'uses' => 'Student\HomeController@getListTheory']);

    Route::get('class-room/{class_id}/exercises/{unit_id}', ['as' => 'students.list-exercise', 'uses' => 'Student\HomeController@getListExercise']);

    Route::post('class-room/submit-exercise/exercises', ['as' => 'students.submit-store', 'uses' => 'Student\HomeController@store']);
});

