<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

Route::group(['prefix' => 'account', 'middleware' => 'auth'], function () {
    Route::get('/', [AccountController::class, 'index']);
    Route::get('/{tab}', [AccountController::class, 'showTab']);

    Route::post('/withdraw/create', [AccountController::class, 'createWithdraw'])->name('account.withdraw.create');
    Route::get('/profile/get', [AccountController::class, 'getProfile'])->name('account.profile.get');
    Route::post('/kyc/create', [AccountController::class, 'createKycApplication'])->name('account.kyc.create');
    Route::put('/password/update', [AccountController::class, 'updatePassword'])->name('account.password.update');
    Route::post('/promo/activate', [AccountController::class, 'activatePromo'])->name('account.promo.activate');
    Route::get('/notifications/get', [AccountController::class, 'getNotifications'])->name('account.notifications');
    Route::post('/notifications/read', [AccountController::class, 'readNotifications'])->name('account.notifications.read');
    Route::get('/wins/get', [AccountController::class, 'getWins'])->name('account.wins.get');
});