<?php

use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\Branch::create(
       		array('address'=>'Cơ Sở 1 Time City', 'phone'=>'0968706683')
       	);
         \App\Models\Branch::create(
          array('address'=>'Cơ Sở 2 Thanh Nhàn', 'phone'=>'0968706686')
        );

    }
}
