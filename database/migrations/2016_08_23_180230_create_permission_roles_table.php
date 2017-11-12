<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_roles', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            // $table->foreign('permission_id')->references('id')->on('permissions')
            //     ->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('role_id')->references('id')->on('roles')
            //     ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
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
        Schema::drop('permission_roles');
    }
}
