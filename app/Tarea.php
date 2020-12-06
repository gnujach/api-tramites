<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = [
        'tramite_id', 'nombre',
    ];
    public function tramite()
    {
        return $this->belongsTo('App\Tramite');
    }
}
