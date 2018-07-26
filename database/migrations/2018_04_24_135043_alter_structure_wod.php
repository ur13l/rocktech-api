<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStructureWod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_ronda', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ronda', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('duracion');
            $table->integer('repeticiones');
            $table->integer('id_tipo_ronda')->unsigned();
            $table->foreign('id_tipo_ronda')->references('id')->on('tipo_ronda');               
            $table->integer('id_wod')->unsigned();
            $table->foreign('id_wod')->references('id')->on('wod');   
        });

        
        Schema::dropIfExists('ejercicio_wod');

        Schema::create('ejercicio_ronda', function(Blueprint $table) {
            $table->integer('id_ejercicio')->unsigned();
            $table->foreign('id_ejercicio')->references('id')->on('ejercicio');
            $table->integer('id_ronda')->unsigned();
            $table->foreign('id_ronda')->references('id')->on('ronda');   

            $table->integer('duracion');
            $table->integer('repeticiones');
            $table->float('peso');
        });

        Schema::table('ejecucion', function(Blueprint $table) {
            $table->dropForeign(['id_wod']);
            $table->integer('id_ronda')->unsigned()->nullable();
            $table->foreign('id_ronda')->references('id')->on('ronda');
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
