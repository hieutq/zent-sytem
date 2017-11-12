<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->tinyInteger('gender')->default(1)->comment('1: Male, 0: Female');
            $table->date('birthday')->nullable();
            $table->string('mobile', 50)->unique();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('facebook')->nullable();
            $table->string('skype')->nullable();
            $table->string('avatar')->nullable();
            $table->string('address')->nullable();
            $table->string('school')->nullable();
            $table->string('marketing_chanel')->nullable();
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
        Schema::drop('students');
    }
}
