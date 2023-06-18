<?php

namespace Database\Seeders;

use App\Enum\AdminEnum;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Nguyễn Đình Thi',
            'type' => AdminEnum::TYPE_ROOT_ADMIN,
            'phone' => '0968724069',
            'email' => 'thuephongtrotth@gmail.com',
            'password' => '$2y$10$ZsFUwQ0gauzt4/iJO7KKLuaVRSnVGknWNsCqRcOznmh7rd0gGlsLq',
            'status' => AdminEnum::STATUS_ACTIVE,
        ]);
    }
}
