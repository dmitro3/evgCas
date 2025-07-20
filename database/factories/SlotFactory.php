<?php

namespace Database\Factories;

use App\Models\Slot;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slot>
 */
class SlotFactory extends Factory
{
    protected $model = Slot::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_game' => $this->faker->unique()->regexify('[a-z]{2}[0-9]{2}[a-z]{6}'),
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'image' => '/assets/images/games/' . $this->faker->slug() . '.webp',
            'route' => '/slots/' . $this->faker->word() . '/gs2c/html5Game.html',
            'is_active' => true,
        ];
    }
}
