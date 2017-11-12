<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToAttendencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendences', function (Blueprint $table) {

            if (Schema::hasColumn('attendences', 'time'))
            {
                $table->renameColumn('time', 'time_learn');
            }
            $table->integer('student_id')->unsigned();
            // $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->tinyInteger('type')->default(0)->comment('0: nghi hoc khong phep, 1: di hoc: 2: den muon, 3: nghi co phep');
            $table->dateTime('time_join')->nullable()->comment('thoi gian hoc vien join vao lop');

        });

        //remove table attendence_details
        Schema::dropIfExists('attendence_details');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
