<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Tramite extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'tramites',
                'tramite_id' => $this->id,
                'attributes' => [
                    'nombre' => $this->nombre,
                    'departamento_id' => $this->departamento_id,
                    'tipousuario_id' => $this->tipousuario_id,
                    'dependencia_id' => $this->dependencia_id,
                    'objetivo'  => $this->objetivo,
                    'documento_obtenido' => $this->documento_obtenido,
                    'datos_institucionales' => $this->datos_institucionales,
                    'plazo_respuesta' => $this->plazo_respuesta,
                    'costo' => $this->costo,
                    'url_proceso'   => $this->url_proceso,
                    'activo' => $this->activo,
                    'created_at' => \Carbon\Carbon::parse($this->created_at)->diffForHumans(),
                    'updated_at' => \Carbon\Carbon::parse($this->updated_at)->diffForHumans(),
                ]
            ],
            'links' => [
                'self' => url('/api/tramites/' . $this->id),
            ]
        ];
    }
}
