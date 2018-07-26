<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tipo_usuario', function(Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion', 100);
        });

        Schema::create('titulo', function(Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion', 100);
            $table->integer('nivel_minimo');
            $table->string('icono', 1000);
        });

        Schema::table('users', function($table) {
            $table->string('nombre', 255);
            $table->string('apellido_paterno', 255);
            $table->string('apellido_materno', 255);
            $table->string('telefono', 15);
            $table->date('fecha_nacimiento');
            $table->string('sexo', 10);
            $table->string('tipo_sangre', 10);
            $table->string('foto', 1000);
            $table->text('consumer_token');
            $table->integer('id_tipo_usuario')->unsigned();
            $table->foreign('id_tipo_usuario')->references('id')->on('tipo_usuario');
            $table->integer('nivel');
            $table->integer('puntos_exp');
            $table->integer('id_titulo')->unsigned();
            $table->foreign('id_titulo')->references('id')->on('titulo');
            $table->integer('puntos_dinero');
        });

        Schema::create('historial_puntos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion', 100);
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->integer('puntos');
            $table->dateTime('fecha');
        });

        Schema::create('gimnasio', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100);
            $table->string('logo', 1000)->nullable();
            $table->string('pagina', 1000)->nullable();
            $table->string('descripcion', 1000)->nullable();
            $table->integer('puntos_por_asistencia');
        });

        Schema::create('membresia', function(Blueprint $table) {
            $table->increments('id');
            $table->float('costo');
            $table->string('divisa', 50);
            $table->integer('duracion')->nullable();
            $table->integer('cantidad_visitas');
            $table->integer('id_gimnasio')->unsigned();
            $table->foreign('id_gimnasio')->references('id')->on('gimnasio');
            $table->integer('puntos_por_membresia');
        });

        Schema::create('metodo_pago', function(Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion', 100);
        });

        Schema::create('usuario_membresia', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->integer('id_membresia')->unsigned();
            $table->foreign('id_membresia')->references('id')->on('membresia');
            $table->dateTime('fecha_compra');
            $table->integer('id_metodo_pago')->unsigned();
            $table->foreign('id_metodo_pago')->references('id')->on('metodo_pago');
            $table->float('costo');
            $table->float('descuento');
            $table->dateTime('fecha_corte');
            $table->integer('visitas');
            
        });

        Schema::create('direccion', function(Blueprint $table) {
            $table->increments('id');
            $table->double('latitud');
            $table->double('longitud');
            $table->string('pais');
            $table->string('estado');
            $table->string('municipio');
            $table->string('colonia');
            $table->string('codigo_postal', 10);
            $table->string('calle');
            $table->integer('num_ext');
            $table->integer('num_int')->nullable();
        });

        Schema::create('contacto', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_completo');
            $table->string('telefono');
            $table->string('correo');
            $table->time('horario_atencion_inicio');
            $table->time('horario_atencion_fin');
            $table->string('url_facebook');
        });

        Schema::create('sucursal', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('id_gimnasio')->unsigned();
            $table->foreign('id_gimnasio')->references('id')->on('gimnasio');
            $table->integer('id_contacto')->unsigned();
            $table->foreign('id_contacto')->references('id')->on('contacto');
            $table->integer('id_direccion')->unsigned();
            $table->foreign('id_direccion')->references('id')->on('direccion');
        });

        Schema::create('dia', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 20);
        });

        Schema::create('dias_sucursal', function(Blueprint $table) {
            $table->integer('id_dia')->unsigned();
            $table->foreign('id_dia')->references('id')->on('dia');
            $table->integer('id_sucursal')->unsigned();
            $table->foreign('id_sucursal')->references('id')->on('sucursal');
            $table->time('hora_apertura');
            $table->time('hora_cierre');
        });

        Schema::create('articulo', function(Blueprint $table) {
            $table->increments('id');   
            $table->string('nombre');
            $table->string('foto', 1000);
            $table->integer('id_sucursal')->unsigned();
            $table->foreign('id_sucursal')->references('id')->on('sucursal');
            $table->float('cantidad');
            $table->integer('stock_minimo');
            $table->float('precio');
            $table->string('divisa');
        });

        Schema::create('venta', function(Blueprint $table) {
            $table->increments('id');   
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->float('total');
            $table->dateTime('fecha_compra');
            $table->integer('id_metodo_pago')->unsigned();
            $table->foreign('id_metodo_pago')->references('id')->on('metodo_pago');
            $table->float('descuento');
        });

        Schema::create('compra_usuario', function(Blueprint $table) {
            $table->integer('id_articulo')->unsigned();
            $table->foreign('id_articulo')->references('id')->on('articulo');
            $table->integer('id_venta')->unsigned();
            $table->foreign('id_venta')->references('id')->on('venta');
            $table->float('cantidad');
            $table->float('precio');
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
