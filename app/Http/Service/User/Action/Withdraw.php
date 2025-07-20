<?php

namespace App\Http\Service\User\Action;

use App\Models\User;
use App\Models\WithdrawUser;
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
            $withdraw = WithdrawUser::create([
                'user_id' => $this->user->id,
                'currency_id' => $data['currency_id'],
                'amount' => $data['amount'],
                'type' => $data['type'],
                'comment' => $data['comment'],
                'address' => $data['address'],
            ]);
            if ($withdraw) {
                $this->user->balance -= $data['amount'];
                $this->user->save();
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error create withdrawal', 'message' => $e->getMessage()], 500);
        }
    }
}