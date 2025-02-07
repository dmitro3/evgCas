<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
  return Inertia::render('Main');
});

Route::get('/register', function () {
  return Inertia::render('Auth/Register');
});

Route::get('/login', function () {
  return Inertia::render('Auth/Login');
});
