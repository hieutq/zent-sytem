<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->tinyInteger('gender')->default(1)->comment('1: Male, 0: Female');
            $table->date('birthday')->nullable();
            $table->string('mobile', 50)->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('facebook')->nullable();
            $table->string('skype')->nullable();
            $table->string('avatar')->nullable();
            $table->string('address')->nullable();
            $table->string('work_place')->nullable();
            $table->mediumText('education_info')->nullable();
            $table->text('skill')->nullable();
            $table->string('position')->nullable();
            $table->mediumText('note')->nullable();
            $table->string('desire')->nullable();
            $table->tinyInteger('type')->default(1)->comment('1: Manager, 2: Teacher, 3: Teaching a assistant');
            $table->tinyInteger('status')->default(1)->comment('1: Active, 0: Deactive');
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
        Schema::drop('users');
    }
}
