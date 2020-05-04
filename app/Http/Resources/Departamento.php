<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Departamento extends JsonResource
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
                'type' => 'departamentos',
                'departamento_id' => $this->id,
                'attributes' => [
                    'nombre_departamento' => $this->nombre_departamento,
                    'activo' => $this->activo,
                    'created_at' => \Carbon\Carbon::parse($this->created_at)->diffForHumans(),
                ]
            ],
            'links' => [
                'self' => url('/api/departamento/' . $this->id),
            ]
        ];
    }
}
