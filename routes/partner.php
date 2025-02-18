<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'partner'], function () {
    Route::get('/football', function () {
        return Inertia::render('Partner/Football');
    });
    Route::get('/huobi', function () {
        return Inertia::render('Partner/Huobi');
    });
    Route::get('/nba', function () {
        return Inertia::render('Partner/NBA');
    });
    Route::get('/nascar', function () {
        return Inertia::render('Partner/Nascar');
    });
    Route::get('/bjk', function () {
        return Inertia::render('Partner/bjk');
    });
});

