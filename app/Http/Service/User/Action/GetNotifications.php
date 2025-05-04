<?php
namespace App\Http\Service\User\Action;

class GetNotifications
{
    public function get()
    {
        $user          = auth()->user();
        $notifications = $user->notifications()->orderBy('created_at', 'desc')->get();
        return $notifications;
    }
}
