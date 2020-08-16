<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Diaria;
use Faker\Generator as Faker;

$factory->define(Diaria::class, function (Faker $faker) {
    return [
        'data_diaria' => $faker->date(),
        'observacoes' => rand(0,3) ? $faker->realText('600') : null,
        'user_id' => function () {
            $randomUser = \Illuminate\Support\Facades\DB::table('users')
                ->inRandomOrder()
                ->first();
            return $randomUser->id;
        }
    ];
});
