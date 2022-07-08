<?php

use App\Http\Controllers\Api\EstudianteController;
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

Route::group(['middleware' => ["auth:sanctum"]], function()
{
    Route::get('user-profile',[EstudianteController::class, 'userProfile']);
    Route::get('logout',[EstudianteController::class, 'logout']);


});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
