<?php

namespace App;


use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use App\Utils\OpenpayUtils;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'nombre', 'apellido_paterno', 'apellido_materno', 'telefono', 
        'fecha_nacimiento', 'foto', 'sexo', 'tipo_sangre', 'consumer_token', 'id_rol', 'nivel', 
        'id_sucursal','puntos_exp', 'id_titulo', 'id_gimnasio', 'openpay_id'
    ];

    protected $dates = ['fecha_nacimiento'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Método llamado para encriptar la contraseña cada que se actualice
     *
     * @param String $password
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function rol() {
        return $this->belongsTo('App\Rol', 'id_rol');
    }

    public function usuarioMembresia() {
        return $this->hasOne('App\UsuarioMembresia', 'id_usuario')
            ->where('fecha_inicio', '<=', Carbon::now())
            ->where('fecha_corte', '>=', Carbon::now());
    }

    public function ultimaMembresia() {
        return $this->hasOne('App\UsuarioMembresia', 'id_usuario')
            ->orderBy('fecha_inicio', 'desc');
    }

    public function historialMembresias() {
        return $this->hasMany('App\UsuarioMembresia', 'id_usuario')->orderBy('fecha_inicio', 'desc');
    }

    public function proximasMembresias() {
        return $this->hasMany('App\UsuarioMembresia', 'id_usuario')
            ->where('fecha_inicio', '>=', Carbon::now())
            ->orderBy('fecha_inicio');
    }

    public function proximasActualMembresias() {
        return $this->hasMany('App\UsuarioMembresia', 'id_usuario')
            ->where('fecha_corte', '>=', Carbon::now())
            ->orderBy('fecha_inicio');
    }

    public function updateFechasMembresias() {
        $date = $this->usuarioMembresia->fecha_corte->addDays(1);
        foreach($this->proximasMembresias as $um) {
            $um->fecha_inicio = (clone $date);
            $um->fecha_corte = (clone $date)->addMonths($um->membresia->duracion);
            $um->save();
            $date = (clone $um->fecha_corte)->addDays(1);
        }
    }

    public function sucursal() {
        return $this->belongsTo('App\Sucursal', 'id_sucursal');
    }

    public function gimnasio() {
        return $this->belongsTo('App\Gimnasio', 'id_gimnasio')->with('configuracion');
    }

    public function asistencias() {
        return $this->hasMany('App\Asistencia', 'id_usuario');
    }
    /**
     *  Crea o actualiza el registro del usuario en Openpay 
     * @return Customer
     */
    public function updateOpenpayData() {
        $openpay = OpenpayUtils::getInstance();
        if(!$this->openpay_id) {
            $customerData = array(
                'name' => $this->nombre,
                'last_name' => $this->apellido_paterno . ' ' . $this->apellido_materno,
                'email' => $this->email,
                'phone_number' => $this->telefono,
                'address' => null
            );
            $customer = $openpay->customers->add($customerData);
            
        }
        else {
            $customer = $openpay->customers->get($this->openpay_id);
            $customer->name = $this->nombre;
            $customer->last_name = $this->apellido_paterno . ' ' . $this->apellido_materno;
            $customer->email = $this->email;
            $customer->phone_number = $this->telefono;
            $customer->save();
        }
        $this->openpay_id = $customer->id;
        $this->save();
        
        return $customer;
    }
}
