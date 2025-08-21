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
            // Generate a realistic bet and win relationship
            $betOptions = [10, 20, 50, 100, 200, 500, 1000, 2000, 5000];
            $betWeights = [30, 25, 15, 10, 8, 6, 4, 1, 1]; // Heavier weight for smaller bets
            $weightPick = mt_rand(1, array_sum($betWeights));
            $cumulative = 0;
            $betAmount = $betOptions[0];
            foreach ($betOptions as $index => $option) {
                $cumulative += $betWeights[$index];
                if ($weightPick <= $cumulative) {
                    $betAmount = $option;
                    break;
                }
            }

            // Weighted multiplier distribution: many small wins, rare big hits
            $roll = mt_rand(1, 100);
            if ($roll <= 60) {
                $multiplier = mt_rand(110, 200) / 100; // 1.10x - 2.00x
            } elseif ($roll <= 85) {
                $multiplier = mt_rand(200, 500) / 100; // 2.00x - 5.00x
            } elseif ($roll <= 95) {
                $multiplier = mt_rand(500, 1000) / 100; // 5.00x - 10.00x
            } elseif ($roll <= 99) {
                $multiplier = mt_rand(1000, 5000) / 100; // 10.00x - 50.00x
            } else {
                $multiplier = mt_rand(5000, 10000) / 100; // 50.00x - 100.00x
            }

            $amount = (int) round($betAmount * $multiplier);

            // Generate a realistic-looking username
            $randomUsername = $this->generateRealisticUsername();

            $win = Win::create([
                'amount' => (string) $amount,
                'game_id' => $slot->id,
                'bet_amount' => (string) $betAmount,
                'random_username' => $randomUsername,
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

    /**
     * Generate a more realistic username using common patterns.
     */
    protected function generateRealisticUsername(): string
    {
        $firstNames = [
            'Nikita','Ivan','Alex','Dmitry','Sergey','Andrey','Pavel','Roman','Denis','Vlad',
            'Max','Artem','Egor','Oleg','Igor','Kirill','Ilya','Mikhail','Anton','Yuri',
            'Omar','Arman','Timur','Daniel','Victor','Leonid','Arkadiy','Stas','Ruslan'
        ];

        $lastNames = [
            'Petrov','Ivanov','Sidorov','Smirnov','Kuznetsov','Popov','Sokolov','Lebedev','Kozlov','Novikov',
            'Morozov','Volkov','Yakovlev','Zaitsev','Bogdanov','Orlov','Belyaev','Makarov','Andreev','Nikolaev'
        ];

        $adjectives = [
            'Lucky','Mister','Silent','Rapid','Golden','Neon','Shadow','Crimson','Polar','Arctic',
            'Swift','Urban','Frost','Aero','Solar','Prime','Meta','Nova','Cosmic','Quantum'
        ];

        $animals = [
            'Fox','Bear','Wolf','Tiger','Eagle','Panda','Shark','Falcon','Lynx','Owl',
            'Raven','Viper','Bull','Hawk','Jaguar','Cobra','Mantis','Bison','Rhino','Cheetah'
        ];

        $patternRoll = mt_rand(1, 100);

        // 1) 50%: FirstName + (Last initial or last name) + optional 2-4 digits or year-like suffix
        if ($patternRoll <= 50) {
            $first = $firstNames[array_rand($firstNames)];
            $useFullLast = mt_rand(1, 100) <= 30; // 30% use full last name
            $last = $lastNames[array_rand($lastNames)];
            $core = $useFullLast ? ($first . $last) : ($first . substr($last, 0, 1));

            // optional delimiter
            $delimiters = ['', '', '', '_', '.', '-'];
            $delim = $delimiters[array_rand($delimiters)];

            // numeric suffix: 40% two digits, 40% 3-4 digits, 20% none
            $numRoll = mt_rand(1, 100);
            if ($numRoll <= 40) {
                $suffix = str_pad((string)mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
            } elseif ($numRoll <= 80) {
                $suffix = (string)mt_rand(100, 9999);
            } else {
                $suffix = '';
            }

            return $core . ($suffix !== '' ? $delim . $suffix : '');
        }

        // 2) 30%: Adjective + Animal + optional number
        if ($patternRoll <= 80) {
            $core = $adjectives[array_rand($adjectives)] . $animals[array_rand($animals)];
            $numRoll = mt_rand(1, 100);
            $suffix = '';
            if ($numRoll <= 60) {
                $suffix = (string)mt_rand(1, 9999);
            }
            return $core . $suffix;
        }

        // 3) 20%: short gamer-like: x + name + x or name + 2 digits
        $name = $firstNames[array_rand($firstNames)];
        if (mt_rand(0, 1) === 1) {
            return 'x' . $name . 'x';
        }
        return $name . str_pad((string)mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
    }
}
