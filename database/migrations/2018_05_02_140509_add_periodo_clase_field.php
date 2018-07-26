<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPeriodoClaseField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodo_clase', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_clase')->unsigned();
            $table->foreign('id_clase')->references('id')->on('clase');
            $table->integer('id_dia')->unsigned();
            $table->foreign('id_dia')->references('id')->on('dia');
            $table->time('hora_inicio');
            $table->time('hora_fin');
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
