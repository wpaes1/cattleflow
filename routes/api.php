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
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::post('login', [LoginController::class, 'login']) ;

Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum'); ;

Route::get('/user', function (Request $request) {
   return $request->user();
})->middleware('auth:sanctum');





Route::apiResource('users', UserController::class) ;

Route::apiResource('farms', FarmController::class) ;
/*
Todas as rotas para o recurso "farms" estão definidas usando Route::apiResource, que automaticamente cria as seguintes rotas:
Route::get('/farms', [FarmController::class, 'index']) ;
Route::post('/farms', [FarmController::class, 'store']) ;
Route::get('/farms/{farm}', [FarmController::class, 'show']) ;
Route::put('/farms/{farm}', [FarmController::class, 'update']) ;
Route::delete('/farms/{id}', [FarmController::class, 'destroy']) ;
*/

Route::apiResource('pickets', PicketController::class);
Route::apiResource('lotanimals', LotAnimalsController::class);
Route::apiResource('animals', AnimalsController::class);
Route::apiResource('animalposts', AnimalPostsController::class);
Route::apiResource('postfiles', PostFilesController::class);
Route::apiResource('vaccineanimals', VaccineAnimalsController::class);
