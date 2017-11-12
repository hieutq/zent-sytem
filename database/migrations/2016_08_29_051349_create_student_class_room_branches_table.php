<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentClassRoomBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('student_class_room_branches', function (Blueprint $table) {
        //     $table->integer('student_class_room_id')->unsigned();
        //     $table->foreign('student_class_room_id')->references('id')->on('student_class_rooms')->onDelete('cascade');
        //     $table->integer('class_room_id')->unsigned();
        //     $table->foreign('class_room_id')->references('id')->on('class_rooms')->onDelete('cascade');
        //     $table->primary(['student_class_room_id', 'class_room_id']);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('student_class_room_branches');
    }
}
