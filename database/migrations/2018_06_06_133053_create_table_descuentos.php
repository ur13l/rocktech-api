<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDescuentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tipo_descuento', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tipo_aplicacion_descuento', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('descuento', function(Blueprint $table) {
            $table->increments('id');
            $table->float('descuento');
            $table->integer('cantidad_mayoreo');
            $table->integer('id_articulo')->unsigned();
            $table->foreign('id_articulo')->references('id')->on('articulo');
            $table->integer('id_tipo_descuento')->unsigned();
            $table->foreign('id_tipo_descuento')->references('id')->on('tipo_descuento');
            $table->integer('id_tipo_aplicacion_descuento')->unsigned();
            $table->foreign('id_tipo_aplicacion_descuento')->references('id')->on('tipo_aplicacion_descuento');
            $table->timestamps();
            $table->softDeletes();
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
