<?php

namespace Database\Seeders;

use App\Repositories\Repository;
use Illuminate\Database\Seeder;

class UserCertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Repository::getUserCertificate()->upsert(
            [
                [
                    'id' => '02774480-c102-11ea-a0fb-0654403b3c1a',
                    'user_id' => '02774480-c102-11ea-a0fb-0654403b1a1a',
                    'certificate_id' => '02774480-c102-11ea-a0fb-065440ab2b3c',
                    'expiration_date' => null,
                ],
                [
                    'id' => '02774480-c102-11ea-a0fb-0654403b3c2b',
                    'user_id' => '02774480-c102-11ea-a0fb-0654403b1a1a',
                    'certificate_id' => '02774480-c102-11ea-a0fb-065440ab2b4d',
                    'expiration_date' => null,
                ],
                [
                    'id' => '02774480-c102-11ea-a0fb-0654403b3c3c',
                    'user_id' => '02774480-c102-11ea-a0fb-0654403b1a1a',
                    'certificate_id' => '02774480-c102-11ea-a0fb-065440ab2b5e',
                    'expiration_date' => null,
                ],
                [
                    'id' => '02774480-c102-11ea-a0fb-0654403b3c4d',
                    'user_id' => '02774480-c102-11ea-a0fb-0654403b1a1a',
                    'certificate_id' => '02774480-c102-11ea-a0fb-065440ab2b6f',
                    'expiration_date' => now()->addYears(10),
                ],
            ],
            'id'
        );
    }
}
