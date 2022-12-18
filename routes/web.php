<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'api'], function () {
    // route for start a jornada
    Route::post('/startJornada/{user}', [UserController::class, 'startJornada']);
    // ruta para finalizar una jornada
    Route::post('/endJornada/{user}', [UserController::class, 'endJornada']);
    // ruta para obtener un usuario
    Route::get('/users/{user}', [UserController::class, 'getUser']);
    // ruta para obtener si hay alguna jornada abierta
    Route::get('/jornada/{user}', [UserController::class, 'getJornada']);
    // ruta para obtener la categoria de un usuario
    Route::get('/categoria/{user}', [UserController::class, 'getCategoria']);
    // ruta para obtener el supervisor de un usuario
    Route::get('/supervisor/{user}', [UserController::class, 'getSupervisor']);
});

Route::get('/{any}', [ApplicationController::class, 'index'])->where('any', '.*');
