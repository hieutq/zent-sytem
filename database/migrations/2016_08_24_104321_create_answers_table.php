<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (!Schema::hasTable('answers')) {
                Schema::create('answers', function (Blueprint $table) {
                    
                     $table->increments('id');
                     
                     $table->integer('language_id')->unsigned();
                     // $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
                     $table->integer('exercises_id')->unsigned();
                     // $table->foreign('exercises_id')->references('id')->on('exercises')->onDelete('cascade');
                     $table->text('content')->nullable();
                     $table->tinyInteger('status')->default(1)->comment('1: active, 0: deactive');
                     $table->softDeletes();
                    $table->timestampsTz();
                 
                });
            }
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('answers');
    }
}
