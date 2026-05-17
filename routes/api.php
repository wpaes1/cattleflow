<?php

use App\Http\Controllers\AnimalPostsController;
use App\Http\Controllers\AnimalsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\LotAnimalsController;
use App\Http\Controllers\PicketController;
use App\Http\Controllers\PostFilesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccineAnimalsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware('throttle:60,1')->group(function () { //Limita o número de requisições para 60 por minuto, para evitar abuso da API
    Route::apiResource('farms', FarmController::class)->middleware('auth:sanctum');
    Route::apiResource('pickets', PicketController::class)->middleware('auth:sanctum');
    Route::apiResource('lotanimals', LotAnimalsController::class)->middleware('auth:sanctum');
    Route::apiResource('animals', AnimalsController::class)->middleware('auth:sanctum');
    Route::apiResource('animalposts', AnimalPostsController::class)->middleware('auth:sanctum');
    Route::apiResource('postfiles', PostFilesController::class)->middleware('auth:sanctum');
    Route::apiResource('vaccineanimals', VaccineAnimalsController::class)->middleware('auth:sanctum')->habilitateOnly(['index', 'store', 'show', 'destroy'])    ;

    //User
    //Route::apiResource('users', UserController::class) ;//remover esta rota depois, apenas para teste de autenticação
    Route::get('usermyprofile', [UserController::class, 'myprofile'])->middleware('auth:sanctum');
    Route::post('user', [UserController::class, 'store']) ;


});
