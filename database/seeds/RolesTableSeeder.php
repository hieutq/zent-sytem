<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(
            array('name'=>'superadmin','display_name'=>'superadmin','description'=>str_random(10), 'created_at' => date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s"))
        );
         Role::create(
            array('name'=>'admin','display_name'=>'admin','description'=>str_random(10), 'created_at' => date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s"))
        );
          Role::create(
            array('name'=>'teacher','display_name'=>'teacher','description'=>str_random(10), 'created_at' => date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s"))
        );
          Role::create(
            array('name'=>'teaching assistant ','display_name'=>'teaching assistant ','description'=>str_random(10), 'created_at' => date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s"))
        );
          Role::create(
            array('name'=>'mod','display_name'=>'mod','description'=>str_random(10), 'created_at' => date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s"))
        );

    }
}
