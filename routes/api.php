<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('cors')->options('{any?}', function ($any = null) {
    return response("", 200);
})->where('any', '.*');


Route::group(['prefix' => 'auth', 'middleware' => ['cors']], function(){
    Route::post('login', 'AuthController@login');
});

//
Route::group(['middleware' => ['cors', 'auth:api', 'check_role']], function() {

    Route::group(['prefix' => 'membresia', 'middleware' => ['cors']], function() {
        Route::post('store', 'MembresiaController@store');
        Route::post('update', 'MembresiaController@update');
        Route::get('por-tipo/{id_tipo_membresia}', 'MembresiaController@porTipo');
        Route::delete('destroy/{id}', 'MembresiaController@destroy');
        Route::get('/', 'MembresiaController@index');
        Route::get('/{id}', 'MembresiaController@show');
    });
    
    Route::group(['prefix' => 'gimnasio', 'middleware' => ['cors']], function() {
        Route::post('store', 'GimnasioController@store');
        Route::post('update', 'GimnasioController@update');
        Route::get('buscar', 'GimnasioController@buscar');
        Route::delete('destroy/{id}', 'GimnasioController@destroy');
        Route::get('/', 'GimnasioController@index');
        Route::get('/{id}', 'GimnasioController@show');
    });
    
    Route::group(['prefix' => 'titulo', 'middleware' => ['cors']], function() {
        Route::post('store', 'TituloController@store');
        Route::post('update', 'TituloController@update');
        Route::delete('destroy/{id}', 'TituloController@destroy');
        Route::get('/', 'TituloController@index');
        Route::get('/{id}', 'TituloController@show');
    });
    Route::group(['prefix' => 'dia', 'middleware' => ['cors']], function() {
        Route::post('store', 'DiaController@store');
        Route::post('update', 'DiaController@update');
        Route::delete('destroy/{id}', 'DiaController@destroy');
        Route::get('/', 'DiaController@index');
        Route::get('/{id}', 'DiaController@show');
    });
    Route::group(['prefix' => 'usuariomembresia', 'middleware' => ['cors']], function() {
        Route::post('store', 'UsuarioMembresiaController@store');
        Route::post('update', 'UsuarioMembresiaController@update');
        Route::post('actualizarfechacorte', 'UsuarioMembresiaController@actualizarFechaCorte');
        Route::post('corte', 'UsuarioMembresiaController@corte');
        Route::post('listado-membresias', 'UsuarioMembresiaController@listadoMembresias');
        Route::get('expirados', 'UsuarioMembresiaController@expirados');
        Route::delete('destroy/{id}', 'UsuarioMembresiaController@destroy');
        Route::get('/', 'UsuarioMembresiaController@index');
        Route::get('/{id}', 'UsuarioMembresiaController@show');
    });
    Route::group(['prefix' => 'venta', 'middleware' => ['cors']], function() {
        Route::post('store', 'VentaController@store');
        Route::post('update', 'VentaController@update');
        Route::get('por-usuario', 'VentaController@porUsuario');
        Route::delete('destroy/{id}', 'VentaController@destroy');
        Route::get('/', 'VentaController@index');
        Route::get('/{id}', 'VentaController@show');
    });
    Route::group(['prefix' => 'metodopago', 'middleware' => ['cors']], function() {
        Route::post('store', 'MetodoPagoController@store');
        Route::post('update', 'MetodoPagoController@update');
        Route::delete('destroy/{id}', 'MetodoPagoController@destroy');
        Route::get('/', 'MetodoPagoController@index');
        Route::get('/{id}', 'MetodoPagoController@show');
    });
    Route::group(['prefix' => 'articulo', 'middleware' => ['cors']], function() {
        Route::post('store', 'ArticuloController@store');
        Route::post('update', 'ArticuloController@update');
        Route::get('por-categoria', 'ArticuloController@porCategoria');
        Route::get('por-sucursal', 'ArticuloController@porSucursal');
        Route::get('buscar', 'ArticuloController@buscar');
        Route::delete('destroy/{id}', 'ArticuloController@destroy');
        Route::get('/', 'ArticuloController@index');
        Route::get('/{id}', 'ArticuloController@show');
    });
    Route::group(['prefix' => 'contacto', 'middleware' => ['cors']], function() {
        Route::post('store', 'ContactoController@store');
        Route::post('update', 'ContactoController@update');
        Route::delete('destroy/{id}', 'ContactoController@destroy');
        Route::get('/', 'ContactoController@index');
        Route::get('/{id}', 'ContactoController@show');
    });
    Route::group(['prefix' => 'historialpuntos', 'middleware' => ['cors']], function() {
        Route::post('store', 'HistorialPuntosController@store');
        Route::post('update', 'HistorialPuntosController@update');
        Route::delete('destroy/{id}', 'HistorialPuntosController@destroy');
        Route::get('/', 'HistorialPuntosController@index');
        Route::get('/{id}', 'HistorialPuntosController@show');
    });
    Route::group(['prefix' => 'direccion', 'middleware' => ['cors']], function() {
        Route::post('store', 'DireccionController@store');
        Route::post('update', 'DireccionController@update');
        Route::delete('destroy/{id}', 'DireccionController@destroy');
        Route::get('/', 'DireccionController@index');
        Route::get('/{id}', 'DireccionController@show');
    });
    Route::group(['prefix' => 'sucursal', 'middleware' => ['cors']], function() {
        Route::post('store', 'SucursalController@store');
        Route::post('update', 'SucursalController@update');
        Route::get('entrenadores/{id_sucursal}', 'SucursalController@entrenadores');
        Route::delete('destroy/{id}', 'SucursalController@destroy');
        Route::get('/', 'SucursalController@index');
        Route::get('/{id}', 'SucursalController@show');
        Route::get('/bygym/{id_gimnasio}', 'SucursalController@indexByGimnasio');
    });
    Route::group(['prefix' => 'user', 'middleware' => ['cors']], function() {
        Route::post('store', 'UserController@store');
        Route::get('/byGym', 'UserController@usersByGym');        
        Route::post('update', 'UserController@update');
        Route::get('usuarios-inhabilitados', 'UserController@usuariosInhabilitados');
        Route::post('habilitar-usuario', 'UserController@habilitarUsuario');
        Route::post('asignar-gimnasio', 'UserController@asignarGimnasio');
        Route::delete('destroy/{id}', 'UserController@destroy');
        Route::get('/', 'UserController@index');
        Route::get('/{id}', 'UserController@show');
    });
    
    Route::group(['prefix' => 'clase', 'middleware' => ['cors']], function() {
        Route::post('store', 'ClaseController@store');
        Route::post('update', 'ClaseController@update');
        Route::get('por-sucursal-fecha', 'ClaseController@porSucursalYFecha');
        Route::delete('destroy/{id}', 'ClaseController@destroy');
        Route::get('/', 'ClaseController@index');
        Route::get('/{id}', 'ClaseController@show');
    });
    Route::group(['prefix' => 'tipowod', 'middleware'=> ['cors']], function() {
        Route::get('/', 'TipoWodController@index');
    });
    Route::group(['prefix' => 'wod', 'middleware'=> ['cors']], function() {
        Route::post('store', 'WodController@store');
        Route::post('update', 'WodController@update');
        Route::get('filtro', 'WodController@filtro');
        Route::delete('destroy/{id}', 'WodController@destroy');
        Route::get('/', 'WodController@index');
        Route::get('/{id}', 'WodController@show');
    });
    Route::group(['prefix' => 'sesion', 'middleware'=> ['cors']], function() {
        Route::post('store', 'SesionController@store');
        Route::post('update', 'SesionController@update');
        Route::post('usuario-suscrito', 'SesionController@usuarioSuscrito');        
        Route::post('proximas-sesiones', 'SesionController@proximasSesiones');        
        Route::get('por-dia-y-clase', 'SesionController@porDiaYClase');
        Route::delete('destroy/{id}', 'SesionController@destroy');
        Route::get('/', 'SesionController@index');
        Route::get('/{id}', 'SesionController@show');
    });
    Route::group(['prefix' => 'ejecucion', 'middleware'=> ['cors']], function() {
        Route::post('store', 'EjecucionController@store');
        Route::post('update', 'EjecucionController@update');
        Route::delete('destroy/{id}', 'EjecucionController@destroy');
        Route::get('/', 'EjecucionController@index');
        Route::get('/{id}', 'EjecucionController@show');
    });
    Route::group(['prefix' => 'asistencia', 'middleware'=> ['cors']], function() {
        Route::post('store', 'AsistenciaController@store');
        Route::post('update', 'AsistenciaController@update');
        Route::get('por-sesion', 'AsistenciaController@porSesion');
        Route::get('eliminar-sesion-usuario', 'AsistenciaController@eliminarSesionUsuario');
        Route::delete('destroy/{id}', 'AsistenciaController@destroy');
        Route::get('/', 'AsistenciaController@index');
        Route::get('/{id}', 'AsistenciaController@show');
    });
    Route::group(['prefix' => 'ejercicio', 'middleware'=> ['cors']], function() {
        Route::post('store', 'EjercicioController@store');
        Route::post('update', 'EjercicioController@update');
        Route::post('por-tipo-ejercicio/{id_tipo_ejercicio}', 'EjercicioController@porTipoEjercicio');
        Route::delete('destroy/{id}', 'EjercicioController@destroy');
        Route::get('/', 'EjercicioController@index');
        Route::get('/{id}', 'EjercicioController@show');
    });
    
    Route::group(['prefix' => 'atleta', 'middleware'=> ['cors']], function() {
        Route::post('store', 'AtletaController@store');
        Route::post('update', 'AtletaController@update');
        Route::get('buscar', 'AtletaController@buscar');
        Route::get('por-sucursal-activos', 'AtletaController@porSucursalActivos');
        Route::delete('destroy/{id}', 'AtletaController@destroy');
        Route::get('/', 'AtletaController@index');
        Route::get('/{id}', 'AtletaController@show');
    });


    Route::group(['prefix' => 'periodoclase'], function() {
        Route::post('store', 'PeriodoClaseController@store');
        Route::post('update', 'PeriodoClaseController@update');
        Route::delete('destroy/{id}', 'PeriodoClaseController@destroy');
        Route::get('/', 'PeriodoClaseController@index');
        Route::get('/{id}', 'PeriodoClaseController@show');
    });

    Route::group(['prefix' => 'tema', 'middleware'=> ['cors']], function() {
        Route::post('store', 'TemaController@store');
        Route::post('update', 'TemaController@update');
        Route::delete('destroy/{id}', 'TemaController@destroy');
        Route::get('/', 'TemaController@index');
        Route::get('/{id}', 'TemaController@show');
    });
    Route::group(['prefix' => 'configuracion', 'middleware'=> ['cors']], function() {
        Route::post('store', 'ConfiguracionController@store');
        Route::post('update', 'ConfiguracionController@update');
        Route::delete('destroy/{id}', 'ConfiguracionController@destroy');
        Route::get('/', 'ConfiguracionController@index');
        Route::get('/{id}', 'ConfiguracionController@show');
    });
    Route::group(['prefix' => 'rol', 'middleware'=> ['cors']], function() {
        Route::post('store', 'RolController@store');
        Route::post('update', 'RolController@update');
        Route::delete('destroy/{id}', 'RolController@destroy');
        Route::get('/', 'RolController@index');
        Route::get('/{id}', 'RolController@show');
    });
Route::group(['prefix' => 'tipomembresia', 'middleware'=> ['cors']], function() {
        Route::post('store', 'TipoMembresiaController@store');
        Route::get('por-sucursal/{id_sucursal}', 'TipoMembresiaController@porSucursal');
        Route::post('update', 'TipoMembresiaController@update');
        Route::delete('destroy/{id}', 'TipoMembresiaController@destroy');
        Route::get('/', 'TipoMembresiaController@index');
        Route::get('/{id}', 'TipoMembresiaController@show');
    });

    Route::group(['prefix' => 'tipoejercicio', 'middleware'=> ['cors']], function() {
        Route::post('store', 'TipoEjercicioController@store');
        Route::post('update', 'TipoEjercicioController@update');
        Route::delete('destroy/{id}', 'TipoEjercicioController@destroy');
        Route::get('/', 'TipoEjercicioController@index');
        Route::get('/{id}', 'TipoEjercicioController@show');
    });

Route::group(['prefix' => 'tiporonda', 'middleware' => ['cors']], function() {
    Route::get('/', 'TipoRondaController@index');
});

    Route::group(['prefix' => 'ronda', 'middleware' => ['cors']], function() {
        Route::post('store', 'RondaController@store');
        Route::post('update', 'RondaController@update');
        Route::get('filtro', 'RondaController@filtro');
        Route::delete('destroy/{id}', 'RondaController@destroy');
        Route::get('/', 'RondaController@index');
        Route::get('/{id}', 'RondaController@show');
    });

    Route::group(['prefix' => 'openpay', 'middleware' => ['cors']], function() {
        Route::post('add-customer', 'OpenpayController@addCustomer');
        Route::delete('delete-customer/{id_usuario}', 'OpenpayController@deleteCustomer');
        Route::post('add-card', 'OpenpayController@addCard');
    });

    Route::group(['prefix' => 'categoria', 'middleware' => ['cors']], function() {
        Route::post('store', 'CategoriaController@store');
        Route::post('update', 'CategoriaController@update');
        Route::get('buscar', 'CategoriaController@buscar');
        Route::delete('destroy/{id}', 'CategoriaController@destroy');
        Route::get('/', 'CategoriaController@index');
        Route::get('/{id}', 'CategoriaController@show');
    });

    Route::group(['prefix' => 'descuento'], function() {
        Route::post('store', 'DescuentoController@store');
        Route::put('update', 'DescuentoController@update');
        Route::delete('destroy/{id}', 'DescuentoController@destroy');
        Route::get('/', 'DescuentoController@index');
        Route::get('/{id}', 'DescuentoController@show');
    });
Route::group(['prefix' => 'ejercicioronda'], function() {
        Route::post('store', 'EjercicioRondaController@store');
        Route::put('update', 'EjercicioRondaController@update');
        Route::delete('destroy/{id}', 'EjercicioRondaController@destroy');
        Route::get('/', 'EjercicioRondaController@index');
        Route::get('/{id}', 'EjercicioRondaController@show');
    });
Route::group(['prefix' => 'tipodescanso'], function() {
        Route::post('store', 'TipoDescansoController@store');
        Route::put('update', 'TipoDescansoController@update');
        Route::delete('destroy/{id}', 'TipoDescansoController@destroy');
        Route::get('/', 'TipoDescansoController@index');
        Route::get('/{id}', 'TipoDescansoController@show');
    });
Route::group(['prefix' => 'unidad'], function() {
        Route::post('store', 'UnidadController@store');
        Route::put('update', 'UnidadController@update');
        Route::delete('destroy/{id}', 'UnidadController@destroy');
        Route::get('/', 'UnidadController@index');
        Route::get('/{id}', 'UnidadController@show');
    });
});


