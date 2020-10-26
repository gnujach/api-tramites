<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    protected $fillable = [
        'nombre', 'alias'
    ];
    public function tramites()
    {
        return $this->hasMany('App\Tramite');
    }
}
