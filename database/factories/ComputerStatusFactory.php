<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ComputerStatus>
 */
class ComputerStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => fake()->randomElement(['Operating', 'Disconnected', 'Maintenance', 'Idle']),
            'last_checked' => fake()->dateTimeBetween('-1 week', 'now'),
            'current_user' => fake()->optional()->name,
        ];
    }
}
