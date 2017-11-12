<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ranks', function ($table) {
            
            //delete
            
            if (Schema::hasColumn('ranks', 'min_point_all')) {
               $table->dropColumn('min_point_all');
            }
            if (Schema::hasColumn('ranks', 'min_point_class')) {
               $table->dropColumn('min_point_class');
            }
            if (Schema::hasColumn('ranks', 'min_point_unit')) {
               $table->dropColumn('min_point_unit');
            }
            if (Schema::hasColumn('ranks', 'avatar')) {
               $table->dropColumn('avatar');
            }

            // update table
            if (!Schema::hasColumn('ranks', 'min')) {
               $table->decimal('min', 14, 2)->default(0.00);
            }
            if (!Schema::hasColumn('ranks', 'max')) {
               $table->decimal('max', 14, 2)->default(0.00);
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
