<?php

use Illuminate\Database\Seeder;
use App\Models\Rank;

class RanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ranks')->truncate();

        Rank::create([
       		'name'=>'Basic',
       		'min'=>'0',
       		'max'=>'499',
       ]);

        Rank::create([
            'name'=>'Bronze',
            'min'=>'500',
            'max'=>'999',
         ]);

        Rank::create([
            'name'=>'Silver',
            'min'=>'1000',
            'max'=>'1999',
         ]);

        Rank::create([
            'name'=>'Gold',
            'min'=>'2000',
            'max'=>'5000',
         ]);
    }
}
