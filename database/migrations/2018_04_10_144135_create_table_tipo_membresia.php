<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTipoMembresia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_membresia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::table('membresia', function(Blueprint $table) {
            $table->dropForeign(['id_gimnasio']);
            $table->dropColumn('id_gimnasio');
            $table->integer('id_sucursal')->unsigned()->nullable();
            $table->foreign('id_sucursal')->references('id')->on('sucursal');
            $table->integer('id_tipo_membresia')->unsigned()->nullable();
            $table->foreign('id_tipo_membresia')->references('id')->on('tipo_membresia');
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
