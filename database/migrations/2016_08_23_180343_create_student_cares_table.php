<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentCaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_cares', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable()->comment('user care student');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('student_id')->unsigned();
            // $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->tinyInteger('care_type')->default(1)->comment('1: Email, 2: SMS, 3: Call');
            $table->string('reviver_address')->nullable()->comment('Email or Mobile');
            $table->text('content')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0: Create, 1: Sended, 3: Cancel');
            $table->tinyInteger('read_status')->default(0)->comment('when student cared. update = 1');
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
        Schema::drop('student_cares');
    }
}
