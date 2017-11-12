<?php

use Illuminate\Database\Seeder;

class ExercisesTableSeeder extends Seeder
{
	public function run()
	{
		\App\Models\Exercise::create(
			array('theory_group_id'=>'1','content'=>'Bai Tap Java','level_id'=>'1')
			);
		\App\Models\Exercise::create(
			array('theory_group_id'=>'2','content'=>'Bai Tap PHP Basic','level_id'=>'2')
			);
		\App\Models\Exercise::create(
			array('theory_group_id'=>'3','content'=>'Bai Tap HTML','level_id'=>'3')
			);
		\App\Models\Exercise::create(
			array('theory_group_id'=>'4','content'=>'Bai Tap C#','level_id'=>'4')
			);
	}
}