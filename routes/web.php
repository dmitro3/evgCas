<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
  return Inertia::render('Main');
});
Route::get('/games', function () {
  return Inertia::render('PlayPage');
});
Route::get('/vip', function () {
  return Inertia::render('Account/Vip');
});

include __DIR__ . '/auth.php';
include __DIR__ . '/account.php';
include __DIR__ . '/news.php';
