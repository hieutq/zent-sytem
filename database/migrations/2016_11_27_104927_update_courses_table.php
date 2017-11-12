<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function ($table) {
            
            if (Schema::hasColumn('courses', 'class_img')) {
               $table->dropColumn('class_img');
            }

            if (Schema::hasColumn('courses', 'header_bg_img')) {
               $table->dropColumn('header_bg_img');
            }

            if (Schema::hasColumn('courses', 'register_bg_img')) {
               $table->dropColumn('register_bg_img');
            }

            if (Schema::hasColumn('courses', 'footer_bg_img')) {
               $table->dropColumn('footer_bg_img');
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
