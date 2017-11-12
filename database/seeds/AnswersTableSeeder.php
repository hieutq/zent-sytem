<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\Answer::create(
            array('language_id'=>'1','content'=>str_random(10))
        );
          \App\Models\Answer::create(
            array('language_id'=>'2','content'=>str_random(10))
        );
           \App\Models\Answer::create(
            array('language_id'=>'3','content'=>str_random(10))
        );
            \App\Models\Answer::create(
            array('language_id'=>'2','content'=>str_random(10))
        );
    }
}