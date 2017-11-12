<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoomUnitTheoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_room_unit_theories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_room_unit_id')->unsigned();
            // $table->foreign('class_room_unit_id')->references('id')->on('class_room_units')->onDelete('cascade');
            $table->integer('theory_id')->unsigned();
            // $table->foreign('theory_id')->references('id')->on('theories')->onDelete('cascade');
            
            // $table->primary(['class_room_unit_id', 'theory_id']);
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
        Schema::drop('class_room_unit_theories');
    }
}
