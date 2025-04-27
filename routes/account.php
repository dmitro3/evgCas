<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Service\User\Get\GetUser;


Route::group(['prefix' => 'account', 'middleware' => 'auth'], function () {

    Route::get('/', function () {
        return Inertia::render('Account/Account', [
            'activeTab' => 'wallet'
        ]);
    });
    Route::get('/{tab}', function ($tab) {
        return Inertia::render('Account/Account', [
            'activeTab' => $tab
        ]);
    });



    Route::get('/profile/get', function () {
        return (new GetUser())->getUser();
    });
});

