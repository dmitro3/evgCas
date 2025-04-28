<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::group([ 'middleware' => 'guest'], function () {

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');

    Route::post('/register', [AuthController::class, 'registerStore']);
    Route::post('/login', [AuthController::class, 'loginStore']);

    
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
