<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeClassRoomIdStudentClassRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

         // Schema::table('student_class_rooms', function (Blueprint $table) {
            
         //        if (Schema::hasColumn('student_class_rooms', 'class_room_id')) {
         //            $table->integer('class_room_id')->unsigned()->nullable()->change();
         //        }
         // });
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
