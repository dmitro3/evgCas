<?php
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/more/feedback', function() {
    return Inertia::render('Landing/Feedback');
} );

Route::get('/more/about', function() {
    return Inertia::render('Landing/About');
});


Route::get('/more/licenses', function() {
    return Inertia::render('Landing/Licenses');
} );



