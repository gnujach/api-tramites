<?php

namespace App\Exceptions;

use Exception;

class ModelNotFoundException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'errors' => [
                'code'      => 400,
                'title'     => 'Modelo no encontrado',
                'detail'    => 'Tu solicitud no es correcta o hacen faltan datos',
                'meta'      => json_decode($this->getMessage())
            ]
        ], 400);
    }
}
