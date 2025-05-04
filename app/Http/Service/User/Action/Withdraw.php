<?php

namespace App\Http\Service\User\Action;

use App\Models\User;

class Withdraw
{
    protected User $user;

    public function __construct(
        User $user,
    ) {
        $this->user = $user;
    }

    public function create(array $data)
    {
        try {
            $withdraw = $this->user->withdraws()->create($data);
            if ($withdraw) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
}