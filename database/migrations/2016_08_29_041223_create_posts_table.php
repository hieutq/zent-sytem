<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index();
            $table->string('image')->nullable();
            $table->string('image_icon')->nullable();
            $table->string('video')->nullable();
            $table->mediumText('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('slug')->unique();
            $table->integer('user_id')->unsigned();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('type')->default(1)->comment('bai post thuoc loai gi?');
            $table->tinyInteger('status')->default(1)->comment('1: public, 0: private');
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
        Schema::drop('posts');
    }
}
