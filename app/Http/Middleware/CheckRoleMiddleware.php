<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;
use App\Permiso;
use Auth;
use App\Rol;

class CheckRoleMiddleware
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
        $ruta = $request->route()->uri();
        $permiso = Permiso::where('ruta', $ruta)->first();
        $user = Auth::user();
        $rol = $user->rol;
        if($rol->permisos->contains($permiso->id)) {
            return $next($request);
        }
        return response()->json([
            'success' => false,
            'errors' => ['Permiso denegado'],
            'data' => null
        ]);
    }
}
