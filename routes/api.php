<?php

use App\Http\Controllers\AnimalPostsController;
use App\Http\Controllers\AnimalsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\LotAnimalsController;
use App\Http\Controllers\PicketController;
use App\Http\Controllers\PostFilesController;
use App\Http\Controllers\UserActivationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserProfileHabilityController;
use App\Http\Controllers\VaccineAnimalsController;
use App\Http\Controllers\VerificationEmailController;


use Illuminate\Support\Facades\Route;

Route::post('email/verify', [VerificationEmailController::class, 'resend'])
    ->middleware(['auth:sanctum','throttle:6,1'])
    ->name('verification.send');

Route::get('email/verify/{id}/{hash}', [VerificationEmailController::class, 'verify'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');


Route::middleware('throttle:60,1')->group(function () { //Limita o número de requisições para 60 por minuto, para evitar abuso da API


    Route::post('login', [LoginController::class, 'login']); //Adiciona o middleware para verificar se o email do usuário está verificado antes de permitir o login;
    Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');


    Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth:sanctum', 'verified']);;



    Route::apiResource('farms', FarmController::class)->middleware('auth:sanctum');
    Route::apiResource('pickets', PicketController::class)->middleware('auth:sanctum');
    Route::apiResource('lotanimals', LotAnimalsController::class)->middleware('auth:sanctum');
    Route::apiResource('animals', AnimalsController::class)->middleware('auth:sanctum');
    Route::apiResource('animalposts', AnimalPostsController::class)->middleware('auth:sanctum');
    Route::apiResource('postfiles', PostFilesController::class)->middleware('auth:sanctum');
    Route::apiResource('vaccineanimals', VaccineAnimalsController::class)->middleware('auth:sanctum');
    Route::apiResource('vaccineanimals', VaccineAnimalsController::class)->middleware('auth:sanctum');



    //User
    //Route::apiResource('users', UserController::class) ;//remover esta rota depois, apenas para teste de autenticação
    Route::get('usermyprofile',   [UserProfileController::class, 'myprofile'])->middleware('auth:sanctum');

    //verificafa permissões
    Route::get('usermyhabilitys', [UserProfileHabilityController::class, 'myhabilitys'])->middleware('auth:sanctum');
    Route::apiResource('usersactivations', UserActivationController::class);


    Route::post('user', [UserController::class, 'store']); //Cria novo usuário dentro do plano atual
    Route::post('register', [RegisterController::class, 'create']); //Resgistrando novo usuário


});
