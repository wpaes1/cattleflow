<?php

namespace Database\Factories;

use App\Models\Farm;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Farm>
 */
class FarmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'farm_name' => fake()->company(),
            'registration_number' => fake()->numerify('#########'),
            'owner_name' => fake()->name(),
            'location' => fake()->address(),
            'city' => fake()->city(),
            'state_registration' => fake()->state(),
            'country' => fake()->country(),
            'total_area' => fake()->numerify('######.##'),
        ];
    }
}
