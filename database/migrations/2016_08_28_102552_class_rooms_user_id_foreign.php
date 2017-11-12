<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClassRoomsUserIdForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('class_rooms', function (Blueprint $table) {

        //         if (Schema::hasColumn('class_rooms', 'user_id'))
        //         {
        //             $table->dropForeign('user_id_foreign');
        //             $table->dropColumn('user_id');
        //         }
        //         if (Schema::hasColumn('class_rooms', 'user_assistant_id'))
        //         {
        //             $table->dropForeign('user_assistant_id_foreign');
        //             $table->dropColumn('user_assistant_id');
        //         }
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
