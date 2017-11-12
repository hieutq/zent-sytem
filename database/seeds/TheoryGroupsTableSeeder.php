<?php

use Illuminate\Database\Seeder;
use App\Models\TheoryGroup;

class TheoryGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TheoryGroup::create([
            'name'=>'Bộ tài liệu java',
        ]);
        TheoryGroup::create([
            'name'=>'Bộ tài liệu Web basic',
        ]);
        TheoryGroup::create([
            'name'=>'Bộ tài liệu Web advance',
        ]);
        TheoryGroup::create([
           'name'=>'Bộ tài liệu Tester',
        ]);
        TheoryGroup::create([
          'name'=>'Bộ tài liệu C#'
        ]);
    }
}
