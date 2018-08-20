<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class AuthAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('api')->user();
        $role = $user->id_rol;
        if($user && $role == User::ROLE_ADMIN) {
            return $next($request);
        }
        return response()->json([
            'success' => false,
            'errors' => ['Permiso denegado, función solo para administradores'],
            'data' => null
        ]);
    }
}
