<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoureseTheoryGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_theory_group', function (Blueprint $table) {
            $table->integer('course_id')->unsigned();
            // $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->integer('theory_group_id')->unsigned();
            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');

            $table->primary(['course_id', 'theory_group_id']);
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
        //
    }
}
