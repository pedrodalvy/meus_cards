<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Card;
use Faker\Generator as Faker;

$factory->define(Card::class, function (Faker $faker) {
    $dataFim = rand(0, 4) ? $faker->date('Y-m-d', 'now') : null;

    return [
        'card' => 'CARD-' . rand(1000, 7000),
        'titulo' => $faker->realText(80),
        'data_inicio' => $faker->date('Y-m-d', $dataFim),
        'data_fim' => $dataFim,
        'user_id' => function () {
            $randomUser = \Illuminate\Support\Facades\DB::table('users')
                ->inRandomOrder()
                ->first();
            return $randomUser->id;
        },
        'status' => function () {
            $status = \App\Enums\CardStatusEnum::getConstants();
            shuffle($status);
            return current($status);
        },
    ];
});
