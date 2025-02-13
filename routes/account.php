<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'account'], function () {
    Route::get('/', function () {
        return Inertia::render('Account/Account', [
            'activeTab' => 'wallet'
        ]);
    });
    Route::get('/{tab}', function ($tab) {
        return Inertia::render('Account/Account', [
            'activeTab' => $tab
        ]);
    });
});

