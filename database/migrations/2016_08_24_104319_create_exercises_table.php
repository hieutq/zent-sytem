<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('theory_group_id')->unsigned();
            $table->integer('theory_id')->unsigned();
            // $table->foreign('theory_group_id')->references('id')->on('theory_groups')->onDelete('cascade');
            
            $table->text('content')->nullable();

            $table->integer('level_id')->unsigned();
            // $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
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
        Schema::drop('exercises');
    }
}
