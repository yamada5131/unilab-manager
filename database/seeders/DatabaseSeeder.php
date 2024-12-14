<?php

namespace Database\Seeders;

use App\Models\Computer;
use App\Models\ComputerStatus;
use App\Models\DefaultSoftware;
use App\Models\Room;
use App\Models\Software;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        // Create Rooms
        $rooms = Room::factory()->count(10)->create();

        // Create Users
        $users = User::factory()->count(10)->create()->each(function ($user) {
            // Assign a random role to each user
            $user->assignRole(['admin', 'manager', 'instructor', 'student'][rand(0, 2)]);
        });

        // Assign Users to Rooms with Permissions
        foreach ($users as $user) {
            if (! $user->can_manage_all_rooms) {
                // Assign 1 to 3 random rooms to each user
                $assignedRooms = $rooms->random(rand(1, 3));
                $user->rooms()->attach($assignedRooms->pluck('id')->toArray());
            }
        }

        // Create Computers and assign them to Rooms
        foreach ($rooms as $room) {
            $computers = Computer::factory()->count(48)->create([
                'room_id' => $room->id,
            ]);

            // Seed computer statuses
            foreach ($computers as $computer) {
                ComputerStatus::factory()->create([
                    'computer_id' => $computer->id,
                ]);
            }
        }

        // Create Software
        $softwareList = Software::factory()->count(20)->create();

        // Assign some software as default
        $defaultSoftwareIds = $softwareList->random(3)->pluck('id');
        foreach ($defaultSoftwareIds as $softwareId) {
            DefaultSoftware::create(['software_id' => $softwareId]);
        }

        // Attach default software to all computers in the computer_software table
        foreach (Computer::all() as $computer) {
            foreach ($defaultSoftwareIds as $softwareId) {
                $computer->software()->attach($softwareId, ['installed_at' => now()]);
            }
        }
    }
}
