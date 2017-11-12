<?php

use Illuminate\Database\Seeder;

class ClassRoomsUnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('class_room_units')->insert([
        		array('class_room_id'->1,'unit'->1,'unit_name'->'Java 01','note'->'','picture'->'','status'->1,'create_at'->date("Y-m-d H:i:s"),'create_at'->date("Y-m-d H:i:s"))
        	]);
    }
}
