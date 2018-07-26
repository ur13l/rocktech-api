<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class RolResource extends Resource
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
            'created_at' => $this->created_at, 
            'updated_at' => $this->updated_at, 
            'deleted_at' => $this->deleted_at
        ];
    }
}
