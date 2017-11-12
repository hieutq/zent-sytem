<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',20);
            $table->string('class_name');
            
            $table->date('orientation_time')->nullable()->comment('khai giảng');
            $table->date('time_table')->nullable()->comment('lịch học');

            // $table->integer('branch_id')->unsigned()->nullable()->comment('branch');
            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');

            $table->integer('number_of_unit')->default(1)->comment('số buổi học');
            $table->integer('tuition')->default(10000)->comment('tiền học phí');
            $table->tinyInteger('status')->default(0)->comment('0: chuẩn bị khai giảng, 1: đã khai giảng, 2: đã kết thúc, 3: đã quyết toán');
            
            $table->integer('course_id')->unsigned();
            // $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            $table->string('icon')->nullable();
            $table->text('tuition_policy')->nullable()->comment('chính sách giảm học phí');
            $table->integer('max_tuition_policy')->nullable()->comment('số tiền giảm học phí tối đa');
            $table->text('policy')->nullable()->comment('nội quy lớp');
            $table->string('facebook_group')->nullable();
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
        Schema::drop('class_rooms');
    }
}
