<?php

use Illuminate\Database\Seeder;

class ClassRoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('class_rooms')->insert([
        	array('code'=>'WB04','class_name'=>'Web Front-End 04','orientation_time'=>'2016-09-15 15:20:34','time_table'=>'2016-09-15 15:20:34', 'number_of_unit'=>'16','tuition'=>'2499000','status'=>'2','course_id'=>'1','icon'=>'cloud-download','tuition_policy'=>'','max_tuition_policy'=>'500000','policy'=>'','facebook_group'=>'https://www.facebook.com/groups/674933555997454/','created_at' => date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s")),
        	array('code'=>'JB07','class_name'=>'Java Core 07','orientation_time'=>'2016-09-15 15:20:34','time_table'=>'2016-09-15 15:20:34', 'number_of_unit'=>'18','tuition'=>'3499000','status'=>'1','course_id'=>'2','icon'=>'coffee','tuition_policy'=>'','max_tuition_policy'=>'500000','policy'=>'','facebook_group'=>'https://www.facebook.com/groups/674933555997454/','created_at' => date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s")),
        	array('code'=>'PT01','class_name'=>'Test Basic 01','orientation_time'=>'2016-09-15 15:20:34','time_table'=>'2016-09-15 15:20:34', 'number_of_unit'=>'18','tuition'=>'3499000','status'=>'1','course_id'=>'2','icon'=>'coffee','tuition_policy'=>'','max_tuition_policy'=>'500000','policy'=>'','facebook_group'=>'https://www.facebook.com/groups/674933555997454/','created_at' => date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s")),
	    	array('code'=>'WA03','class_name'=>'Web Advance 03','orientation_time'=>'2016-09-15 15:20:34','time_table'=>'2016-09-15 15:20:34', 'number_of_unit'=>'16','tuition'=>'3499000','status'=>'1','course_id'=>'2','icon'=>'coffee','tuition_policy'=>'','max_tuition_policy'=>'500000','policy'=>'','facebook_group'=>'https://www.facebook.com/groups/674933555997454/','created_at' => date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s")),	
	    	array('code'=>'WA03','class_name'=>'Web Advance 03','orientation_time'=>'2016-09-15 15:20:34','time_table'=>'2016-09-15 15:20:34', 'number_of_unit'=>'16','tuition'=>'3499000','status'=>'1','course_id'=>'1','icon'=>'bug','tuition_policy'=>'','max_tuition_policy'=>'500000','policy'=>'','facebook_group'=>'https://www.facebook.com/groups/1058102957558144/','created_at' => date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s")),
	        ]);

        \App\Models\ClassRoom::create(
       		array('code'=>'WEB04', 'class_name'=>'Font-End','orientation_time'=>date("Y-m-d H:i:s"),'time_table'=>date("Y-m-d H:i:s"),'number_of_unit'=>1,'tuition'=>400000,'status'=>1,'course_id'=>1,'max_tuition_policy'=>1000000)
       		
       	);

    }
}
