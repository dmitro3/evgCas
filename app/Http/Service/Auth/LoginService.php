<?php

namespace App\Http\Service\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\Assistant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Service\System\GetUserIp;
use Illuminate\Http\Request;
use App\Http\Service\Chat\ChatService;
class LoginService
{
    public function login(LoginRequest $request)
    {
        $request->authenticate();
        if($request->user()->banned){
            return response()->json([
                'message' => 'User is banned',
            ], 403);
        }
        $assistant = Assistant::first();
        (new ChatService())->getOrCreateChat($request->user()->id, $request->user()->worker_id, $assistant->id);

        return response()->json([
            'message' => 'User logged in successfully',
            'user' => $request->user()
        ], 201);
    }

    public function logout(Request $request)
    {

        auth()->guard('web')->logout();
        $request->session()->invalidate();

        return redirect()->route('main');
    }
}