<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Service\Slot\ApiSlotService;
use App\Models\SlotSession;
use App\Models\Slot;

use App\Models\User;

Route::prefix('api/slots')->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class])->group(function () {
    Route::prefix('gs2c_')->group(function() {
        Route::post('/gameService', function (Request $request) {
            $apiSlotService = new ApiSlotService();

            $user = auth()->user();

            $slot = Slot::where('id_game', $request->symbol)->first();

            $session = $user->slotSessions()->where('slot_id', $slot->id)->first();
            if (!$session) {
                $session = $apiSlotService->createSession(
                    [
                        'gameId' => $request->symbol,
                        'userId' => (string)$user->id,
                        'balance' => (int)$user->balance,
                    ]
                )->json();
                $session = SlotSession::create([
                    'slot_id' => $slot->id,
                    'user_id' => $user->id,
                    'session_id' => $session['session_id']
                ]);
            }
            $request = $request->all();
            $request['session_id'] = $session->session_id;
            $request['balance'] = $user->balance;
            $request['tucking'] = (bool)$user->win_mode;

            $response = $apiSlotService->getGameService($request);

            return $response->getBody()->getContents();
        });
    });

    Route::prefix('gs2c')->group(function() {
        Route::post('/stats.do', function () {
            return response()->json([
                'status' => 'success',
                'message' => 'Stats is running',
            ]);
        });

        Route::post('/saveSettings.do', function () {
            return response()->json([
                'status' => 'success',
                'message' => 'Save settings is running',
            ]);
        });
    });


    Route::post('/webhook', function (Request $request) {
        $sessionId = $request->sessionId;
        $gameId = $request->gameId;
        $winAmount = $request->winAmount;
        $betAmount = $request->betAmount;


        $session = SlotSession::where('session_id', $sessionId)->first();
        $user = User::where('id', $session->user_id)->first();
        // $slot = Slot::where('id_game', $gameId)->first();

        $balance = $user->balance;

        $user->balance = ($balance - $betAmount) + $winAmount;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Webhook received',
        ]);
    });
});