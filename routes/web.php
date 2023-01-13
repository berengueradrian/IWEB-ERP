<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;

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
    // ruta para obtener todos los usuarios
    Route::get('/users', [UserController::class, 'getUsers']);
    // ruta para obtener un usuario
    Route::get('/users/{user}', [UserController::class, 'getUser']);
    // ruta para obtener si hay alguna jornada abierta
    Route::get('/jornada/{user}', [UserController::class, 'getJornada']);
    // ruta para obtener la categoria de un usuario
    Route::get('/categoria/{user}', [UserController::class, 'getCategoria']);
    // ruta para obtener todas categorias
    Route::get('/categoria', [CategoryController::class, 'getCategorias']);
    // ruta para obtener el supervisor de un usuario
    Route::get('/supervisor/{user}', [UserController::class, 'getSupervisor']);
    // ruta para obtener las jornadas de un usuario
    Route::get('/jornadas/{user}', [UserController::class, 'getJornadas']);
    // ruta para obtener las nominas de un usuario
    Route::get('/nominas/{user}', [UserController::class, 'getNominas']);
    // ruta para obtener las solicitudes de un usuario
    Route::get('/solicitudes/{user}', [UserController::class, 'getSolicitudes']);
    // ruta para crear una solicitud de un usuario
    Route::post('/solicitudes/{user}', [UserController::class, 'createSolicitud']);
    // ruta para guardar un archivo justificante de una solicitud
    Route::post('/solicitud/file', [UserController::class, 'saveJustificante']);
    // ruta para loguearse
    Route::post('/login', [LoginController::class, 'authenticate']);
    // ruta para obtener las solicitudes de vacaciones de los usuarios supervisados
    Route::get('/solicitudesVacaciones/{user}', [UserController::class, 'getSolicitudesVacaciones']);
    // ruta para aprobar una solicitud de vacaciones
    Route::post('/solicitudes/{solicitud}/aprobar', [UserController::class, 'aprobarSolicitudVacaciones']);
    // ruta para rechazar una solicitud de vacaciones
    Route::post('/solicitudes/{solicitud}/denegar', [UserController::class, 'denegarSolicitudVacaciones']);
});

Route::get('/{any}', [ApplicationController::class, 'index'])->where('any', '.*');
