<?php
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/more/feedback', function() {
    return Inertia::render('Landing/Feedback');
} );

Route::get('/more/about', function() {
    return Inertia::render('Landing/About');
});



Route::get('/more/rules/{type}', function($type = 'privacy') {
    return Inertia::render('Landing/Rules', [
        'type' => $type
    ]);
});

Route::get('/more/licenses', function() {
    return Inertia::render('Landing/Licenses');
} );



