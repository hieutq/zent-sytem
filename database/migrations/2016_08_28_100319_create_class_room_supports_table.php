<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoomSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_room_supports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_room_id')->unsigned();
            // $table->foreign('class_room_id')->references('id')->on('class_rooms')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('type')->default(1)->comment('1: giao vien, 2: tro giang');
            // $table->primary(['class_room_id', 'user_id']);
            
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
        Schema::drop('class_room_supports');
    }
}
