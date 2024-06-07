<?php

use Illuminate\Support\Facades\Route;


Route::middleware([\App\Http\Middleware\AuthMiddleware::class])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::prefix('/pasien')->group(function () {
        Route::get('/login', [\App\Http\Controllers\PasienController::class, 'login']);
        Route::post('/login', [\App\Http\Controllers\PasienController::class, 'doLogin']);

        Route::get('/register', [\App\Http\Controllers\PasienController::class, 'register']);
        Route::post('/register', [\App\Http\Controllers\PasienController::class, 'doRegister']);
    });
});
