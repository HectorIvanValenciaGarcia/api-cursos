<?php

use App\Http\Controllers\Api\CursosController;
use App\Http\Controllers\Api\EstudianteController;
use App\Http\Controllers\Api\InfoCursosController;
use App\Http\Controllers\Api\ProfesorController;


use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register',[EstudianteController::class, 'register']);
Route::post('login',[EstudianteController::class, 'login']);

Route::post('registerProfesor',[ProfesorController::class, 'register']);
Route::post('loginProfesor',[ProfesorController::class, 'login']);

Route::group(['middleware' => ["auth:sanctum"]], function()
{
    Route::group(['prefix' => 'Estudiantes'], function() {
        Route::get('user-profile',[EstudianteController::class, 'userProfile']);
        Route::get('logout',[EstudianteController::class, 'logout']);
    });
    
    Route::group(['prefix' => 'Profesor'], function() {
        Route::get('user-profile',[EstudianteController::class, 'userProfile']);
        Route::get('logout',[EstudianteController::class, 'logout']);
    });

    Route::group(['prefix' => 'Cursos'], function() {
        Route::post('crear-curso',[CursosController::class, 'crearCurso']);
        Route::post('registrarCurso',[InfoCursosController::class, 'registrarCurso']);
        Route::get('verRegistros',[InfoCursosController::class, 'verRegistros']);
        Route::post('estudiantesCursos',[InfoCursosController::class, 'estudiantesCursos']);
        Route::get('verCursos',[CursosController::class, 'verCursos']);
    });
    //routes list
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
