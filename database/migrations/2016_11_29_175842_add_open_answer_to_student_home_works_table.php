<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpenAnswerToStudentHomeWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_home_works', function ($table) {
            
            if (!Schema::hasColumn('student_home_works', 'open_answer')) {
               $table->tinyInteger('open_answer')->default(0);
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_home_works', function ($table) {
            
            if (Schema::hasColumn('class_room_units', 'open_answer')) {
               $table->dropColumn('open_answer');
            }

           
        });
    }
}
