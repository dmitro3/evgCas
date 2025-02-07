<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'account'], function () {
    Route::get('/vip', function () {
        return Inertia::render('Account/Vip');
    });
});

