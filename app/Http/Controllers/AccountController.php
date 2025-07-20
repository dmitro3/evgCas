<?php
namespace App\Http\Controllers;

use App\Http\Requests\KycApplicationRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\PromoRequest;
use App\Http\Service\User\Action\ActivePromo;
use App\Http\Service\User\Action\CreateKycApplication;
use App\Http\Service\User\Action\Withdraw as CreateWithdrawAction;
use App\Http\Requests\WithdrawRequest;
use App\Http\Service\User\Action\UpdatePassword;
use App\Http\Service\User\Get\GetUser;
use App\Http\Service\User\Action\GetNotifications;
use App\Http\Service\User\Action\ReadNotifications;
use App\Models\Panel\PaymentMethod;
use Inertia\Inertia;
use App\Models\UserWallet;

class AccountController extends Controller
{
    public function index()
    {
        return Inertia::render('Account/Account', [
            'activeTab' => 'wallet',
            'wallets' => UserWallet::with('currencies')
                ->where('user_id', auth()->user()->id)
                ->get()
                ->map(function ($wallet) {
                    return [
                        'id' => $wallet->id,
                        'symbol' => $wallet->currencies?->symbol ?? $wallet->currency,
                        'name' => $wallet->currencies?->name ?? $wallet->currency,
                        'address' => $wallet->address,
                        'network' => $wallet->currencies?->network ?? null,
                        'min_deposit' => $wallet->currencies?->min_deposit ?? 0,
                        'rate' => $wallet->currencies?->rate ?? 0,
                    ];
                }),
            'fiat_merchants' => PaymentMethod::where('is_active', true)->map(function ($merchant) {
                return [
                    'id' => $merchant->id,
                    'name' => $merchant->name,
                    'domain' => $merchant->domain,
                    'icon' => "/assets/images/icons/logos/" . strtolower($merchant->name) . ".svg",
                ];
            }),
        ]);
    }

    public function showTab($tab)
    {
        $data = ['activeTab' => $tab];

        if ($tab === 'wallet') {
            $data['fiat_merchants'] = PaymentMethod::where('is_active', true)->get()->map(function ($merchant) {
                return [
                    'id' => $merchant->id,
                    'name' => $merchant->name,
                    'domain' => $merchant->domain,
                    'icon' => "/assets/images/icons/logos/" . strtolower($merchant->name) . ".svg",
                ];
            });
            $data['wallets'] = UserWallet::with('currencies')
                ->where('user_id', auth()->user()->id)
                ->get()
                ->map(function ($wallet) {
                    return [
                        'id' => $wallet->id,
                        'symbol' => $wallet->currencies?->symbol ?? $wallet->currency,
                        'name' => $wallet->currencies?->name ?? $wallet->currency,
                        'address' => $wallet->address,
                        'network' => $wallet->currencies?->network ?? null,
                        'min_deposit' => $wallet->currencies?->min_deposit ?? 0,
                        'rate' => $wallet->currencies?->rate ?? 0,
                    ];
                });

        }
        return Inertia::render('Account/Account', $data);
    }

    public function getProfile()
    {
        return (new GetUser())->getUser();
    }

    public function createKycApplication(KycApplicationRequest $request)
    {
        return (new CreateKycApplication())->create($request);
    }

    public function updatePassword(PasswordUpdateRequest $request)
    {
        return (new UpdatePassword())->update($request);
    }

    public function activatePromo(PromoRequest $request)
    {
        $promo = $request->promo;
        if ((new ActivePromo())->activePromo($promo)) {
            return response()->json(data: [
                'actived' => true,
                'message' => 'Promo activated successfully',
                'promo'   => $promo,
            ]);
        } else {
            return response()->json([
                'actived' => false,
                'message' => 'Promo activation failed',
                'promo'   => $promo,
            ], 400);
        }
    }

    public function getNotifications()
    {
        return response()->json([
            'notifications' => (new GetNotifications())->get(),
        ]);
    }

    public function readNotifications()
    {
        return response()->json([
            'success' => (new ReadNotifications())->read(),
        ]);
    }

    public function createWithdraw(WithdrawRequest $request)
    {
        $user = auth()->user();
        return response()->json([
            'success' => (new CreateWithdrawAction($user))->create($request->all()),
        ]);
    }
}
