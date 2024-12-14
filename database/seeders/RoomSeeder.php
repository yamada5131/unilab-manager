<?php

// database/seeders/RoomSeeder.php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run()
    {
        Room::create([
            'name' => 'Phòng máy 101',
            'capacity' => 30,
            'location' => 'Tầng 1, Khu A',
            'description' => 'Phòng máy chính dành cho lớp học lý thuyết.',
        ]);

        Room::create([
            'name' => 'Phòng máy 102',
            'capacity' => 25,
            'location' => 'Tầng 1, Khu B',
            'description' => 'Phòng máy thực hành với cấu hình cao.',
        ]);
    }
}
