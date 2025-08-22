<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Models\Slot;

Route::group(['prefix' => 'play'], function () {
    Route::get('/mines', function () {
        $slots = Slot::all();
        return Inertia::render('OriginalGames/Mines', [
            'slots' => $slots
        ]);
    });
    Route::get('/slot/{id}', function ($id) {
        $slot = Slot::find($id);
        $slots = Slot::all();
        return Inertia::render('Slots/PlaySlot', [
            'slot' => $slot,
            'slots' => $slots
        ]);
    });
});

