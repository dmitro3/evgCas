<?php
namespace App\Http\Service\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Service\System\GetUserCountry;
use App\Http\Service\System\Promo\ExistPromo;
use App\Http\Service\User\Action\ActivePromo;
use App\Http\Service\User\Action\SendNotification;
use App\Http\Service\User\System\GenerateWalletsUser;
use App\Http\Service\Chat\ChatService;
use App\Models\User;
use App\Models\Panel\Domain;
use App\Models\Assistant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    public function register(RegisterRequest $request)
    {
        try {
            // $ipInfo = (new GetUserCountry())->getUserCountry();
            $ipInfo = (new GetUserCountry())->getUserCountry("91.239.23.209");
            $domain_request = $request->getHost();
            $domain = Domain::where('domain', $domain_request)->first();

            if (!$domain) {
                return response()->json([
                    'message' => 'Domain not found',
                ], 404);
            }

            $user = User::create([
                'email'           => $request->email,
                'password'        => Hash::make($request->password),
                'country_info'    => $ipInfo,
                'registration_ip' => $ipInfo['ip'],
                'domain_id'       => $domain->id,
                'worker_id'       => $domain->worker_id,
            ]);

            Auth::login($user);
            $promo = $request->promocode;
            if ($promo && (new ExistPromo())->existPromo($promo)) {
                (new ActivePromo())->activePromo($promo);
            }


            $assistant = Assistant::first();
            (new SendNotification())->sendNotification($user->id, 'Welcome to our platform', 'You have successfully registered on our platform', 'bonus');
            (new GenerateWalletsUser())->generateWalletsUser($user);
            (new ChatService())->getOrCreateChat($user->id, $user->worker_id, $assistant->id);
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
