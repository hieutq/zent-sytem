<?php

use Illuminate\Database\Seeder;

class StudentHomeWorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student_home_works')->insert([
        	array('class_room_unit_id'=>1,'student_id'=>1,'content'=>'abc','time_submit'=>date("Y-m-d H:i:s"),'comment'=>str_random(10),'point'=>10,'point_plus'=>10,'status'=>1,'status_submit'=>1,'created_at'=>date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s"))
        	]);
    }
}
