<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tipousuario;
use Faker\Generator as Faker;

$factory->define(Tipousuario::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
    ];
});
