<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Timestamps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articulo', function(Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('compra_usuario', function(Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('contacto', function(Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('dia', function(Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('dias_sucursal', function(Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('direccion', function(Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('gimnasio', function(Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('historial_puntos', function(Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('membresia', function(Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('metodo_pago', function(Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('sucursal', function(Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('tipo_usuario', function(Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('titulo', function(Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('usuario_membresia', function(Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('venta', function(Blueprint $table) {
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
