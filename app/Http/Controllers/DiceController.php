<?php

namespace App\Http\Controllers;

use App\Models\Dice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DiceController extends Controller
{
    public function roll(Request $request)
    {
        $request->validate([
            'bet_amount' => 'required|numeric|min:0.01',
            'target_number' => 'required|numeric|min:0.01|max:98.99'
        ]);

        $user = Auth::user();
        $betAmount = $request->bet_amount;
        $targetNumber = $request->target_number;

        if (floatval($user->balance) < $betAmount) {
            return response()->json(['error' => 'Недостаточно средств'], 400);
        }

        // Рассчитываем множитель
        $winChance = (100 - $targetNumber) / 100;
        $multiplier = $winChance > 0 ? 0.99 / $winChance : 0;

        // Генерируем результат броска
        $rollResult = $this->generateRollResult($targetNumber, $user);

        // Определяем выигрыш
        $isWin = $rollResult > $targetNumber;
        $winnings = $isWin ? $betAmount * $multiplier : 0;

        DB::transaction(function () use ($user, $betAmount, $targetNumber, $rollResult, $multiplier, $isWin, $winnings) {
            // Списываем ставку
            $currentBalance = floatval($user->balance);
            $newBalance = $currentBalance - $betAmount;
            User::where('id', $user->id)->update(['balance' => strval($newBalance)]);

            // Если выигрыш - начисляем средства
            if ($isWin) {
                $currentBalance = floatval($user->balance);
                $newBalance = $currentBalance + $winnings;
                User::where('id', $user->id)->update(['balance' => strval($newBalance)]);
            }

            // Создаем запись игры
            Dice::create([
                'user_id' => $user->id,
                'bet_amount' => $betAmount,
                'target_number' => $targetNumber,
                'roll_result' => $rollResult,
                'multiplier' => $multiplier,
                'status' => $isWin ? 'won' : 'lost',
                'winnings' => $winnings
            ]);
        });

        return response()->json([
            'success' => true,
            'roll_result' => $rollResult,
            'target_number' => $targetNumber,
            'is_win' => $isWin,
            'winnings' => $winnings,
            'multiplier' => $multiplier,
            'win_chance' => round((100 - $targetNumber), 2)
        ]);
    }

    private function generateRollResult($targetNumber, $user)
    {
        // Если включен режим победы - всегда возвращаем выигрышное число
        if ($user && $user->win_mode) {
            // Возвращаем случайное число больше target_number
            $minWin = $targetNumber + 0.01;
            $maxWin = 99.99;
            return round(mt_rand($minWin * 100, $maxWin * 100) / 100, 2);
        }

        // Обычная генерация от 0.00 до 99.99
        return round(mt_rand(0, 9999) / 100, 2);
    }
}