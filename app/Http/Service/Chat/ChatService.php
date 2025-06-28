<?php

namespace App\Http\Service\Chat;

use App\Events\MessageSent;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

class ChatService
{
    public function sendUserMessage(int $chatId, int $userId, string $message, string $type, ?int $ruleId = null): Message
    {
        $chat = Chat::findOrFail($chatId);

        if (!$this->userHasAccessToChat($userId, $chat)) {
            throw new \Exception('Нет доступа к этому чату');
        }

        $messageModel = Message::create([
            'chat_id' => $chatId,
            'user_id' => $userId,
            'message' => trim($message),
            'type' => $type,
            'rule_id' => $ruleId,
        ]);


        event(new MessageSent($messageModel->load(['user', 'assistant'])));
        return $messageModel;
    }

    public function sendAssistantMessage(int $chatId, int $assistantId, string $message, ?int $ruleId = null): Message
    {
        $messageModel = Message::create([
            'chat_id' => $chatId,
            'assistant_id' => $assistantId,
            'message' => trim($message),
            'type' => 'assistant',
            'rule_id' => $ruleId,
        ]);

        event(new MessageSent($messageModel));
        return $messageModel;
    }

    public function sendWorkerMessage(int $chatId, string $message, ?int $ruleId = null): Message
    {
        $messageModel = Message::create([
            'chat_id' => $chatId,
            'message' => trim($message),
            'type' => 'worker',
            'rule_id' => $ruleId,
        ]);

        event(new MessageSent($messageModel));

        return $messageModel;
    }

    public function getChatMessages(int $chatId, int $userId, int $limit = 50): Collection
    {
        $chat = Chat::findOrFail($chatId);

        if (!$this->userHasAccessToChat($userId, $chat)) {
            throw new \Exception('Нет доступа к этому чату');
        }

        return $chat->messages()
            ->with(['user', 'assistant'])
            ->latest()
            ->limit($limit)
            ->get()
            ->reverse()
            ->values();
    }

    public function getUserChats(int $userId): Collection
    {
        return Chat::where('user_id', $userId)
            ->with(['messages' => function($query) {
                $query->latest()->limit(1);
            }, 'worker', 'assistant'])
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function getOrCreateChat(int $userId, ?int $workerId = null, ?int $assistantId = null): Chat
    {
        $chat = Chat::where('user_id', $userId)
            ->where('worker_id', $workerId)
            ->first();

        if (!$chat) {
            $chat = Chat::create([
                'user_id' => $userId,
                'worker_id' => $workerId,
                'assistant_id' => $assistantId,
                'status' => 'active',
            ]);
        }

        return $chat;
    }

    private function userHasAccessToChat(int $userId, Chat $chat): bool
    {
        return $chat->user_id === $userId ||
               $chat->worker_id === $userId;
    }

    public function markChatAsRead(int $chatId, int $userId): void
    {
        // Здесь можно добавить логику для отметки сообщений как прочитанных
    }
}
