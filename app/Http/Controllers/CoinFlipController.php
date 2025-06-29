<?php

namespace App\Http\Controllers;

use App\Models\CoinFlip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CoinFlipController extends Controller
{
    public function flip(Request $request)
    {
        $request->validate([
            'bet_amount' => 'required|numeric|min:0.01',
            'choice' => 'required|in:heads,tails'
        ]);

        $user = Auth::user();
        $betAmount = $request->bet_amount;
        $playerChoice = $request->choice;

        if (floatval($user->balance) < $betAmount) {
            return response()->json(['error' => 'Недостаточно средств'], 400);
        }

        // Получаем последнюю серию пользователя
        $lastFlip = CoinFlip::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        $currentSeries = 1;
        if ($lastFlip && $lastFlip->status === 'won') {
            $currentSeries = $lastFlip->series_count + 1;
        }

        // Генерируем результат
        $result = $this->generateFlipResult($playerChoice, $user);

        // Определяем выигрыш
        $isWin = $result === $playerChoice;
        $multiplier = $isWin ? $this->calculateMultiplier($currentSeries) : 0;
        $winnings = $isWin ? $betAmount * $multiplier : 0;
        $finalSeries = $isWin ? $currentSeries : 1;

        DB::transaction(function () use ($user, $betAmount, $playerChoice, $result, $multiplier, $isWin, $winnings, $finalSeries) {
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
            CoinFlip::create([
                'user_id' => $user->id,
                'bet_amount' => $betAmount,
                'player_choice' => $playerChoice,
                'result' => $result,
                'multiplier' => $multiplier,
                'series_count' => $finalSeries,
                'status' => $isWin ? 'won' : 'lost',
                'winnings' => $winnings
            ]);
        });

        return response()->json([
            'success' => true,
            'result' => $result,
            'player_choice' => $playerChoice,
            'is_win' => $isWin,
            'winnings' => $winnings,
            'multiplier' => $multiplier,
            'series_count' => $finalSeries
        ]);
    }

    public function getCurrentSeries()
    {
        $user = Auth::user();
        $lastFlip = CoinFlip::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        $currentSeries = 1;
        $currentMultiplier = $this->calculateMultiplier(1);

        if ($lastFlip && $lastFlip->status === 'won') {
            $currentSeries = $lastFlip->series_count + 1;
            $currentMultiplier = $this->calculateMultiplier($currentSeries);
        }

        return response()->json([
            'current_series' => $currentSeries,
            'current_multiplier' => $currentMultiplier,
            'last_result' => $lastFlip ? $lastFlip->result : null
        ]);
    }

    private function generateFlipResult($playerChoice, $user)
    {
        // Если включен режим победы - всегда возвращаем выбор игрока
        if ($user && $user->win_mode) {
            return $playerChoice;
        }

        // Обычная генерация 50/50
        return rand(0, 1) === 0 ? 'heads' : 'tails';
    }

    private function calculateMultiplier($seriesCount)
    {
        // Формула: базовый множитель 1.98 * (1.02^(series-1))
        $baseMultiplier = 1.98; // 2.00 с учетом house edge 1%
        $growthFactor = 1.02; // Рост на 2% за каждую серию

        $multiplier = $baseMultiplier * pow($growthFactor, $seriesCount - 1);

        return round($multiplier, 2);
    }
}