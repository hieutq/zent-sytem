<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDealineToClassRoomUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_room_units', function ($table) {
            
            //delete
            
            if (Schema::hasColumn('class_room_units', 'picture')) {
               $table->dropColumn('picture');
            }

            if (!Schema::hasColumn('class_room_units', 'deadline')) {
               $table->dateTime('deadline')->nullable();
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
        Schema::table('class_room_units', function ($table) {
            
            if (Schema::hasColumn('class_room_units', 'deadline')) {
               $table->dropColumn('deadline');
            }

           
        });
    }
}
