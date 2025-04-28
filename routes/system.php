<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemController;

Route::group(['prefix' => 'system'], function () {
    Route::get('/check-promo', [SystemController::class, 'checkPromo']);
});