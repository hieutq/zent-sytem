<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoomUnitExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_room_unit_exercises', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('class_room_unit_id')->unsigned();
            // $table->foreign('class_room_unit_id')->references('id')->on('class_room_units')->onDelete('cascade');
            $table->integer('exercise_id')->unsigned();
            // $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');

            $table->integer('answer_id')->unsigned()->nullable();
            // $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
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
        Schema::drop('class_room_unit_exercises');
    }
}
