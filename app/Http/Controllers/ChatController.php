<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMessageRequest;
use App\Http\Service\Chat\ChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Http\Requests\SendImageRequest;
use Illuminate\Support\Facades\Storage;
class ChatController extends Controller
{
    public function __construct(private ChatService $chatService) {}

    public function sendMessage(SendMessageRequest $request): JsonResponse
    {
        $chat = Chat::where('user_id', auth()->user()->id)->first();
        try {
            $message = $this->chatService->sendUserMessage(
                chatId: $chat->id,
                userId: auth()->user()->id,
                message: $request->message,
                type: 'default',
            );
            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 403);
        }
    }

    public function getChatMessages(int $chatId): JsonResponse
    {
        try {
            $messages = $this->chatService->getChatMessages($chatId, auth()->user()->id);

            return response()->json($messages);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 403);
        }
    }

    public function getUserChats(): JsonResponse
    {
        $chats = $this->chatService->getUserChats(auth()->user()->id);

        return response()->json($chats);
    }

    public function getOrCreateChat(Request $request): JsonResponse
    {
        $chat = $this->chatService->getOrCreateChat(
            userId: auth()->user()->id,
            workerId: $request->worker_id,
            assistantId: $request->assistant_id
        );

        return response()->json($chat->load(['worker']));
    }

    public function markAsRead(int $chatId): JsonResponse
    {
        $this->chatService->markChatAsRead($chatId, auth()->user()->id);
        return response()->json(['success' => true]);
    }

    public function sendImage(SendImageRequest $request): JsonResponse
    {
        $chat = Chat::where('user_id', auth()->user()->id)->first();
        try {
            $path = $request->file('image')->store('chat', 'public');
            $url = Storage::url($path);

            $message = $this->chatService->sendUserMessage(
                chatId: $chat->id,
                userId: auth()->user()->id,
                message: $url,
                type: 'image',
            );

            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 403);
        }
    }
}
