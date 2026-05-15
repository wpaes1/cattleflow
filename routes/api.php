<?php

use App\Http\Controllers\FarmController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
