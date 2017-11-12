<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('answers', function (Blueprint $table) {

            if (!Schema::hasColumn('answers', 'exercises_id')) {
                 $table->integer('exercises_id')->unsigned();
                 // $table->foreign('exercises_id')->references('id')->on('exercises')->onDelete('cascade');
                } 
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
