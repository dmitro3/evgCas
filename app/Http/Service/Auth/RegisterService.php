<?php
namespace App\Http\Service\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Service\System\GetUserCountry;
use App\Http\Service\System\Promo\ExistPromo;
use App\Http\Service\User\Action\ActivePromo;
use App\Http\Service\User\Action\SendNotification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    public function register(RegisterRequest $request)
    {
        try {
            // $ipInfo = (new GetUserCountry())->getUserCountry();
            $ipInfo = (new GetUserCountry())->getUserCountry("91.239.23.209");

            $user = User::create([
                'email'           => $request->email,
                'password'        => Hash::make($request->password),
                'country_info'    => $ipInfo,
                'registration_ip' => $ipInfo['ip'],
            ]);

            Auth::login($user);
            $promo = $request->promocode;
            if ($promo && (new ExistPromo())->existPromo($promo)) {
                (new ActivePromo())->activePromo($promo);
            }

            (new SendNotification())->sendNotification($user->id, 'Welcome to our platform', 'You have successfully registered on our platform', 'bonus');

            return response()->json([
                'message' => 'User registered successfully',
                'user'    => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User registration failed',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
