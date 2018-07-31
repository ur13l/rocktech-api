<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Imgur;
use App\User;
use App\Neuron;
use App\Project;
use App\Member;
use App\Notifications\RegisterNotification;
use App\Http\Resources\UserResource;
/**
 * Class: User Controller
 * @package App\Http\Controllers
 * @resource User
 */
class UserController extends Controller
{

    /**
     * User: Register
     * Stores a user in the database, this method is called when the user submit the participation form in rocktech.mx
     * This method also adds the neuron and project to the database.
     * Params: [user, neuron, project]
     * -- user: {name, email, password, password_confirmation}
     * -- neuron: {name, members}
     * -- project: {name, objective, video}
     */
    public function register(Request $request) {
        //Agregar reglas de validación.
        $rules = [
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email',
            'user.password' => 'required',
            'neuron.name' => 'required',
            'project.name' => 'required',
            'project.objective' => 'required',
            'project.video' => 'required',
        ];

        $errors = $this->validate($request->all(), $rules);
        if(count($errors) > 0) {
            return $this->error($errors);
        }
        
        $u = $request->user;
        $n = $request->neuron;
        $p = $request->project;

        $user = User::create(
            $u + ['id_rol' => 2]
        );
        $neuron = Neuron::create(
            $n + ['leader_id' => $user->id]
        );
        $project = Project::create(
            $p + ['neuron_id' => $neuron->id]
        );

        foreach($n['members'] as $m) {
            $member = Member::create(
                $m + ['neuron_id' => $neuron->id]
            );
        }

        $user->neuron_id = $neuron->id;
        $user->save();
        $user->notify(new RegisterNotification());
        return new UserResource($user);
    }

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

}
