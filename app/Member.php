<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Member extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'neuron_id', 'created_at', 'updated_at', 'deleted_at'];


    public function neuron() {
        return $this->belongsTo('App\Neuron', 'neuron_id');
    }
}
