<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRondaProfesorPeriodo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('periodo_clase', function(Blueprint $table) {
            $table->integer('id_ronda')->unsigned()->nullable();
            $table->foreign('id_ronda')->references('id')->on('ronda');
            $table->integer('id_profesor')->unsigned()->nullable();
            $table->foreign('id_profesor')->references('id')->on('users');

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
