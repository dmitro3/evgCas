<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
  return Inertia::render('Main');
})->name('main');
Route::get('/games', function () {
  return Inertia::render('PlayPage');
})->name('games');
Route::get('/vip', function () {
  return Inertia::render('Account/Vip');
});

include __DIR__ . '/auth.php';
include __DIR__ . '/account.php';
include __DIR__ . '/news.php';
include __DIR__ . '/partner.php';
include __DIR__ . '/play.php';
include __DIR__ . '/system.php';