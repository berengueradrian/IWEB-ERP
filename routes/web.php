<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\NominaController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\SupervisorAuth;

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

// User auth needed
Route::group(['prefix' => 'api', 'middleware' => 'auth:api'], function () {
    // route for start a jornada
    Route::post('/startJornada/{user}', [UserController::class, 'startJornada']);
    // ruta para finalizar una jornada
    Route::post('/endJornada/{user}', [UserController::class, 'endJornada']);
    // ruta para obtener los usuarios supervisores
    Route::get('/supervisores', [UserController::class, 'getSupervisors'])->middleware(SupervisorAuth::class);
    // ruta para obtener si hay alguna jornada abierta
    Route::get('/jornada/{user}', [UserController::class, 'getJornada']);
    // ruta para obtener la categoria de un usuario
    Route::get('/categoria/{user}', [UserController::class, 'getCategoria']);
    // ruta para obtener todas categorias
    Route::get('/categorias', [CategoryController::class, 'getCategorias']);
    //ruta para crear categoría
    Route::post('/categorias', [CategoryController::class, 'createCategoria']);
    // ruta para actualizar una categoria
    Route::post('/categorias/{id}', [CategoryController::class, 'updateCategoria']);
    // ruta para obtener el supervisor de un usuario
    Route::get('/supervisor/{user}', [UserController::class, 'getSupervisor']);
    // ruta para obtener las jornadas de un usuario
    Route::get('/jornadas/{user}', [UserController::class, 'getJornadas']);
    // ruta para obtener las nominas de un usuario
    Route::get('/nominas/users/{user}', [NominaController::class, 'getNominasUsuario']);
    // ruta para obtener una nomina
    Route::get('/nominas/{nomina}', [NominaController::class, 'getNomina']);
    // ruta para obtener todas las nominas
    Route::get('/nominas', [NominaController::class, 'getAllNominas']);
    // ruta para comprobar si se han generado nominas o no
    Route::post('/nominas/generadas', [NominaController::class, 'checkNominasGeneradas']);
    // ruta para generar nominas
    Route::post('/nominas/generar', [NominaController::class, 'generarNominas']);
    // ruta para cambiar estado de una nomina
    Route::post('/nominas/{nomina}/pagada', [NominaController::class, 'changeEstadoPagado']);
    // ruta para obtener las solicitudes de un usuario
    Route::get('/solicitudes/{user}', [UserController::class, 'getSolicitudes']);
    // ruta para crear una solicitud de un usuario
    Route::post('/solicitudes/{user}', [UserController::class, 'createSolicitud']);
    // ruta para guardar un archivo justificante de una solicitud
    Route::post('/solicitud/file', [UserController::class, 'saveJustificante']);
    // ruta para obtener las solicitudes de vacaciones de los usuarios supervisados
    Route::get('/solicitudesVacaciones/{user}', [UserController::class, 'getSolicitudesVacaciones']);
    // ruta para aprobar una solicitud de vacaciones
    Route::post('/solicitudes/{solicitud}/aprobar', [UserController::class, 'aprobarSolicitudVacaciones']);
    // ruta para rechazar una solicitud de vacaciones
    Route::post('/solicitudes/{solicitud}/denegar', [UserController::class, 'denegarSolicitudVacaciones']);
    // ruta para crear un nuevo usuario
    Route::post('/users', [UserController::class, 'createUser'])->middleware(AdminAuth::class);
    // ruta para obtener un usuario
    Route::get('/users/{user}', [UserController::class, 'getUser']);
    // ruta para borrar un usuario
    Route::delete('/users/{user}', [UserController::class, 'deleteUser'])->middleware(AdminAuth::class);
    // ruta para obtener las horas trabajadas de un usuario
    Route::get('/horas/count/{user}', [UserController::class, 'getNumeroHoras']);
    // ruta para obtener el numero de compañeros de un usuario
    Route::get('/companeros/count/{user}', [UserController::class, 'getNumeroCompaneros']);
    // ruta para borrar una solicitud de un usuario
    Route::delete('/solicitudes/{solicitud}', [UserController::class, 'deleteSolicitud']);
    // ruta para cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout']);
    //Ruta para borrar una categoria
    Route::delete('/categorias/{id}', [CategoryController::class, 'deleteCategoria']);
    // Ruta para coger solo una categoria
    Route::get('/categorias/{id}', [CategoryController::class, 'getCategoria']);
    //Ruta para obtener las solicitudes enviadas al administrador
    Route::get('/solicitudesAdmin', [SolicitudController::class, 'getSolicitudesAdmin'])->middleware(AdminAuth::class);;
    Route::get('/upload', [FileController::class, 'index']);
    Route::post('/upload', [FileController::class, 'upload'])->name('upload');

});

// Routes accesible from API KEY auth
Route::group(['prefix' => 'api', 'middleware' => 'apiKeyAuth'], function() {
    // ruta para obtener todos los usuarios
    Route::get('/users', [UserController::class, 'getUsers']);
    // ruta para obtener un usuario
    Route::get('/users/{user}', [UserController::class, 'getUser']);
});

// No auth routes
Route::group(['prefix' => 'api'], function() {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/{any}', [ApplicationController::class, 'index'])->where('any', '.*');
