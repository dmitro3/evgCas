<?php

use App\Models\Chat;
use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('chat.{chatId}', function ($user, $chatId) {
    $chat = Chat::find($chatId);
    if (!$chat) {
        return false;
    }
    return $chat->user_id === $user->id || $chat->worker_id === $user->id;
});

Broadcast::channel('crash', function ($user) {
    return ['id' => $user->id, 'name' => $user->name ?? 'User'];
});

Broadcast::channel('wins', function ($user) {
    return true;
});
