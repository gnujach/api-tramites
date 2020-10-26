<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    protected $fillable = [
        'tipousuario_id', 'dependencia_id', 'departamento_id', 'nombre', 'objetivo',
        'documento_obtenido', 'datos_institucionales', 'plazo_respuesta', 'costo',
        'url_proceso', 'activo'
    ];
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('nombre', 'like', '%' . $search . '%');
            });
        });
    }
    public function dependencia()
    {
        return $this->belongsTo('App\Dependencia');
    }
    public function departamento()
    {
        return $this->belongsTo('App\Departamento');
    }
    public function tipousuario()
    {
        return $this->belongsTo('App\Tipousuario');
    }
}
