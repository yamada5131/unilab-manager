<?php

namespace Database\Seeders;

use App\Models\Computer;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Rooms
        $rooms = Room::factory()->count(10)->create();

        // Create Users
        $users = User::factory()->count(10)->create();

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
            Computer::factory()->count(48)->create([
                'room_id' => $room->id,
            ]);
        }
    }
}
