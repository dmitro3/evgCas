<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Service\System\GetUserIp;
use App\Http\Service\Auth\LoginService;
use App\Http\Service\Auth\RegisterService;
use App\Http\Requests\Auth\LoginRequest;
use Inertia\Inertia;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        return Inertia::render('Auth/Login');
    }
    public function register(Request $request)
    {
        return Inertia::render('Auth/Register');
    }
    public function registerStore(RegisterRequest $request)
    {
        return (new RegisterService())->register($request);
    }

    public function loginStore(LoginRequest $request)
    {
        return (new LoginService())->login($request);
    }

    public function logout(Request $request)
    {
        return (new LoginService())->logout($request);
    }
}
