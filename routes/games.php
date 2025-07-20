<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MineController;
use App\Http\Controllers\TowerController;
use App\Http\Controllers\DiceController;
use Illuminate\Http\Request;
use App\Http\Controllers\CoinFlipController;
use App\Http\Controllers\PlinkoController;
use Inertia\Inertia;
use App\Models\Slot;

Route::group(['prefix' => 'games'], function () {
    Route::get('/', function (Request $request) {
        if($request->type){
            $slots = Slot::where('type', $request->type)->get();
        }else{
            $slots = Slot::all();
        }
        return Inertia::render('PlayPage', [
            'slots' => $slots
        ]);
    })->name('games');
    Route::get('/mines', function () {
        return Inertia::render('OriginalGames/Mines');
    });
    Route::get('/tower', function () {
        return Inertia::render('OriginalGames/Tower');
    });
    Route::get('/dice', function () {
        return Inertia::render('OriginalGames/Dice');
    });
    Route::get('/coinflip', function () {
        return Inertia::render('OriginalGames/CoinFlip');
    });
    Route::get('/plinko', function () {
        return Inertia::render('OriginalGames/Plinko');
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

Route::prefix('api/plinko')->group(function () {
    Route::post('/record-position', [PlinkoController::class, 'recordPosition']);
    Route::get('/positions', [PlinkoController::class, 'getLastPositions']);
});

