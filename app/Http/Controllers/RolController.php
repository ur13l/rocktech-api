<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Rol;
use App\Http\Resources\RolResource;

class RolController extends Controller
{
    /**
     * Rol: Store
     * Método para la creación de una instancia de Rol
     * params: [nombre] 
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //Agregar reglas de validación.
        $rules = [];

        $errors = $this->validate($request->all(), $rules);
        if(count($errors) > 0) {
            return $this->error($errors);
        }
        $data = Rol::create($request->all());
        return new RolResource($data);
    }

    /**
     * Rol: Update
     * Método para la actualización de una instancia de Rol
     * params: [nombre] 
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        
        $data = Rol::find($request->id);
        if(!$data) {
            return $this->error("Objeto no encontrado");
        }
        $data->update($request->all());
        return new RolResource($data);
    }

    /**
     * Rol: Destroy
     * Método para eliminar una instancia de Rol
     * params id
     * @param Integer $id
     * @return Response
     */
    public function destroy($id)
    {
        $data = Rol::find($id);
        if(!$data) {
            return $this->error("Objeto no encontrado");
        }
        $data->delete();
        return new RolResource($data);
    }

    /**
     * Rol: Index
     * Método para mostrar una lista de Rol
     * params: [page]
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data = Rol::paginate(10);
        return RolResource::collection($data);
    }

    /**
     * Rol: Show
     * Método para mostrar una instancia de Rol
     * params: id
     * @param Integer $id
     * @return Response
     */
    public function show($id)
    {
        $data = Rol::find($id);
        if(!$data) {
            return $this->error("Objeto no encontrado");
        }
        return new RolResource($data);
    }
}
