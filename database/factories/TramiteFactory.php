<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tramite;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Dependencia;
use App\Tipousuario;
use App\Departamento;

$factory->define(Tramite::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'dependencia_id' => factory(App\Dependencia::class),
        'tipousuario_id' => factory(App\Tipousuario::class),
        'departamento_id' => factory(App\Departamento::class),
        // 'departamento_id' => 1,
        'objetivo' => $faker->sentence,
        'documento_obtenido' => $faker->sentence,
        'datos_institucionales' => $faker->sentence,
        'plazo_respuesta' => $faker->paragraph,
        'costo' => $faker->randomNumber(),
        'url_proceso' => $faker->url,
        'activo' => $faker->boolean
    ];
});
