<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder
{
   
    public function run()
    {
    	$this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(OptionValuesTableSeeder::class);
        // $this->call('PermissionsTableSeeder');

         $this->call(LanguagesTableSeeder::class);
         $this->call(RanksTableSeeder::class);
         $this->call(BranchesTableSeeder::class);
         $this->call(LevelsTableSeeder::class);
         // 
         //  $this->call(StudentTableSeeder::class);
         // $this->call(StudentHomeWorksTableSeeder::class);
         // $this->call(ClassRoomTableSeeder::class);

         // $this->call(StudentTableSeeder::class);
         $this->call(CoursesTableSeeder::class);
         $this->call(TheoryGroupsTableSeeder::class);

    }
}

