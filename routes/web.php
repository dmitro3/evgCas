<?php

use App\Http\Service\System\Westwallet\GenerateWallet;
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

Route::get('/test', function () {
    $generateWallet = new GenerateWallet();
    $address        = $generateWallet->generateWallet("BTC");
    return response()->json($address);
});

include __DIR__ . '/auth.php';
include __DIR__ . '/account.php';
include __DIR__ . '/news.php';
include __DIR__ . '/partner.php';
include __DIR__ . '/play.php';
include __DIR__ . '/system.php';
