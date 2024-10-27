<?php

namespace Database\Factories;

use App\Models\Computer;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Computer>
 */
class ComputerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word.' PC',
            'room_id' => Room::factory(),
            'hardware_specifications' => json_encode([
                'CPU' => $this->faker->randomElement(['Intel i5', 'Intel i7', 'AMD Ryzen 5', 'AMD Ryzen 7']),
                'RAM' => $this->faker->randomElement(['8GB', '16GB', '32GB']),
                'Storage' => $this->faker->randomElement(['256GB SSD', '512GB SSD', '1TB HDD']),
            ]),
            'network_status' => $this->faker->randomElement(['Connected', 'Disconnected']),
            'mac_address' => $this->faker->macAddress,
            'operating_system' => $this->faker->randomElement(['Windows 10', 'Ubuntu 20.04', 'macOS']),
            'installed_software' => json_encode($this->generateSoftwareList()),
        ];
    }

    /**
     * Generate a list of fake software with detailed information.
     */
    private function generateSoftwareList(): array
    {
        $softwareList = [];

        for ($i = 0; $i < rand(3, 6); $i++) {
            $softwareList[] = [
                'name' => $this->faker->randomElement(['Microsoft Office', 'Adobe Photoshop', 'Visual Studio Code', 'Slack', 'Zoom', 'Chrome']),
                'version' => $this->faker->randomElement(['1.0', '2.3', '2021', '5.8']),
                'license' => $this->faker->randomElement(['Free', 'Trial', 'Paid']),
                'installation_date' => Carbon::now()->subDays(rand(0, 365))->toDateString(),
            ];
        }

        return $softwareList;
    }
}
