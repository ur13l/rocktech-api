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

Route::middleware('cors')->post('reset/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::middleware('cors')->post('reset/password', 'Auth\ResetPasswordController@reset')->name('password.reset');

Route::group(['prefix' => 'auth', 'middleware' => ['cors']], function(){
    Route::post('login', 'AuthController@login');
});

//
Route::group(['middleware' => ['cors']], function() {


    

    Route::group(['prefix' => 'user'], function() {
        Route::post('register', 'UserController@register');
        Route::post('activate', 'UserController@activateUser');
    });

    Route::group(['prefix' => 'user', 'middleware'=>'auth.admin'], function () {
        Route::get('/', 'UserController@index'); 
        Route::get('/{id}', 'UserController@show');
        Route::post('/approve', 'UserController@approve');
        Route::post('/idea-complementation', 'UserController@ideaComplementation');
        
    });

    Route::group(['prefix' => 'rol', 'middleware'=> ['cors']], function() {
        Route::post('store', 'RolController@store');
        Route::post('update', 'RolController@update');
        Route::delete('destroy/{id}', 'RolController@destroy');
        Route::get('/', 'RolController@index');
        Route::get('/{id}', 'RolController@show');
    });
    
  
});


