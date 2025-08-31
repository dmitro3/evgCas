<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Slot;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slots = [
            [
                'id_game' => 'vs20candvil',
                'name' => 'Candy Village',
                'description' => null,
                'image' => '/assets/images/games/candy_village.png',
                'route' => '/slots/CandyVillage/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs15ancegypt',
                'name' => 'Ancient Egypt Classic',
                'description' => null,
                'image' => '/assets/images/games/ancient_egypt.png',
                'route' => '/slots/AncientEgyptClassic/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs15fghtmultlv',
                'name' => 'Angel vs Sinner',
                'description' => null,
                'image' => '/assets/images/games/angel_vs_sinner.png',
                'route' => '/slots/AngelVsSinner/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs10bbhas',
                'name' => 'Big Bass Bonanza Reel Action',
                'description' => null,
                'image' => '/assets/images/games/big_bass_bonanza.png',
                'route' => '/slots/BigBassBonanzaReelAction/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs10bbhallow',
                'name' => 'Big Bass Halloween',
                'description' => null,
                'image' => '/assets/images/games/big_bass_halloween.png',
                'route' => '/slots/BigBassHalloween/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs20bonzgold',
                'name' => 'Bonanza Gold',
                'description' => null,
                'image' => '/assets/images/games/bonanza_gold.png',
                'route' => '/slots/BonanzaGold/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs10bbchrist',
                'name' => 'Christmas Big Bass Bonanza',
                'description' => null,
                'image' => '/assets/images/games/christmas_big_bass.png',
                'route' => '/slots/ChristmasBigBassBonanza/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs20fruitprty',
                'name' => 'Fruit Party',
                'description' => null,
                'image' => '/assets/images/games/fruit_party.png',
                'route' => '/slots/FruitParty/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs20gatezaztec',
                'name' => 'Gates of Aztec',
                'description' => null,
                'image' => '/assets/images/games/gates_of_aztec.png',
                'route' => '/slots/GatesofAztec/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs15gattkaca',
                'name' => 'Gates of Gatot Kaca',
                'description' => null,
                'image' => '/assets/images/games/gates_of_gatot_kaca.png',
                'route' => '/slots/GatesofGatotKaca/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs20olympus1000',
                'name' => 'Gates of Olympus 1000',
                'description' => null,
                'image' => '/assets/images/games/gates_of_olympus_1000.png',
                'route' => '/slots/GatesofOlympus1000/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs20olympdice',
                'name' => 'Gates of Olympus Dice',
                'description' => null,
                'image' => '/assets/images/games/gates_of_olympus_dice.png',
                'route' => '/slots/GatesofOlympusDice/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs20saiyan',
                'name' => 'Saiyan Mania',
                'description' => null,
                'image' => '/assets/images/games/saiyan_mania.png',
                'route' => '/slots/SaiyanMania/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs20starlight',
                'name' => 'Starlight Princess',
                'description' => null,
                'image' => '/assets/images/games/starlight_princess.png',
                'route' => '/slots/StarlightPrincess/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs20sugarrush',
                'name' => 'Sugar Rush Xmas',
                'description' => null,
                'image' => '/assets/images/games/sugar_rush_xmas.png',
                'route' => '/slots/SugarRushXmas/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs20sugtwist',
                'name' => 'Sugar Twist',
                'description' => null,
                'image' => '/assets/images/games/sugar_twist.png',
                'route' => '/slots/SugarTwist/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs20sweetbnza',
                'name' => 'Sweet Bonanza',
                'description' => null,
                'image' => '/assets/images/games/sweet_bonanza.png',
                'route' => '/slots/SweetBonanza/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs20sweetbnz1000',
                'name' => 'Sweet Bonanza 1000',
                'description' => null,
                'image' => '/assets/images/games/sweet_bonanza_1000.png',
                'route' => '/slots/SweetBonanza1000/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs20doghouse',
                'name' => 'The Dog House',
                'description' => null,
                'image' => '/assets/images/games/the_dog_house.png',
                'route' => '/slots/TheDogHouse/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'vs20zeusvshades',
                'name' => 'Zeus vs Hades',
                'description' => null,
                'image' => '/assets/images/games/zeus_vs_hades.png',
                'route' => '/slots/ZeusVsHades/gs2c/html5Game.html',
                'is_active' => true,
            ],
            [
                'id_game' => 'crash',
                'name' => 'Crash',
                'description' => null,
                'image' => '/assets/images/games/original/crash.png',
                'route' => '/games/crash',
                'type' => 'original_game',
                'is_active' => true,
            ],
            [
                'id_game' => 'tower',
                'name' => 'Tower',
                'description' => null,
                'image' => '/assets/images/games/original/tower.png',
                'route' => '/games/tower',
                'type' => 'original_game',
                'is_active' => true,
            ],
            [
                'id_game' => 'mines',
                'name' => 'Mines',
                'description' => null,
                'image' => '/assets/images/games/original/mines.png',
                'route' => '/games/mines',
                'type' => 'original_game',
                'is_active' => true,
            ],

            [
                'id_game' => 'coinflip',
                'name' => 'Coinflip',
                'description' => null,
                'image' => '/assets/images/games/original/coinflip.png',
                'route' => '/games/coinflip',
                'type' => 'original_game',
                'is_active' => true,
            ],
            [
                'id_game' => 'dice',
                'name' => 'Dice',
                'description' => null,
                'image' => '/assets/images/games/original/dice.png',
                'route' => '/games/dice',
                'type' => 'original_game',
                'is_active' => true,
            ],
            [
                'id_game' => 'plinko',
                'name' => 'Plinko',
                'description' => null,
                'image' => '/assets/images/games/original/plink.png',
                'route' => '/games/plinko',
                'type' => 'original_game',
                'is_active' => true,
            ],

        ];

        foreach ($slots as $slot) {
            Slot::create($slot);
        }
    }
}
