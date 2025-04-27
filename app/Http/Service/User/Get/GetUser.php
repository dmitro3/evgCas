<?php

namespace App\Http\Service\User\Get;

use Illuminate\Support\Facades\Auth;

class GetUser
{
    public function getUser()
    {
        return response()->json([
            'error' => false,
            'user' => Auth::user()
        ], 200);
    }
    
}
