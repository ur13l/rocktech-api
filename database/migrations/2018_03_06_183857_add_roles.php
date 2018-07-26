<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol', function( Blueprint $table ) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('id_rol')->unsigned();
            $table->foreign('id_rol')->references('id')->on('rol');
        });

        Schema::create('permiso', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ruta');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('permiso_rol', function (Blueprint $table) {
            $table->integer('id_permiso')->unsigned();
            $table->foreign('id_permiso')->references('id')->on('permiso');
            $table->integer('id_rol')->unsigned();
            $table->foreign('id_rol')->references('id')->on('rol');
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
