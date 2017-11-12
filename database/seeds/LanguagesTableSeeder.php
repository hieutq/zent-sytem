<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Language::create([
       		'name'=> 'java'
       ]);
        \App\Models\Language::create([
       		'name'=> 'php'
       ]);
        \App\Models\Language::create([
       		'name'=> 'c'
       ]);
    }
}
