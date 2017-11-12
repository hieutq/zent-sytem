<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoomUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_room_units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_room_id')->unsigned();
            // $table->foreign('class_room_id')->references('id')->on('class_rooms')->onDelete('cascade');
            $table->integer('unit')->default(1)->unsigned();
            $table->string('unit_name');
            $table->text('note')->nullable();
            $table->string('picture')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1: show, 0: hide');
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
        Schema::drop('class_room_units');
    }
}
