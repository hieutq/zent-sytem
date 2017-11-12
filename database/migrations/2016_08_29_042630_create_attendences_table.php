<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('nguoi diem danh')->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('class_room_id')->unsigned()->nullable();
            // $table->foreign('class_room_id')->references('id')->on('class_rooms')->onDelete('cascade');
            $table->integer('class_room_unit_id')->unsigned()->nullable();
            // $table->foreign('class_room_unit_id')->references('id')->on('class_room_units')->onDelete('cascade');
            $table->dateTime('time')->nullable()->comment('thoi gian hoc');
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
        Schema::drop('attendences');
    }
}
