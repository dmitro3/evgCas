<?php

namespace App\Http\Service\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Service\System\GetUserIp;
class LoginService
{
    public function login(LoginRequest $request)
    {   
        $request->authenticate();

        $token = $request->user()->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User logged in successfully',
            'token' => $token,
            'user' => $request->user()
        ]);
    }
}