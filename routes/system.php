<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

Route::group(['prefix' => 'system'], function () {
    Route::get('/check-promo', [SystemController::class, 'checkPromo']);
    Route::post('/west/ipn', [SystemController::class, 'westWalletIpn'])->withoutMiddleware(VerifyCsrfToken::class);
    Route::post('/last_wins', [SystemController::class, 'lastWins']);
});