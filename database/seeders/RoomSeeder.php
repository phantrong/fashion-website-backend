<?php

namespace Database\Seeders;

use App\Models\Houseware;
use App\Models\Room;
use App\Models\RoomHouseware;
use App\Models\RoomMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            $images = [
                'https://luxurydecor.vn/wp-content/uploads/2019/12/thiet-ke-noi-that-chung-cu-90m2.jpg',
                'https://thietkenoithatblog.com/wp-content/uploads/2018/11/mau-thiet-ke-noi-that-the-Gold-View-hien-dai-2-1.jpg',
                'https://thietkenoithatatz.com/wp-content/uploads/2020/06/thiet-ke-noi-that-chung-cu-56m2-dep-hien-dai-va-nhung-bi-quyet-trong-thiet-ke.jpg',
                'https://daututietkiem.vn/wp-content/uploads/2022/11/can-ho-chung-cu-la-gi-400x282.gif',
                'https://onetouchmedia.vn/wp-content/uploads/2021/07/Happy-One-Central-4-1024x683.jpg'
            ];
            $housewares = Houseware::select('id')->get()->pluck('id')->toArray();
            $rooms = Room::factory()->count(50)->create();

            foreach ($rooms as $room) {
                $numberMedia = rand(2, 8);
                for ($i = 0; $i < $numberMedia; $i++) {
                    RoomMedia::create([
                        'room_id' => $room->id,
                        'link' => $images[array_rand($images)],
                        'type' => 1
                    ]);
                }
                $numberHourse = rand(0, 9);
                if ($numberHourse > 0) {
                    $housewareKeys = array_rand($housewares, $numberHourse);
                    if (is_array($housewareKeys)) {
                        foreach ($housewareKeys as $key) {
                            RoomHouseware::create([
                                'room_id' => $room->id,
                                'houseware_id' => $housewares[$key]
                            ]);
                        }
                    } elseif ($housewareKeys) {
                        RoomHouseware::create([
                            'room_id' => $room->id,
                            'houseware_id' => $housewares[$housewareKeys]
                        ]);
                    }
                }
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }
}
