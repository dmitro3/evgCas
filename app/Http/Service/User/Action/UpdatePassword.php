<?php

namespace App\Http\Service\User\Action;

use App\Http\Requests\PasswordUpdateRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePassword
{
    public function update(PasswordUpdateRequest $request)
    {
        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'Password updated successfully'
        ], 200);
    }
}