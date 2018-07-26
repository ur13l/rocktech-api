<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Auth;

/**
 * Class: AuthController
 * @resource Auth
 */
class AuthController extends Controller
{
    /**
     * Auth: Login
     * Access the system through an email and a password. 
     * Params: [email, password]
     * @return \Illuminate\Http\Response
     */
    public function login(){

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $user->token_ =  $user->createToken('MyApp')->accessToken;
            return new UserResource($user);
        }

        else{
            return $this->error(["Correo o contraseña incorrectos"]);
        }
    }

}
