<?php

namespace App\Http\Service\User\Action;

class ReadNotifications
{
    public function read()
    {
        try {
            $user = auth()->user();
            $user->notifications()->update(['is_read' => true]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
