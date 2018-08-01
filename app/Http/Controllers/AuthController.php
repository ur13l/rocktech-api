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
     * Access the system with email and a password. This method will generate an API token which can be used to request another
     * resources with auth validation from the platform. 
     * Params: [email, password]
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            if($user->active) {
                $user->token_ =  $user->createToken('rocktech')->accessToken;
                return new UserResource($user);
            }
            return $this->error(["Tu cuenta no ha sido activada, por favor revisa tu correo electrónico para realizar el proceso de activación"]);
        }
        return $this->error(["Correo o contraseña incorrectos"]);
    }

}
