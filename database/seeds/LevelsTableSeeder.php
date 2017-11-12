<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\Models\Level::create([
       		'name' => 'Cơ bản'
       	]);

        \App\Models\Level::create([
       		'name' => 'Nâng cao'
       	]);

    }
}
