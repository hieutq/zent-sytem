<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;


class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->truncate();

        Permission::create([
            'name'=>'dashboard',
            'display_name'=>'Bảng điều khiển',
        ]);

        //course
        Permission::create([
            'name'=>'course-list',
            'display_name'=>'Xem danh sách khóa học',
        ]);
        Permission::create([
            'name'=>'course-create',
            'display_name'=>'Tạo mới khóa học',
        ]);
        Permission::create([
            'name'=>'course-view',
            'display_name'=>'Xem chi tiết khóa học',
        ]);
        Permission::create([
            'name'=>'course-edit',
            'display_name'=>'Sửa khóa học',
        ]);
        Permission::create([
            'name'=>'course-destroy',
            'display_name'=>'Xóa khóa học',
        ]);

        //classroom
        
        Permission::create([
            'name'=>'classroom-list',
            'display_name'=>'Xem danh sách lớp học',
        ]);
        Permission::create([
            'name'=>'classroom-create',
            'display_name'=>'Tạo mới lớp học',
        ]);
        Permission::create([
            'name'=>'classroom-view',
            'display_name'=>'Xem chi tiết lớp học',
        ]);
        Permission::create([
            'name'=>'classroom-edit',
            'display_name'=>'Sửa lớp học',
        ]);
        Permission::create([
            'name'=>'classroom-destroy',
            'display_name'=>'Xóa lớp học',
        ]);
        Permission::create([
            'name'=>'classroom-duplicate',
            'display_name'=>'Duplicate nội dung lớp học',
        ]);

        //classroom unit
        Permission::create([
            'name'=>'classroom-unit-list',
            'display_name'=>'Xem danh sách bài học',
        ]);
        Permission::create([
            'name'=>'classroom-unit-create',
            'display_name'=>'Tạo mới bài học',
        ]);
        // Permission::create([
        //     'name'=>'classroom-unit-view',
        //     'display_name'=>'Xem chi tiết lớp học',
        // ]);
        Permission::create([
            'name'=>'classroom-unit-edit',
            'display_name'=>'Sửa bài học',
        ]);
        Permission::create([
            'name'=>'classroom-unit-attendence',
            'display_name'=>'Điểm danh',
        ]);
        Permission::create([
            'name'=>'classroom-unit-view-list-exercise-applied',
            'display_name'=>'Danh sách nộp bài tập',
        ]);
        Permission::create([
            'name'=>'classroom-unit-destroy',
            'display_name'=>'Xóa bài học',
        ]);


        //care student
        Permission::create([
            'name'=>'care-student',
            'display_name'=>'Chăn sóc học viên',
        ]);
        //  Permission::create([
        //     'name'=>'care-student-email',
        //     'display_name'=>'Chăm sóc học viên bằng gửi mail',
        // ]);
        //   Permission::create([
        //     'name'=>'care-student-mobile',
        //     'display_name'=>'Chăm sóc học viên bằng gọi điện',
        // ]);
        //    Permission::create([
        //     'name'=>'care-student-sms',
        //     'display_name'=>'Chăm sóc học viên bằng gửi sms',
        // ]);
        
        Permission::create([
            'name'=>'courseware',
            'display_name'=>'Học liệu',
        ]);

        //tai khoan
        Permission::create([
            'name'=>'account-list',
            'display_name'=>'Xem danh sách tài khoản',
        ]);
        Permission::create([
            'name'=>'account-create',
            'display_name'=>'Thêm mới tài khoản',
        ]);
        Permission::create([
            'name'=>'account-view',
            'display_name'=>'Xem tài khoản',
        ]);
        Permission::create([
            'name'=>'account-edit',
            'display_name'=>'Cập nhật tài khoản',
        ]);
        Permission::create([
            'name'=>'account-destroy',
            'display_name'=>'Xóa tài khoản',
        ]);

        //role
        Permission::create([
            'name'=>'role-list',
            'display_name'=>'Vai trò',
        ]);
    }
}
