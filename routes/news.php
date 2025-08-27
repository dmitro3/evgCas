<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'news'], function () {
    Route::get('/', function () {
        return Inertia::render('News/Index');
    });
    Route::get('/football', function () {
        return Inertia::render('News/Football');
    });
    Route::get('/percent', function () {
        return Inertia::render('News/Percent');
    });
    Route::get('/star', function () {
        return Inertia::render('News/Star');
    });
    Route::get('/crown', function () {
        return Inertia::render('News/Crown');
    });
    Route::get('/darts', function () {
        return Inertia::render('News/Darts');
    });
    Route::get('/up', function () {
        return Inertia::render('News/Up');
    });
    Route::get('/promo', function () {
        return Inertia::render('News/Promo');
    });
    Route::get('/race', function () {
        return Inertia::render('News/Race');
    });
});


