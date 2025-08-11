<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CrashGames;
use App\Models\CrashBet;

class CrashStatus extends Command
{
    protected $signature = 'crash:status';
    protected $description = 'Показать статус crash игр';

    public function handle()
    {
        $this->info("=== СТАТУС CRASH СИСТЕМЫ ===");

        $totalGames = CrashGames::count();
        $this->info("Всего игр в базе: {$totalGames}");

        $activeGame = CrashGames::whereIn('status', ['waiting', 'playing'])->first();
        if ($activeGame) {
            $this->info("Активная игра: ID={$activeGame->id}, статус={$activeGame->status}, множитель={$activeGame->multiplier}x");
        } else {
            $this->warn("Нет активной игры");
        }

        $lastGame = CrashGames::latest()->first();
        if ($lastGame) {
            $this->info("Последняя игра: ID={$lastGame->id}, статус={$lastGame->status}, crash_point={$lastGame->crash_point}x");
        }

        $totalBets = CrashBet::count();
        $this->info("Всего ставок: {$totalBets}");

        $activeBets = CrashBet::where('status', 'waiting')->count();
        $this->info("Активных ставок: {$activeBets}");

        $recentGames = CrashGames::latest()->take(5)->get();
        if ($recentGames->count() > 0) {
            $this->info("\nПоследние 5 игр:");
            foreach ($recentGames as $game) {
                $this->line("ID: {$game->id} | Статус: {$game->status} | Точка краша: {$game->crash_point}x | Время: {$game->created_at}");
            }
        }

        return Command::SUCCESS;
    }
}