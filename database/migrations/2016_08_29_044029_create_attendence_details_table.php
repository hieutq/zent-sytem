<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendenceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendence_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attendence_id')->unsigned();
            // $table->foreign('attendence_id')->references('id')->on('attendences')->onDelete('cascade');
            $table->integer('student_id')->unsigned();
            // $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->tinyInteger('type')->default(0)->comment('0: nghi hoc khong phep, 1: di hoc: 2: den muon, 3: nghi co phep');
            $table->dateTime('time')->nullable()->comment('thoi gian hoc vien join vao lop');
            $table->softDeletes();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attendence_details');
    }
}
