<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Requisito extends JsonResource
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
                'type' => 'requisitos',
                'requisito_id' => $this->id,
                'attributes' => [
                    'nombre' => $this->nombre,
                    'tipo' => $this->tipo,
                    'observaciones' => $this->observaciones,
                    'created_at' => \Carbon\Carbon::parse($this->created_at)->diffForHumans(),
                    'updated_at' => \Carbon\Carbon::parse($this->updated_at)->diffForHumans(),
                ]
            ],
            'links' => [
                'self' => url('/api/requisito/' . $this->id),
            ]
        ];
    }
}
