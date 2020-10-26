<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipousuario extends Model
{
    protected $fillable = [
        'nombre'
    ];
    public function tramites()
    {
        return $this->hasMany('App\Tramite');
    }
}
