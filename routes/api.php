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
Route::group(['middleware' => ['cors']], function() {

    Route::group(['prefix' => 'user'], function() {
        Route::post('register', 'UserController@register');
    });

    Route::group(['prefix' => 'rol', 'middleware'=> ['cors']], function() {
        Route::post('store', 'RolController@store');
        Route::post('update', 'RolController@update');
        Route::delete('destroy/{id}', 'RolController@destroy');
        Route::get('/', 'RolController@index');
        Route::get('/{id}', 'RolController@show');
    });
    
  
});


