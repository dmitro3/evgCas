<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'news'], function () {
    Route::get('/', function () {
        return Inertia::render('News/Index');
    });
});


