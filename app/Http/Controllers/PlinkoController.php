<?php

namespace App\Http\Controllers;

use App\Models\PlinkoPosition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlinkoController extends Controller
{
    public function placeBet(Request $request)
    {
        $request->validate([
            'bet_amount' => 'required|numeric|min:0.01',
            'rows' => 'required|integer|min:8|max:16'
        ]);

        $user = Auth::user();
        $betAmount = floatval($request->bet_amount);
        $rows = $request->rows;

        if (floatval($user->balance) < $betAmount) {
            return response()->json([
                'success' => false,
                'error' => 'Недостаточно средств'
            ], 400);
        }

        $currentBalance = floatval($user->balance);
        $newBalance = $currentBalance - $betAmount;
        User::where('id', $user->id)->update(['balance' => strval($newBalance)]);

        $baseGap = 32;
        $gapMultiplier = max(1, (16 - $rows) * 0.06 + 1);
        $GAP = round($baseGap * $gapMultiplier);

        $startPositionX = PlinkoPosition::where('rows', $rows)
            ->inRandomOrder()
            ->first();


        return response()->json([
            'success' => true,
            'start_position_x' => (float)$startPositionX->start_position_x,
            'bet_amount' => $betAmount,
            'multiplier' => $startPositionX->multiplier,
            'new_balance' => $newBalance,
            'rows' => $rows,
            'gap' => $GAP,
            'message' => 'Ставка размещена'
        ]);
    }

    public function payout(Request $request)
    {
        $request->validate([
            'position_x' => 'required|numeric',
            'start_position_x' => 'required|numeric',
            'bucket_index' => 'required|integer|min:0',
            'multiplier' => 'required|numeric',
            'rows' => 'required|integer|min:8|max:16',
            'bet_amount' => 'required|numeric|min:0.01'
        ]);

        $user = Auth::user();
        $multiplier = floatval($request->multiplier);
        $betAmount = floatval($request->bet_amount);
        $winAmount = $betAmount * $multiplier;

        $currentBalance = floatval($user->balance);
        $newBalance = $currentBalance + $winAmount;
        User::where('id', $user->id)->update(['balance' => strval($newBalance)]);

        try {
            $existingPosition = PlinkoPosition::where('bucket_index', $request->bucket_index)
                ->where('rows', $request->rows)
                ->first();

            if (!$existingPosition) {
                $position = PlinkoPosition::create([
                    'position_x' => $request->position_x,
                    'start_position_x' => $request->start_position_x,
                    'bucket_index' => $request->bucket_index,
                    'multiplier' => $request->multiplier,
                    'rows' => $request->rows
                ]);
                $positionId = $position->id;
            } else {
                $positionId = $existingPosition->id;
            }

            return response()->json([
                'success' => true,
                'win_amount' => $winAmount,
                'new_balance' => $newBalance,
                'multiplier' => $multiplier,
                'position_id' => $positionId,
                'message' => 'Выплата произведена'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Ошибка записи в базу данных'
            ], 500);
        }
    }

    public function recordPosition(Request $request)
    {
        $request->validate([
            'position_x' => 'required|numeric',
            'bucket_index' => 'required|integer|min:0',
            'multiplier' => 'required|numeric',
            'rows' => 'required|integer|min:8|max:16'
        ]);

        try {
            $position = PlinkoPosition::create([
                'position_x' => $request->position_x,
                'bucket_index' => $request->bucket_index,
                'multiplier' => $request->multiplier,
                'rows' => $request->rows
            ]);

            return response()->json([
                'success' => true,
                'position_id' => $position->id,
                'message' => 'Позиция записана'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Ошибка записи в базу данных'
            ], 500);
        }
    }

    public function getLastPositions()
    {
        $positions = PlinkoPosition::orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return response()->json([
            'positions' => $positions
        ]);
    }

    public function getBalance()
    {
        $user = Auth::user();
        return response()->json([
            'balance' => floatval($user->balance)
        ]);
    }
}