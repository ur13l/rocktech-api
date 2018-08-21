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
            'email' => $this->email, 
            'name' => $this->name,
            'neuron' => $this->neuron,
            'role' => $this->id_rol,
            'token' => $this->token_,
            'approved' => $this->approved,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'phone' => $this->phone,
            'social_network' => $this->social_network,
            'complementary' => $this->complementary,
            'idea_complementation' => $this->idea_complementation,
            'idea_validation' => $this->idea_validation,
        ];     
    }
}
