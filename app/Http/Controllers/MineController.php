<?php

namespace App\Http\Controllers;

use App\Models\Mine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MineController extends Controller
{
    public function createGame(Request $request)
    {
        $request->validate([
            'bet_amount' => 'required|numeric|min:0.01',
            'mines_count' => 'required|integer|min:1|max:18'
        ]);

        $user = Auth::user();
        $betAmount = $request->bet_amount;

        if (floatval($user->balance) < $betAmount) {
            return response()->json(['error' => 'Insufficient balance'], 400);
        }

        $currentBalance = floatval($user->balance);
        $newBalance = $currentBalance - $betAmount;
        User::where('id', $user->id)->update(['balance' => strval($newBalance)]);

        $playMap = $this->generatePlayMap($request->mines_count);

        $mine = Mine::create([
            'play_map' => json_encode($playMap),
            'bet_amount' => $betAmount,
            'mines_count' => $request->mines_count,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'game_id' => $mine->id,
            'gems_found' => 0,
            'multiplier' => 1,
            'can_cashout' => false,
            'game_over' => false,
            'revealed_cells' => []
        ]);
    }

    public function revealCell(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:mines,id',
            'cell_index' => 'required|integer|min:0|max:24'
        ]);

        $mine = Mine::findOrFail($request->game_id);

        if ($mine->user_id !== Auth::id()) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        $playMap = json_decode($mine->play_map, true);
        $cellIndex = $request->cell_index;

        if (isset($playMap['revealed'][$cellIndex])) {
            return response()->json(['error' => 'Cell already revealed'], 400);
        }

        $playMap['revealed'][$cellIndex] = true;

        $isMine = in_array($cellIndex, $playMap['mines']);
        $user = Auth::user();

        // Если пользователь с win_mode попал на мину - меняем поле
        if ($isMine && $user && $user->win_mode) {
            // Убираем мину с текущей позиции
            $playMap['mines'] = array_diff($playMap['mines'], [$cellIndex]);

            // Находим свободную ячейку для перемещения мины
            $freeCells = [];
            for ($i = 0; $i < 25; $i++) {
                if (!in_array($i, $playMap['mines']) && !isset($playMap['revealed'][$i]) && $i !== $cellIndex) {
                    $freeCells[] = $i;
                }
            }

            // Если есть свободные ячейки, перемещаем мину
            if (!empty($freeCells)) {
                $newMinePosition = $freeCells[array_rand($freeCells)];
                $playMap['mines'][] = $newMinePosition;
            }

            // Переиндексируем массив мин
            $playMap['mines'] = array_values($playMap['mines']);

            // Сохраняем измененную карту
            $mine->update(['play_map' => json_encode($playMap)]);

            // Теперь ячейка безопасная
            $isMine = false;
        }

        if ($isMine) {
            return response()->json([
                'game_over' => true,
                'hit_mine' => true,
                'revealed_cell' => $cellIndex,
                'mines_positions' => $playMap['mines'],
                'gems_found' => count($playMap['revealed']) - 1,
                'multiplier' => $this->calculateMultiplier(count($playMap['revealed']) - 1, $mine->mines_count)
            ]);
        }

        $gemsFound = count($playMap['revealed']);
        $multiplier = $this->calculateMultiplier($gemsFound, $mine->mines_count);

        $totalCells = 25;
        $safeCells = $totalCells - $mine->mines_count;

                // Сохраняем обновленную карту
        $mine->update(['play_map' => json_encode($playMap)]);

        // Проверяем если найдены все возможные гемы - автоматически завершаем игру с победой
        if ($gemsFound >= $safeCells) {
            $winAmount = $mine->bet_amount * $multiplier;

            $user = Auth::user();
            $currentBalance = floatval($user->balance);
            $newBalance = $currentBalance + $winAmount;
            User::where('id', $user->id)->update(['balance' => strval($newBalance)]);

            return response()->json([
                'game_over' => true,
                'hit_mine' => false,
                'revealed_cell' => $cellIndex,
                'gems_found' => $gemsFound,
                'multiplier' => $multiplier,
                'win_amount' => $winAmount,
                'all_gems_found' => true,
                'auto_cashout' => true
            ]);
        }

        return response()->json([
            'game_over' => false,
            'hit_mine' => false,
            'revealed_cell' => $cellIndex,
            'gems_found' => $gemsFound,
            'multiplier' => $multiplier,
            'can_cashout' => $gemsFound > 0,
            'potential_win' => $mine->bet_amount * $multiplier
        ]);
    }

    public function cashout(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:mines,id'
        ]);

        $mine = Mine::findOrFail($request->game_id);

        if ($mine->user_id !== Auth::id()) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        $playMap = json_decode($mine->play_map, true);
        $gemsFound = count($playMap['revealed']);

        if ($gemsFound === 0) {
            return response()->json(['error' => 'Cannot cashout without revealed cells'], 400);
        }

        $multiplier = $this->calculateMultiplier($gemsFound, $mine->mines_count);
        $winAmount = $mine->bet_amount * $multiplier;

        $user = Auth::user();
        $currentBalance = floatval($user->balance);
        $newBalance = $currentBalance + $winAmount;
        User::where('id', $user->id)->update(['balance' => strval($newBalance)]);

        return response()->json([
            'game_over' => true,
            'win_amount' => $winAmount,
            'multiplier' => $multiplier,
            'gems_found' => $gemsFound,
            'cashout' => true
        ]);
    }

        private function generatePlayMap($minesCount)
    {
        $mines = [];

        // Обычная генерация мин для всех пользователей
        // Подкрутка происходит в момент клика, а не при генерации
        while (count($mines) < $minesCount) {
            $position = rand(0, 24);
            if (!in_array($position, $mines)) {
                $mines[] = $position;
            }
        }

        return [
            'mines' => $mines,
            'revealed' => []
        ];
    }

        private function calculateMultiplier($gemsFound, $minesCount)
    {
        if ($gemsFound === 0) return 1;

        $totalCells = 25;
        $safeCells = $totalCells - $minesCount;

        // Если нашли все возможные гемы, возвращаем максимальный множитель
        if ($gemsFound >= $safeCells) {
            $multiplier = 1;
            for ($i = 0; $i < $safeCells; $i++) {
                if (($safeCells - $i) > 0) {
                    $multiplier *= ($totalCells - $i) / ($safeCells - $i);
                }
            }
            return round($multiplier * 0.96, 2);
        }

        $multiplier = 1;
        for ($i = 0; $i < $gemsFound; $i++) {
            // Добавляем проверку чтобы избежать деления на ноль
            if (($safeCells - $i) > 0) {
                $multiplier *= ($totalCells - $i) / ($safeCells - $i);
            }
        }

        return round($multiplier * 0.96, 2);
    }
}