<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = "permiso";
    protected $fillable = ['ruta'];


    public function roles() {
        return $this->belongsToMany('App\Rol', 'permiso_rol', 'id_permiso', 'id_rol');
    }
}
