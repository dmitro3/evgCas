<?php

namespace App\Http\Service\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Service\System\GetUserIp;
use Illuminate\Http\Request;
class LoginService
{
    public function login(LoginRequest $request)
    {   
        $request->authenticate();


        return response()->json([
            'message' => 'User logged in successfully',
            'user' => $request->user()
        ]);
    }

    public function logout(Request $request)
    {
        
        auth()->guard('web')->logout();
        $request->session()->invalidate();
    
        return redirect()->route('main');
    }
}