<?php

use Illuminate\Database\Seeder;
use App\Models\OptionValue;

class OptionValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('option_values')->truncate();

        //trang thai diem danh
        
        OptionValue::create([
        	'option_id' => 1,
        	'name' => 'Đi học đúng giờ'
        ]);
        OptionValue::create([
        	'option_id' => 1,
        	'name' => 'Đi học muộn'
        ]);
        OptionValue::create([
        	'option_id' => 1,
        	'name' => 'Nghỉ học có phép'
        ]);
        OptionValue::create([
        	'option_id' => 1,
        	'name' => 'Nghỉ học không phép'
        ]);

        //loai tai khoan
        OptionValue::create([
            'option_id' => 2,
            'name' => 'Supper Admin'
        ]);
        OptionValue::create([
            'option_id' => 2,
            'name' => 'Admin'
        ]);
        OptionValue::create([
            'option_id' => 2,
            'name' => 'Quản lý'
        ]);
        OptionValue::create([
            'option_id' => 2,
            'name' => 'Giáo viên'
        ]);
        OptionValue::create([
            'option_id' => 2,
            'name' => 'Trợ giảng'
        ]);

        //trang thai học vien cua lop
        OptionValue::create([
            'option_id' => 3,
            'name' => 'Đăng ký mới'
        ]);
        OptionValue::create([
            'option_id' => 3,
            'name' => 'Đang chăm sóc'
        ]);
        OptionValue::create([
            'option_id' => 3,
            'name' => 'Đã đóng học phí'
        ]);
        OptionValue::create([
            'option_id' => 3,
            'name' => 'Đã vào lớp'
        ]);
        OptionValue::create([
            'option_id' => 3,
            'name' => 'Kết thúc'
        ]);

        OptionValue::create([
            'option_id' => 3,
            'name' => 'Hủy giữa chừng'
        ]);

        //trang thai lop hoc
        
        OptionValue::create([
            'option_id' => 4,
            'name' => 'Chuẩn bị khai giảng'
        ]);
        OptionValue::create([
            'option_id' => 4,
            'name' => 'Đã khai giảng'
        ]);
        OptionValue::create([
            'option_id' => 4,
            'name' => 'Đã kết thúc'
        ]);
        OptionValue::create([
            'option_id' => 4,
            'name' => 'Đã quyết toán'
        ]);

    }
}
