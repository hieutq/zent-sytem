<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('short_name');
            $table->string('slogan')->nullable();
            $table->string('code', 100);
            $table->string('class_img')->nullable();
            $table->integer('capacity')->default(1);
            $table->text('class_info')->nullable();
            $table->text('student_object')->nullable();
            $table->text('content')->nullable();
            $table->date('orientation_time')->nullable();
            $table->string('time_table')->nullable();
            // $table->integer('branch_id')->unsigned()->nullable();
            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->text('class_desire_detail')->nullable();
            $table->string('tuition', 50)->nullable();
            $table->tinyInteger('status')->default(1)->comment('1: hiện ở website, 0: không hiện ở webiste');
            $table->string('header_bg_img')->nullable();
            $table->string('register_bg_img')->nullable();
            $table->string('footer_bg_img')->nullable();
            $table->text('register_info')->nullable();
            $table->string('class_fb_group')->nullable();
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
        Schema::drop('courses');
    }
}
