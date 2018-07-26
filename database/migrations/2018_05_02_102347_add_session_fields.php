<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSessionFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sesion', function(Blueprint $table) {
            $table->integer('id_profesor')->unsigned();
            $table->foreign('id_profesor')->references('id')->on('users');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->integer('cupo');
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
