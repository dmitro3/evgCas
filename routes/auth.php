<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/register', function () {
    return Inertia::render('Auth/Register');
  });
  
  Route::get('/login', function () {
    return Inertia::render('Auth/Login');
  });
  