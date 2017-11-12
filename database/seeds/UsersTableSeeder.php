<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create(
            array(
                'name'=>'Super Admin',
                'gender'=>'1',
                'birthday' => '2015-01-01',
                'mobile'=> '0987654321',
                'email'=>'supperadmin@gmail.com',
                'password'=>bcrypt('beallyoucanbe'),
                'type'=>1,
                'status'=>1
            )        
        );
        User::create(
            array(
                'name'=>'Admin',
                'gender'=>'1',
                'birthday' => '2015-01-01',
                'mobile'=> '0987654322',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('123456'),
                'type'=>1,
                'status'=>1
            )        
        );

        User::create(
            array(
                'name'=>'Giáp Hiệp',
                'gender'=>'1',
                'birthday' => '2015-01-01',
                'mobile'=> '0987654323',
                'email'=>'badman@gmail.com',
                'password'=>bcrypt('123456'),
                'type'=>1,
                'status'=>1
            )        
        );
    }
}
