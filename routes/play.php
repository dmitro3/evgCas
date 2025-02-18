<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'play'], function () {
    Route::get('/mines', function () {
        return Inertia::render('OriginalGames/Mines');
    });
});

