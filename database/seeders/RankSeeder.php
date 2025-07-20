<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rank;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranks = [];
        $types = ['silver', 'cooper', 'zues', 'magican'];

        $currentXp = 0;

        foreach ($types as $type) {
            for ($level = 1; $level <= 5; $level++) {
                $ranks[] = [
                    'name' => $type . ' ' . $level,
                    'type' => $type,
                    'xp_min' => $currentXp,
                    'xp_max' => $currentXp + 100,
                    'level' => $level,
                ];

                $currentXp += 100;
            }
        }

        foreach ($ranks as $rank) {
            Rank::create($rank);
        }
    }
}