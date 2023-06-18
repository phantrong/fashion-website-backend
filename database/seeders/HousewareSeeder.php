<?php

namespace Database\Seeders;

use App\Models\Houseware;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HousewareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Houseware::create([
            'name' => 'Điều hòa'
        ]);
        Houseware::create([
            'name' => 'Bình nóng lạnh'
        ]);
        Houseware::create([
            'name' => 'Giường'
        ]);
        Houseware::create([
            'name' => 'Tủ'
        ]);
        Houseware::create([
            'name' => 'Bàn ghế làm việc'
        ]);
        Houseware::create([
            'name' => 'Kệ bếp'
        ]);
        Houseware::create([
            'name' => 'Máy giặt'
        ]);
        Houseware::create([
            'name' => 'Tivi'
        ]);
        Houseware::create([
            'name' => 'Tủ lạnh'
        ]);
    }
}
