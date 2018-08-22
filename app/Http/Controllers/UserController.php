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
use App\Notifications\ApprovedIdeaNotification;
use App\Notifications\ValidateIdeaNotification;
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
            $u + 
            ['id_rol' => 2,
            'verify_token' => str_random(250)]
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
        $user->notify(new RegisterNotification($user));
        $user->token_ =  $user->createToken('rocktech')->accessToken;        
        return new UserResource($user);
    }

    /**
     * Method to activate a user in the database.
     */
    public function activateUser(Request $request) {
        //Validation rules
        $rules = [
            'token' => 'required'
        ];

        //Validation errors
        $errors = $this->validate($request->all(), $rules);
        if(count($errors) > 0) {
            return $this->error($errors);
        }

        //Checks if the provided token is valid
        $u = User::where('verify_token', $request->token)->first();
        if($u) {
            $u->active = true;
            $u->save();
            return response()->json([
                'data' => true
            ]);
        }
        return $this->error(['El token es inválido']);

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
     * params: []
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('updated_at','desc')->get();
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
     * Works for the approval of the user.
     */
    public function approve(Request $request) {
        //Agregar reglas de validación.
        $rules = [
            'id' => 'required|exists:users'
        ];
        $errors = $this->validate($request->all(), $rules);
        if(count($errors) > 0) {
            return $this->error($errors);
        }
        $data = User::find($request->id);
        $data->approved = true;
        $data->save();
        $data->notify(new ApprovedIdeaNotification());
        return new UserResource($data);
    }

    /**
     * When the user complete the second form.
     */
    public function ideaComplementation(Request $request) {
        $u = Auth::guard('api')->user();
        $u->update($request->all());
        $p = $u->neuron->project;
        $p->info = $request->neuron['project']['info'];
        $p->stage = $request->neuron['project']['stage'];
        $p->doc = $request->neuron['project']['doc'];
        $u->idea_complementation = true;
        $u->save();
        $p->save();
        return new UserResource($u);
    }

    /**
     * Validation of the idea
     */
    public function validateIdea(Request $request) {
        //Agregar reglas de validación.
        $rules = [
            'id' => 'required|exists:users'
        ];
        $errors = $this->validate($request->all(), $rules);
        if(count($errors) > 0) {
            return $this->error($errors);
        }
        $data = User::find($request->id);
        $data->idea_validation = true;
        $data->save();
        $data->notify(new ValidateIdeaNotification());
        return new UserResource($data);
    }

}
