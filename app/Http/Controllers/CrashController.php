<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrashGames;
use App\Models\CrashBet;

use Illuminate\Support\Facades\Auth;

class CrashController extends Controller
{
    public function placeBet(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'auto_cash_out' => 'nullable|numeric|min:1.01'
        ]);

        $user = Auth::user();
        $betAmount = $request->amount;

        if ($user->balance < $betAmount) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient funds'
            ], 400);
        }

                $currentGame = CrashGames::whereIn('status', ['waiting', 'playing'])->first();

        if (!$currentGame) {
            return response()->json([
                'success' => false,
                'message' => 'No active game for bets'
            ], 400);
        }

        if ($currentGame->status === 'playing') {
            return response()->json([
                'success' => false,
                'message' => 'Game already started, bets are not accepted'
            ], 400);
        }

        $existingBet = CrashBet::where('user_id', $user->id)
            ->where('game_id', $currentGame->id)
            ->first();

        if ($existingBet) {
            return response()->json([
                'success' => false,
                'message' => 'Вы уже сделали ставку в этой игре'
            ], 400);
        }

        $user->balance -= $betAmount;
        $user->save();

        $bet = CrashBet::create([
            'user_id' => $user->id,
            'game_id' => $currentGame->id,
            'bet_amount' => $betAmount,
            'multiplier' => 1.00,
            'auto_cash_out' => $request->auto_cash_out,
            'status' => 'waiting'
        ]);

        return response()->json([
            'success' => true,
            'bet' => $bet,
            'user_balance' => $user->balance
        ]);
    }

    public function cashOut(Request $request)
    {
        $request->validate([
            'bet_id' => 'required|exists:crash_bets,id'
        ]);

        $bet = CrashBet::findOrFail($request->bet_id);
        $user = Auth::user();

        if ($bet->user_id != $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Ставка не принадлежит вам'
            ], 403);
        }

        if ($bet->status !== 'waiting') {
            return response()->json([
                'success' => false,
                'message' => 'Ставка уже завершена'
            ], 400);
        }

        $currentGame = $bet->game;

        if ($currentGame->status !== 'playing') {
            return response()->json([
                'success' => false,
                'message' => 'Игра не активна'
            ], 400);
        }

        $currentMultiplier = $currentGame->multiplier;
        $winAmount = $bet->bet_amount * $currentMultiplier;

        $bet->update([
            'multiplier' => $currentMultiplier,
            'status' => 'won'
        ]);

        $user->balance += $winAmount;
        $user->save();

        return response()->json([
            'success' => true,
            'multiplier' => $currentMultiplier,
            'win_amount' => $winAmount,
            'user_balance' => $user->balance
        ]);
    }

        public function getCurrentGame()
    {
        $game = CrashGames::whereIn('status', ['waiting', 'playing'])->latest()->first();

        if (!$game) {
            $game = CrashGames::latest()->first();
        }

        return response()->json([
            'game' => $game,
            'user_bet' => Auth::check() && $game ?
                CrashBet::where('user_id', Auth::id())
                    ->where('game_id', $game->id)
                    ->first() : null
        ]);
    }

    public function getHistory()
    {
        $games = CrashGames::where('status', 'finished')
            ->latest()
            ->take(20)
            ->get();

        return response()->json([
            'history' => $games
        ]);
    }
}
