<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clase', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_sucursal')->unsigned();
            $table->foreign('id_sucursal')->references('id')->on('sucursal');
            $table->integer('cupo')->unsigned();
            $table->string('nombre');
            $table->string('notas_especiales', 2000);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('clase_usuario', function(Blueprint $table) {
            $table->integer('id_clase')->unsigned();
            $table->foreign('id_clase')->references('id')->on('clase');
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')->on('users');
        });

        Schema::create('tipo_wod', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion', 1000);
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('wod', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion', 1000);
            $table->integer('likes');
            $table->boolean('publico');
            $table->integer('id_tipo_wod')->unsigned();
            $table->foreign('id_tipo_wod')->references('id')->on('tipo_wod');
            $table->integer('id_usuario')->unsigned()->nullable();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('sesion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_dia')->unsigned();
            $table->foreign('id_dia')->references('id')->on('dia');
            $table->time("hora_inicio");
            $table->time("hora_fin");
            $table->string("nombre");
            $table->string("notas_especiales", 2000);
            $table->integer('id_wod')->unsigned();
            $table->foreign('id_wod')->references('id')->on('wod');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ejecucion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario')->unsigned()->nullable();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->integer('id_wod')->unsigned();
            $table->foreign('id_wod')->references('id')->on('wod');
            $table->integer('id_sesion')->unsigned()->nullable();
            $table->foreign('id_sesion')->references('id')->on('sesion');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('asistencia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario')->unsigned()->nullable();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->integer('id_sesion')->unsigned()->nullable();
            $table->foreign('id_sesion')->references('id')->on('sesion');
            $table->boolean('asistio');
            $table->string('notas', 2000);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ejercicio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion', 2000);
            $table->string('instrucciones', 4000);
            $table->string('img', 200);
            $table->string('video', 200);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ejercicio_wod', function (Blueprint $table) {
            $table->integer('id_ejercicio')->unsigned();
            $table->foreign('id_ejercicio')->references('id')->on('ejercicio');
            $table->integer('id_wod')->unsigned();
            $table->foreign('id_wod')->references('id')->on('wod');
            $table->integer('repeticiones');
            $table->float('peso');
        });

        Schema::create('ejecucion_ejercicio', function (Blueprint $table) {
            $table->integer('id_ejercicio')->unsigned();
            $table->foreign('id_ejercicio')->references('id')->on('ejercicio');
            $table->integer('id_ejecucion')->unsigned();
            $table->foreign('id_ejecucion')->references('id')->on('wod');
            $table->integer('repeticiones');
            $table->float('peso');
            $table->integer('tiempo');
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
