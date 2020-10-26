<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $fillable = [
        'nombre_departamento', 'activo'
    ];
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('nombre_departamento', 'like', '%' . $search . '%');
            });
        });
    }
    public function tramites()
    {
        return $this->hasMany('App\Tramite');
    }
}
