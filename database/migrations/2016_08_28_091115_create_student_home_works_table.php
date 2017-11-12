<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentHomeWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_home_works', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_room_unit_id')->unsigned();
            // $table->foreign('class_room_unit_id')->references('id')->on('class_room_units')->onDelete('cascade');
            $table->integer('student_id')->unsigned();
            // $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->text('content')->nullable();
            $table->dateTime('time_submit')->nullable();
            $table->string('url')->nullable();
            $table->text('comment')->nullable();
            $table->float('point')->default(0);
            $table->float('point_plus')->default(0);
            $table->float('fine')->default(0);
            $table->float('bonous')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('status_submit')->default(1);
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
        Schema::drop('student_home_works');
    }
}
