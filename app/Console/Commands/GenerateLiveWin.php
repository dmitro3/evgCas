<?php

namespace App\Console\Commands;

use App\Events\FakeWinEvent;
use App\Models\Slot;
use App\Models\Win;
use Illuminate\Console\Command;

class GenerateLiveWin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-live-win';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        while (true) {
            $slot = Slot::inRandomOrder()->limit(1)->first();
            $amount = rand(10, 10000);
            $win = Win::create([
                'amount' => $amount,
                'game_id' => $slot->id,
            ]);

            $win->load('game');

            $fakeWinsCount = Win::count();
            if ($fakeWinsCount > 100) {
                Win::orderBy('created_at', 'asc')
                    ->limit(50)
                    ->delete();
            }

            event(new FakeWinEvent($win));
            $sleepTime = rand(1, 5);
            sleep($sleepTime);
        }
    }
}
