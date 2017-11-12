<?php

use Illuminate\Database\Seeder;
use App\Models\Option;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->truncate();

        Option::create([
        	'name' => 'Trạng thái điểm danh'
        ]);

        Option::create([
            'name' => 'Loại tài khoản'
        ]);

        Option::create([
            'name' => 'Trạng thái học viên của lớp'
        ]);
        
        Option::create([
            'name' => 'Trạng thái lớp học'
        ]);

    }
}
