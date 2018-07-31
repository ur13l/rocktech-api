<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $leader_id
 * @property string $name
 * @property User $user
 * @property Project[] $projects
 * @property User[] $users
 */
class Neuron extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['leader_id', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'leader_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function project()
    {
        return $this->hasOne('App\Project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function members()
    { 
        return $this->hasMany('App\Member');
    }
}
