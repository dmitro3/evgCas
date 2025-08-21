<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\System\Promo\ExistPromo;
use App\Http\Service\User\Action\Deposit;
use App\Models\User;
use App\Models\Win;

class SystemController extends Controller
{
    public function checkPromo(Request $request)
    {
        return response()->json([
            'exist' => (new ExistPromo())->existPromo($request->promo),
        ], 200);
    }

    public function westWalletIpn(Request $request)
    {
        $id_transaction = $request->id;
        $amount = $request->amount;
        $user_id = $request->label;
        $currency = $request->currency;
        $status = $request->status;

        $ip_ipn = $request->ip();

        // if ($ip_ipn !== '5.188.51.47') {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Invalid IP address for IPN'
        //     ], 403);
        // }

        $user = User::find($user_id);

        if(!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        if($status == "completed") {
            (new Deposit())->deposit($user, $amount, $currency, $id_transaction);
            return response()->json([
                'success' => true,
                'message' => 'Deposit completed'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'Wait for confirmation'
        ], 200);
    }

    public function lastWins(Request $request)
    {
        $wins = Win::with('game')
            ->orderBy('created_at', 'desc')
            ->limit(15)
            ->get();
        return response()->json($wins);
    }
}