<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre, 
            'email' => $this->email, 
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'telefono' => $this->telefono,
            'fecha_nacimiento' => $this->fecha_nacimiento->format('Y-m-d'),
            'sexo' => $this->sexo,
            'tipo_sangre' => $this->tipo_sangre,
            'consumer_token' => $this->consumer_token,
            'id_rol' => $this->id_rol,
            'rol' => $this->rol,
            'openpay_id' => $this->openpay_id,
            'foto' => $this->foto,
            'nivel' => $this->nivel,
            'puntos_exp' => $this->puntos_exp,
            'id_titulo' => $this->id_titulo,
            'id_gimnasio' => $this->id_gimnasio,
            'id_sucursal' => $this->id_sucursal,
            'usuario_membresia' => $this->usuarioMembresia()->with('membresia')->get(),            
            'token' => $this->token_,
            'sucursal' => $this->sucursal,
            'gimnasio' => $this->gimnasio
        ];     
    }
}
