<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('chat')->group(function () {
    Route::get('/', [ChatController::class, 'getUserChats']);
    Route::get('{chatId}/messages', [ChatController::class, 'getChatMessages']);
    Route::post('send', [ChatController::class, 'sendMessage']);
    Route::post('{chatId}/read', [ChatController::class, 'markAsRead']);
});
