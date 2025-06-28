<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MineController;
use App\Http\Controllers\TowerController;
use Inertia\Inertia;

Route::group(['prefix' => 'games'], function () {
    Route::get('/mines', function () {
        return Inertia::render('OriginalGames/Mines');
    });
    Route::get('/tower', function () {
        return Inertia::render('OriginalGames/Tower');
    });

});

Route::middleware('auth')->prefix('api/mines')->group(function () {
    Route::post('/create', [MineController::class, 'createGame']);
    Route::post('/reveal', [MineController::class, 'revealCell']);
    Route::post('/cashout', [MineController::class, 'cashout']);
});

Route::middleware('auth')->prefix('api/tower')->group(function () {
    Route::post('/create', [TowerController::class, 'createGame']);
    Route::post('/reveal', [TowerController::class, 'revealCell']);
    Route::post('/cashout', [TowerController::class, 'cashout']);
    Route::get('/active', [TowerController::class, 'getActiveGame']);
});

