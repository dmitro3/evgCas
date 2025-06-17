<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Models\Slot;

Route::group(['prefix' => 'play'], function () {
    Route::get('/mines', function () {
        return Inertia::render('OriginalGames/Mines');
    });
    Route::get('/slot/{id}', function ($id) {
        $slot = Slot::find($id);
        return Inertia::render('Slots/PlaySlot', [
            'slot' => $slot
        ]);
    });
});

