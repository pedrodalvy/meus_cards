<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\RegistroTrabalhoCard;
use Faker\Generator as Faker;

$factory->define(RegistroTrabalhoCard::class, function (Faker $faker) {
    $dataFim = rand(0, 9) ? $faker->dateTime('now') : null;

    return [
        'data_inicio' => $faker->dateTime($dataFim),
        'data_fim' => $dataFim,
        'descricao' => $faker->realText('100'),
        'card_id' => function () {
            $randomCard = \Illuminate\Support\Facades\DB::table('cards')
                ->inRandomOrder()
                ->first();
            return $randomCard->id;
        },
    ];
});