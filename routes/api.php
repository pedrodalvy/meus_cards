<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->middleware('api')->group(function () {

    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');
    Route::post('refresh', 'Auth\AuthController@refresh');

});

Route::middleware(['auth:api', 'jwt.refresh'])->get('/user', function (Request $request) {
    return $request->user();
});
