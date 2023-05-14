<?php

namespace Database\Seeders;

use App\Enum\UserEnum;
use App\Repositories\Repository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Repository::getUser()->upsert(
            [
                [
                    'id' => '02774480-c102-11ea-a0fb-0654403b1a1a',
                    'avatar' => null,
                    'name' => 'Satou Hikaru',
                    'gender' => UserEnum::GENDER_MALE,
                    'birthday' => '1997-01-22',
                    'email' => 'hikaru@gmail.com',
                    'password' => Hash::make('chikuso'),
                ],
                [
                    'id' => '02774480-c102-11ea-a0fb-0654403b1a2b',
                    'avatar' => null,
                    'name' => 'Sanada Yukimura',
                    'gender' => UserEnum::GENDER_MALE,
                    'birthday' => '1997-06-03',
                    'email' => 'yukimura@gmail.com',
                    'password' => Hash::make('chikuso'),
                ],
                [
                    'id' => '02774480-c102-11ea-a0fb-0654403b1a3c',
                    'avatar' => null,
                    'name' => 'Kunoichi',
                    'gender' => UserEnum::GENDER_FEMALE,
                    'birthday' => '1998-10-30',
                    'email' => 'kunoichi@gmail.com',
                    'password' => Hash::make('chikuso'),
                ],
            ],
            'id'
        );
    }
}
