<?php

use Illuminate\Database\Seeder;
use App\Models\Student;
class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create(
        	array('name'=>'Tạ Quang Trung','gender'=>1,'birthday'=>date("Y-m-d H:i:s"),'mobile'=>str_random(10),'email'=>'admin2@gmail.com','password'=>bcrypt('beallyoucanbe'),'facebook'=>str_random(10),'skype'=>str_random(10),'avatar'=>str_random(10),'address'=>str_random(10),'school'=>str_random(10),'marketing_chanel'=>str_random(10),'status'=>1,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        	);
         Student::create(
            array('name'=>'Tạ Quang Hiếu','gender'=>1,'birthday'=>date("Y-m-d H:i:s"),'mobile'=>str_random(10),'email'=>'admin3@gmail.com','password'=>bcrypt('beallyoucanbe'),'facebook'=>str_random(10),'skype'=>str_random(10),'avatar'=>str_random(10),'address'=>str_random(10),'school'=>str_random(10),'marketing_chanel'=>str_random(10),'status'=>1,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
            );
    }
}
