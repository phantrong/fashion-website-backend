<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Ward;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $districtIds = District::select('id')->where('province_id', 1)->get()->pluck('id')->toArray();
        $districtId = $districtIds[array_rand($districtIds)];
        $wardIds = Ward::select('id')->where('district_id', $districtId)->get()->pluck('id')->toArray();

        $isNegotiate = rand(0, 1);
        $cost = null;
        if (!$isNegotiate) {
            $cost = rand(2000, 10000);
        }

        $maxPeopleAllowed = [null, 3, 4, 5];

        $roomTypes = RoomType::select('id')->get()->pluck('id')->toArray();

        return [
            'title' => fake()->name(),
            'province_id' => 1,
            'district_id' => $districtId,
            'ward_id' => $wardIds[array_rand($wardIds)],
            'address_detail' => fake()->address(),
            'maps_location' => null,
            'is_negotiate' => $isNegotiate,
            'cost' => $cost,
            'acreage' => rand(20, 50),
            'max_people_allowed' => $maxPeopleAllowed[array_rand($maxPeopleAllowed)],
            'room_type_id' => $roomTypes[array_rand($roomTypes)],
            'more_description' => fake()->paragraph(),
            'status' => 1,
            'is_sent_mail_to_user' => 1,
            'admin_id' => 1
        ];
    }
}
