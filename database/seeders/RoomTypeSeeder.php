<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomType::create([
            'name' => 'Phòng trọ'
        ]);

        RoomType::create([
            'name' => 'Chung cư mini'
        ]);

        RoomType::create([
            'name' => 'Phòng trọ ở ghép'
        ]);
    }
}
