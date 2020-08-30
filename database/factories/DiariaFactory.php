<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Diaria;
use Faker\Generator as Faker;

$factory->define(Diaria::class, function (Faker $faker) {
    return [
        'data_diaria'    => $faker->date(),
        'inicio_jornada' => '08:00:00',
        'fim_jornada'    => '18:20:00',
        'inicio_almoco'  => '11:30:00',
        'fim_almoco'     => '13:00:00',
        'observacoes'    => rand(0, 3) ? $faker->realText('600') : null,
        'user_id'        => function () {
            $randomUser = \Illuminate\Support\Facades\DB::table('users')
                ->inRandomOrder()
                ->first();
            return $randomUser->id;
        },
    ];
});
