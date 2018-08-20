<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $neuron_id
 * @property string $name
 * @property string $video
 * @property string $objective
 * @property Neuron $neuron
 */
class Project extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['neuron_id', 'name', 'video', 'objective', 'info', 'stage', 'doc'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function neuron()
    {
        return $this->belongsTo('App\Neuron');
    }
}
