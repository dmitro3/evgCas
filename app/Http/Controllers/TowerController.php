<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TowerController extends Controller
{
    public function createGame(Request $request)
    {
        $request->validate([
            'bet_amount' => 'required|numeric|min:0.01',
            'mines_per_row' => 'required|integer|min:1|max:3'
        ]);

        $user = Auth::user();
        $betAmount = $request->bet_amount;
        $minesPerRow = $request->mines_per_row;

        if ($user->balance < $betAmount) {
            return response()->json(['error' => 'Недостаточно средств'], 400);
        }

        Tower::where('user_id', $user->id)->where('status', 'active')->delete();

        $gameMap = $this->generateGameMap($minesPerRow);

        DB::transaction(function () use ($user, $betAmount, $minesPerRow, $gameMap) {
            User::where('id', $user->id)->decrement('balance', $betAmount);

            Tower::create([
                'user_id' => $user->id,
                'bet_amount' => $betAmount,
                'mines_per_row' => $minesPerRow,
                'current_level' => 0,
                'game_map' => $gameMap,
                'revealed_cells' => [],
                'status' => 'active'
            ]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Игра создана'
        ]);
    }

    public function revealCell(Request $request)
    {
        $request->validate([
            'cell_index' => 'required|integer|min:0|max:35'
        ]);

        $user = Auth::user();
        $game = Tower::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if (!$game) {
            return response()->json(['error' => 'Активная игра не найдена'], 404);
        }

        $cellIndex = $request->cell_index;
        $row = intval($cellIndex / 4);
        $col = $cellIndex % 4;

        if ($row !== $game->current_level) {
            return response()->json(['error' => 'Можно открывать только ячейки текущего уровня'], 400);
        }

        $gameMap = $game->game_map;
        $revealedCells = $game->revealed_cells;

        if (in_array($cellIndex, $revealedCells)) {
            return response()->json(['error' => 'Ячейка уже открыта'], 400);
        }

        $revealedCells[] = $cellIndex;
        $isGem = $gameMap[$row][$col] === 1;

        // Если пользователь с win_mode попал на мину - меняем поле
        if (!$isGem && $user->win_mode) {
            // Делаем текущую ячейку безопасной
            $gameMap[$row][$col] = 1;

            // Находим свободную ячейку в том же ряду для перемещения мины
            $availablePositions = [];
            for ($i = 0; $i < 4; $i++) {
                if ($i !== $col && $gameMap[$row][$i] === 1) {
                    $availablePositions[] = $i;
                }
            }

            // Если есть доступные безопасные ячейки, одну делаем миной
            if (!empty($availablePositions)) {
                $newMineCol = $availablePositions[array_rand($availablePositions)];
                $gameMap[$row][$newMineCol] = 0;
            }

            // Сохраняем измененную карту
            $game->update(['game_map' => $gameMap]);

            // Теперь ячейка безопасная
            $isGem = true;
        }

        if (!$isGem) {
            $game->update([
                'revealed_cells' => $revealedCells,
                'status' => 'lost'
            ]);

            return response()->json([
                'hit_mine' => true,
                'game_over' => true,
                'revealed_cells' => $revealedCells,
                'game_map' => $gameMap
            ]);
        }

        // В Tower игре достаточно найти одну безопасную ячейку чтобы пройти уровень
        // Добавляем все мины текущего уровня в revealed_cells чтобы показать их
        for ($i = 0; $i < 4; $i++) {
            $mineIndex = $row * 4 + $i;
            if (!in_array($mineIndex, $revealedCells)) {
                $revealedCells[] = $mineIndex;
            }
        }

        $newLevel = $game->current_level + 1;
        $gameWon = $newLevel >= 9;

        if ($gameWon) {
            $winnings = $game->bet_amount * $this->calculateMultiplier(8, $game->mines_per_row);

            DB::transaction(function () use ($user, $game, $winnings, $revealedCells) {
                User::where('id', $user->id)->increment('balance', $winnings);
                $game->update([
                    'revealed_cells' => $revealedCells,
                    'status' => 'won',
                    'winnings' => $winnings
                ]);
            });

            return response()->json([
                'level_complete' => true,
                'game_won' => true,
                'revealed_cells' => $revealedCells,
                'winnings' => $winnings,
                'current_level' => 9,
                'multiplier' => $this->calculateMultiplier(8, $game->mines_per_row),
                'game_map' => $gameMap
            ]);
        } else {
            $game->update([
                'revealed_cells' => $revealedCells,
                'current_level' => $newLevel
            ]);

            return response()->json([
                'level_complete' => true,
                'game_won' => false,
                'revealed_cells' => $revealedCells,
                'current_level' => $newLevel,
                'multiplier' => $this->calculateMultiplier($newLevel, $game->mines_per_row),
                'game_map' => $gameMap
            ]);
        }

        $game->update(['revealed_cells' => $revealedCells]);

        return response()->json([
            'level_complete' => false,
            'revealed_cells' => $revealedCells,
            'current_level' => $game->current_level,
            'multiplier' => $this->calculateMultiplier($game->current_level, $game->mines_per_row)
        ]);
    }

    public function cashout(Request $request)
    {
        $user = Auth::user();
        $game = Tower::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if (!$game) {
            return response()->json(['error' => 'Активная игра не найдена'], 404);
        }

        if ($game->current_level === 0) {
            return response()->json(['error' => 'Нельзя забрать выигрыш до прохождения хотя бы одного уровня'], 400);
        }

        $multiplier = $this->calculateMultiplier($game->current_level, $game->mines_per_row);
        $winnings = $game->bet_amount * $multiplier;

        DB::transaction(function () use ($user, $game, $winnings) {
            User::where('id', $user->id)->increment('balance', $winnings);
            $game->update([
                'status' => 'cashed_out',
                'winnings' => $winnings
            ]);
        });

        return response()->json([
            'success' => true,
            'winnings' => $winnings,
            'multiplier' => $multiplier
        ]);
    }

            private function generateGameMap($minesPerRow)
    {
        $gameMap = [];

        // Обычная генерация для всех пользователей
        // Подкрутка происходит в момент клика, а не при генерации
        for ($row = 0; $row < 9; $row++) {
            $rowMap = [0, 0, 0, 0];
            $safePositions = array_rand($rowMap, 4 - $minesPerRow);

            if (!is_array($safePositions)) {
                $safePositions = [$safePositions];
            }

            foreach ($safePositions as $pos) {
                $rowMap[$pos] = 1;
            }

            $gameMap[] = $rowMap;
        }

        return $gameMap;
    }

    private function calculateMultiplier($level, $minesPerRow)
    {
        if ($level === 0) return 1.0;

        $safePerRow = 4 - $minesPerRow;
        $baseMultiplier = 4 / $safePerRow;

        $multiplier = 1.0;
        for ($i = 0; $i < $level; $i++) {
            $multiplier *= $baseMultiplier;
        }

        return round($multiplier * 0.96, 2);
    }

    public function getActiveGame()
    {
        $user = Auth::user();
        $game = Tower::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if (!$game) {
            return response()->json(['game' => null]);
        }

        return response()->json([
            'game' => [
                'bet_amount' => $game->bet_amount,
                'mines_per_row' => $game->mines_per_row,
                'current_level' => $game->current_level,
                'revealed_cells' => $game->revealed_cells,
                'status' => $game->status,
                'multiplier' => $this->calculateMultiplier($game->current_level, $game->mines_per_row)
            ]
        ]);
    }
}