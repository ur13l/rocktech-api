<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Permiso;
use App\Rol;

class PermisosController extends Controller
{
    
    public function index (Request $request) {

        $this->updateRoutes();
        $permisos = Permiso::orderBy('ruta')->get();
        $roles = Rol::all();
        return view('permisos', ['permisos' => $permisos, 'roles' => $roles]);
    }

    public function updatePermiso(Request $request) {
        $rol = Rol::find($request->id_rol);
        $permiso = Permiso::find($request->id_permiso);
        $enable = $request->enable;

        if($enable == "false") {
            $rol->permisos()->detach($permiso->id);
        }
        else {
            $rol->permisos()->attach($permiso->id);
        }
        return response()->json([
            'success'=>'ok'
        ]);
    }

    private function updateRoutes() {
        $routeList = Route::getRoutes();
        foreach ($routeList as $value)
        {
            $permiso = Permiso::where('ruta', $value->uri())->first();
            if(!$permiso) {
                if(substr($value->uri(),0,3) == 'api') {
                    Permiso::create([
                        'ruta' => $value->uri()
                    ]);
                }
            }
        }
    }
}
