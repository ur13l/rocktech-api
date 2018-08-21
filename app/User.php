<?php

namespace App;


use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\MyResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends Authenticatable implements CanResetPasswordContract
{
    use HasApiTokens, Notifiable, SoftDeletes;
    public const ROLE_ADMIN = 1;
    public const ROLE_USER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'name', 'active', 'id_rol', 'neuron_id', 'verify_token', 'approved', 'city', 'state', 'country', 'phone', 'social_network', 'complementary', 'idea_validation', 'idea_complementation'
    ];

    protected $dates = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Password encryption
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

    public function neuron() {
        return $this->belongsTo('App\Neuron', 'neuron_id')->with(['members', 'project']);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }

}
