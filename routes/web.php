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


include __DIR__ . '/auth.php';
include __DIR__ . '/account.php';