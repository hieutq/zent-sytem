<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentClassRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_class_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_room_id')->unsigned()->nullable();
            // $table->foreign('class_room_id')->references('id')->on('class_rooms')->onDelete('cascade');
            
            $table->integer('student_id')->unsigned();
            // $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->integer('course_id')->unsigned();
            // $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            $table->integer('branch_id')->unsigned()->nullable()->comment('branch');
            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');

            $table->float('avg_point')->default(0);
            $table->float('sum_point')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0: new register, 1: caring, 2: paid tuition, 3: joined class, 4: breaked class');
            $table->text('note')->nullable();
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
        Schema::drop('student_class_rooms');
    }
}
