<?php

use App\Http\Service\System\Westwallet\GenerateWallet;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use App\Models\Slot;
use App\Models\Rank;
Route::get('/', function () {
    return Inertia::render('Main');
})->name('main');

Route::get('/vip', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    return Inertia::render('Account/Vip', [
        'ranks' => $user->current_ranks,
        'userXp' => $user->xp ?? 0,
        'vipProgress' => $user->vip_progress,
    ]);
})->middleware('auth');

Route::get('/test', function () {
    $generateWallet = new GenerateWallet();
    $address        = $generateWallet->generateWallet("BTC");
    return response()->json($address);
});

Route::get('/checkbox-demo', function () {
    return Inertia::render('CheckboxDemo');
})->name('checkbox.demo');

include __DIR__ . '/auth.php';
include __DIR__ . '/account.php';
include __DIR__ . '/news.php';
include __DIR__ . '/partner.php';
include __DIR__ . '/play.php';
include __DIR__ . '/slot.php';
include __DIR__ . '/chat.php';
include __DIR__ . '/system.php';
include __DIR__ . '/games.php';
include __DIR__ . '/pages.php';