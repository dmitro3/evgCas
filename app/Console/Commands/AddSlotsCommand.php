<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Slot;
use Illuminate\Support\Facades\File;

class AddSlotsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slots:add {--fresh : Clear existing slots before adding}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add all available slots to the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('fresh')) {
            $this->info('Clearing existing slots...');
            Slot::truncate();
        }

        $this->info('Adding slots to database...');

        $slotsPath = public_path('slots');

        if (!File::exists($slotsPath)) {
            $this->error('Slots directory not found!');
            return 1;
        }

        $slotDirectories = File::directories($slotsPath);
        $addedCount = 0;

        $slotsData = [
            'CandyVillage' => ['id_game' => 'vs20candvil', 'name' => 'Candy Village'],
            'AncientEgyptClassic' => ['id_game' => 'vs15ancegypt', 'name' => 'Ancient Egypt Classic'],
            'AngelVsSinner' => ['id_game' => 'vs15fghtmultlv', 'name' => 'Angel vs Sinner'],
            'BigBassBonanzaReelAction' => ['id_game' => 'vs10bbhas', 'name' => 'Big Bass Bonanza Reel Action'],
            'BigBassHalloween' => ['id_game' => 'vs10bbhallow', 'name' => 'Big Bass Halloween'],
            'BonanzaGold' => ['id_game' => 'vs20bonzgold', 'name' => 'Bonanza Gold'],
            'ChristmasBigBassBonanza' => ['id_game' => 'vs10bbchrist', 'name' => 'Christmas Big Bass Bonanza'],
            'FruitParty' => ['id_game' => 'vs20fruitprty', 'name' => 'Fruit Party'],
            'GatesofAztec' => ['id_game' => 'vs20gatezaztec', 'name' => 'Gates of Aztec'],
            'GatesofGatotKaca' => ['id_game' => 'vs15gattkaca', 'name' => 'Gates of Gatot Kaca'],
            'GatesofOlympus1000' => ['id_game' => 'vs20olympus1000', 'name' => 'Gates of Olympus 1000'],
            'GatesofOlympusDice' => ['id_game' => 'vs20olympdice', 'name' => 'Gates of Olympus Dice'],
            'SaiyanMania' => ['id_game' => 'vs20saiyan', 'name' => 'Saiyan Mania'],
            'StarlightPrincess' => ['id_game' => 'vs20starlight', 'name' => 'Starlight Princess'],
            'SugarRushXmas' => ['id_game' => 'vs20sugarrush', 'name' => 'Sugar Rush Xmas'],
            'SugarTwist' => ['id_game' => 'vs20sugtwist', 'name' => 'Sugar Twist'],
            'SweetBonanza' => ['id_game' => 'vs20sweetbnza', 'name' => 'Sweet Bonanza'],
            'SweetBonanza1000' => ['id_game' => 'vs20sweetbnz1000', 'name' => 'Sweet Bonanza 1000'],
            'TheDogHouse' => ['id_game' => 'vs20doghouse', 'name' => 'The Dog House'],
            'ZeusVsHades' => ['id_game' => 'vs20zeusvshades', 'name' => 'Zeus vs Hades'],
        ];

        foreach ($slotDirectories as $directory) {
            $directoryName = basename($directory);

            if (isset($slotsData[$directoryName])) {
                $slotData = $slotsData[$directoryName];

                $htmlPath = $directory . '/gs2c/html5Game.html';
                if (File::exists($htmlPath)) {
                    $imageName = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $directoryName));

                    $slot = Slot::updateOrCreate(
                        ['id_game' => $slotData['id_game']],
                        [
                            'name' => $slotData['name'],
                            'description' => null,
                            'image' => "/assets/images/games/{$imageName}.webp",
                            'route' => "/slots/{$directoryName}/gs2c/html5Game.html",
                            'is_active' => true,
                        ]
                    );

                    $addedCount++;
                    $this->info("Added: {$slotData['name']}");
                } else {
                    $this->warn("HTML file not found for: {$directoryName}");
                }
            } else {
                $this->warn("No data mapping for directory: {$directoryName}");
            }
        }

        $this->info("Successfully added {$addedCount} slots to the database!");
        return 0;
    }
}
