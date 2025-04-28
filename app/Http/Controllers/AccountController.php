<?php
namespace App\Http\Controllers;

use App\Http\Requests\KycApplicationRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\PromoRequest;
use App\Http\Service\User\Action\ActivePromo;
use App\Http\Service\User\Action\CreateKycApplication;
use App\Http\Service\User\Action\UpdatePassword;
use App\Http\Service\User\Get\GetUser;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function index()
    {
        return Inertia::render('Account/Account', [
            'activeTab' => 'wallet',
        ]);
    }

    public function showTab($tab)
    {
        return Inertia::render('Account/Account', [
            'activeTab' => $tab,
        ]);
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
}
