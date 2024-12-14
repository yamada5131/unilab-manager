<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Software>
 */
class SoftwareFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Antivirus', 'Office Suite', 'Code Editor', 'Web Browser', 'Database Client']),
            'version' => fake()->numerify('#.#.#'),
            'description' => fake()->sentence,
        ];
    }
}
