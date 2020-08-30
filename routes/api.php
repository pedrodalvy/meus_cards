<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->middleware('api')->group(function () {

    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');
    Route::post('refresh', 'Auth\AuthController@refresh');

});

Route::prefix('v1')->middleware(['auth:api', 'jwt.refresh'])->group(function () {
    Route::apiResources([
        'diarias' => 'DiariaController',
        'cards'   => 'CardController',
    ]);
});

