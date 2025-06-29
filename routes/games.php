<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MineController;
use App\Http\Controllers\TowerController;
use App\Http\Controllers\DiceController;
use App\Http\Controllers\CoinFlipController;
use Inertia\Inertia;

Route::group(['prefix' => 'games'], function () {
    Route::get('/mines', function () {
        return Inertia::render('OriginalGames/Mines');
    });
    Route::get('/tower', function () {
        return Inertia::render('OriginalGames/Tower');
    });
    Route::get('/dice', function () {
        return Inertia::render('OriginalGames/Dice');
    });
    Route::get('/coin-flip', function () {
        return Inertia::render('OriginalGames/CoinFlip');
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

Route::middleware('auth')->prefix('api/dice')->group(function () {
    Route::post('/roll', [DiceController::class, 'roll']);
});

Route::middleware('auth')->prefix('api/coinflip')->group(function () {
    Route::post('/flip', [CoinFlipController::class, 'flip']);
    Route::get('/series', [CoinFlipController::class, 'getCurrentSeries']);
});

