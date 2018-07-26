<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Imgur;
use App\User;
use App\Http\Resources\UserResource;
/**
 * Class: User Controller
 * @package App\Http\Controllers
 * @resource User
 */
class UserController extends Controller
{
    /**
     * User: Store
     * Método para la creación de una instancia de User
     * params: [email,nombre, password, apellido_paterno,apellido_materno,telefono,fecha_nacimiento,sexo,tipo_sangre,consumer_token,id_titulo,id_gimnasio,id_sucursal] 
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $request_data = $request->all();
        //Agregar reglas de validación.
        $rules = [
            'email' => 'required',
            'password' => 'required',
            'nombre' => 'required'
        ];

        $errors = $this->validate($request_data, $rules);
        if(count($errors) > 0) {
            return $this->error($errors);
        }
        
        if($request->file('foto')) {
            $imgur = Imgur::upload($request->file('foto'));
            $request_data['foto'] = $imgur->link(); 
        }

        $data = User::create($request_data);
        $data->updateOpenpayData();
        $data->token_=$data->createToken('MyApp')->accessToken;

        return new UserResource($data);
    }

    /**
     * User: Update
     * Método para la actualización de una instancia de User
     * params: params: [nombre,apellido_paterno,apellido_materno,telefono,fecha_nacimiento,sexo,tipo_sangre,consumer_token,id_titulo,id_gimnasio,id_sucursal] 
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $request_data = $request->all();        
        
        $data = User::find($request->id);
        if(!$data) {
            return $this->error(["Objeto no encontrado"]);
        }

        if($request->file('foto')) {
            $imgur = Imgur::upload($request->file('foto'));
            $request_data['foto'] = $imgur->link(); 
        }
        $data->update($request_data);
        $data->updateOpenpayData();
        return new UserResource($data);
    }

    /**
     * User: Destroy
     * Método para eliminar una instancia de User
     * params id
     * @param Integer $id
     * @return Response
     */
    public function destroy($id)
    {
        $data = User::find($id);
        if(!$data) {
            return $this->error(["Objeto no encontrado"]);
        }
        $data->delete();
        return new UserResource($data);
    }

    /**
     * User: Index
     * Método para mostrar una lista de User
     * params: [page, id_rol]
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data = User::where('id_rol', $request->id_rol)->paginate(10);
        return UserResource::collection($data);
    }

    /**
     * User: Show
     * Método para mostrar una instancia de User
     * params: id
     * @param Integer $id
     * @return Response
     */
    public function show($id)
    {
        $data = User::find($id);
        if(!$data) {
            return $this->error(["Objeto no encontrado"]);
        }
        return new UserResource($data);
    }

    /**
     * User: Users by gym
     * params: [id_rol, id_gimnasio, q]
     * Método para mostrar a todos los usuarios de un gimnasio en específico
     * @param $request
     * @return void
     */
    public function usersByGym(Request $request) {
        $data = User::where('id_gimnasio', $request->id_gimnasio)->
            where('id_rol', $request->id_rol)
            ->whereRaw("CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) like '%".$request->q."%'")
            ->paginate(10);
        return UserResource::collection($data);
    }

    /**
     * User: Asignar gimnasio
     * Permite asignar el gimnasioa un usuario.
     *
     * @param Request $request
     * @return void
     */
    public function asignarGimnasio(Request $request) {
       //Agregar reglas de validación.
        $rules = [
            'id_gimnasio' => 'required|exists:gimnasio,id'
        ];

        $errors = $this->validate($request->all(), $rules);
        if(count($errors) > 0) {
            return $this->error($errors);
        }
        $user = User::find($request->id_usuario);
        $user->id_gimnasio = $request->id_gimnasio;
        $user->save();
        return new UserResource($user);
    }

    /**
     * User: Usuarios inhabilitados
     * params: []
     * Devuelve una lista de los usuarios inhabilitados en el servicio, para la pantalla de activar usuarios
     *
     * @param Request $request
     * @return void
     */
    public function usuariosInhabilitados(Request $request) {
        $usuarios = User::where('deleted_at', '!=', null)->withTrashed()->get();
        return UserResource::collection($usuarios);
    }

    /**
     * User: Habilitar Usuario
     * params: [id_usuario]
     * Permite regresar a un usuario del cementerio al campo de batalla.
     * @param Request $request
     * @return void
     */
    public function habilitarUsuario(Request $request) {
        //Agregar reglas de validación.
        $rules = [
            'id_usuario' => 'required|exists:users,id'
        ];

        $errors = $this->validate($request->all(), $rules);
        if(count($errors) > 0) {
            return $this->error($errors);
        }

        $u = User::withTrashed()->find($request->id_usuario);
        $u->deleted_at = null;
        $u->save();
        return new UserResource($u);
    }
}
