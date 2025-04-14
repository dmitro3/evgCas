<?php

namespace App\Http\Service\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Service\System\GetUserCountry;

class RegisterService
{
    public function register(RegisterRequest $request)
    {
        try {
            // $ipInfo = (new GetUserCountry())->getUserCountry();
            $ipInfo = (new GetUserCountry())->getUserCountry("91.239.23.209");

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'country_info' => $ipInfo,
                'registration_ip' => $ipInfo['ip'],
                'country_info' => $ipInfo['country'],
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'User registered successfully',
                'token' => $token,
                'user' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
