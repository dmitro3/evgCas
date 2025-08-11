<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\CrashGameTick;
use App\Events\CrashGameEnded;
use App\Models\CrashGames;
use App\Events\CrashGameStarted;

class CrashGameLoop extends Command
{
    protected $signature = 'crash:run';
    protected $description = 'Запуск бесконечного цикла crash-игры';

    public function handle()
    {
        $this->info("=== CRASH GAME LOOP ЗАПУЩЕН ===");
        $this->info("Время начала: " . now());

        while (true) {
            $game = CrashGames::create([
                'crash_point' => $this->generateCrashPoint(),
                'multiplier' => 1.00,
                'status' => 'waiting',
            ]);

            $this->info("Новая игра создана: ID={$game->id}, crash_point={$game->crash_point}");
            broadcast(new CrashGameStarted($game));

            $this->info("Игра в ожидании 5 секунд...");
            sleep(5);

            $multiplier = 1.00;
            $crashPoint = $game->crash_point;
            $interval = 100 * 1000;

            $game->update(['status' => 'playing']);
            $this->info("Игра началась! Целевая точка: {$crashPoint}x");

            while ($multiplier < $crashPoint) {
                usleep($interval);

                $multiplier = round($multiplier * 1.015, 2);
                $game->update(['multiplier' => $multiplier]);

                \App\Models\CrashBet::where('game_id', $game->id)
                    ->where('status', 'waiting')
                    ->where('auto_cash_out', '<=', $multiplier)
                    ->whereNotNull('auto_cash_out')
                    ->chunk(100, function ($bets) use ($multiplier) {
                        foreach ($bets as $bet) {
                            $winAmount = $bet->bet_amount * $multiplier;
                            $bet->update([
                                'multiplier' => $multiplier,
                                'status' => 'won'
                            ]);
                            $bet->user()->increment('balance', $winAmount);
                        }
                    });

                broadcast(new CrashGameTick($game));

                if ($multiplier % 1 < 0.02) {
                    $this->line("Множитель: {$multiplier}x");
                }
            }

            $game->update(['status' => 'finished']);

            \App\Models\CrashBet::where('game_id', $game->id)
                ->where('status', 'waiting')
                ->update(['status' => 'lost']);

            broadcast(new CrashGameEnded($game));

            $this->info("Игра завершена на {$multiplier}x");
            $this->info("Пауза 10 секунд до следующей игры...");

            sleep(10);
        }
    }

    protected function generateCrashPoint(): float
    {
        return round(mt_rand(110, 2000) / 100, 2);
    }
}
