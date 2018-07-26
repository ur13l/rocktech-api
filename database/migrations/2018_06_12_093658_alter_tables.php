<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        
        Schema::create('tipo_descanso', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('descanso', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tiempo');
            $table->integer('id_tipo_descanso')->nullable()->unsigned();
            $table->foreign('id_tipo_descanso')->references('id')->on('tipo_descanso');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('ronda', function(Blueprint $table) {
            $table->dropColumn('duracion');
            $table->dropColumn('repeticiones');
            $table->integer('tiempo_limite')->nullable();
            $table->integer('sets')->nullable();
            $table->string('notas')->nullable();
            $table->integer('id_descanso')->unsigned()->nullable();
            $table->foreign('id_descanso')->references('id')->on('descanso');
        });

        Schema::table('wod', function(Blueprint $table){ 
            $table->integer('id_sucursal')->unsigned()->nullable();
            $table->foreign('id_sucursal')->references('id')->on('sucursal');
        });

        Schema::create('tipo_unidad', function (Blueprint $table){
            $table->increments('id');
            $table->string('nombre');
            $table->integer('id_unidad_base')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('unidad', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('id_tipo_unidad')->unsigned()->nullable();
            $table->float('equivalencia');
        });

        Schema::table('tipo_unidad', function(Blueprint $table) {
            $table->foreign('id_unidad_base')->references('id')->on('unidad');
        });

        Schema::table('unidad', function (Blueprint $table) {
            $table->foreign('id_tipo_unidad')->references('id')->on('tipo_unidad');
        });
        

        Schema::table('ejercicio_ronda', function (Blueprint $table) {
            $table->increments('id');
            $table->dropColumn('peso');
            $table->dropColumn('duracion');
            $table->integer('repeticiones')->nullable()->change();
            $table->integer('id_unidad')->nullable()->unsigned();
            $table->foreign('id_unidad')->references('id')->on('unidad');
            $table->float('intensidad')->nullable();
            $table->integer('tiempo_limite')->nullable();
            $table->integer('tiempo_trabajo')->nullable();
            $table->integer('tiempo_descanso')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('ejecucion_ejercicio', function(Blueprint $table) {
            $table->increments('id');
            $table->dropColumn('peso');
            $table->dropColumn('tiempo');
            $table->integer('repeticiones')->nullable()->change();
            $table->integer('id_unidad')->nullable()->unsigned();
            $table->foreign('id_unidad')->references('id')->on('unidad');
            $table->float('intensidad')->nullable();
            $table->integer('tiempo_limite')->nullable();
            $table->integer('tiempo_trabajo')->nullable();
            $table->integer('tiempo_descanso')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
        });

        Schema::create('galeria_ejercicio', function(Blueprint $table) {
            $table->increments('id');
            $table->string('img');
            $table->integer('id_ejercicio')->unsigned();
            $table->integer('orden');
        });

        Schema::table('ejercicio', function (Blueprint $table) {
            $table->integer('id_usuario')->unsigned()->nullable();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->integer('id_sucursal')->unsigned()->nullable();
            $table->foreign('id_sucursal')->references('id')->on('sucursal');
            $table->text('escalabilidad')->nullable();
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
