<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    protected $fillable = ['nombre', 'tipo', 'observaciones', 'activo'];
    public function tramites()
    {
        return $this->belongsToMany('App\Tramite')->withTimestamps();
    }
}
