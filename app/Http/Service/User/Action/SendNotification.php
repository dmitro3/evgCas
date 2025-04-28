<?php
namespace App\Http\Service\User\Action;

use App\Models\Notification;
use Illuminate\Support\Facades\Log;

class SendNotification
{
    public function sendNotification(int $userId, string $title, string $message, string $type)
    {
        try {
            Notification::create([
                'user_id' => $userId,
                'title'   => $title,
                'message' => $message,
                'type'    => $type,
            ]);
            return true;
        } catch (\Exception $e) {
            Log::error('Error sending notification: ' . $e->getMessage());
            return false;
        }
    }
}
