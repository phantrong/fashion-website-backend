<?php

namespace Database\Seeders;

use App\Repositories\Repository;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Repository::getCertificate()->upsert(
            [
                [
                    'id' => '02774480-c102-11ea-a0fb-065440ab2b1a',
                    'name' => 'AWS Certified Solution Architect Associate',
                    'invalid_year' => 3,
                ],
                [
                    'id' => '02774480-c102-11ea-a0fb-065440ab2b2b',
                    'name' => 'AWS Certified Solutions Architect Professional',
                    'invalid_year' => 3,
                ],
                [
                    'id' => '02774480-c102-11ea-a0fb-065440ab2b3c',
                    'name' => 'Professional Scrum Master I',
                    'invalid_year' => null,
                ],
                [
                    'id' => '02774480-c102-11ea-a0fb-065440ab2b4d',
                    'name' => 'Professional Scrum Master II',
                    'invalid_year' => null,
                ],
                [
                    'id' => '02774480-c102-11ea-a0fb-065440ab2b5e',
                    'name' => 'Professional Scrum Master III',
                    'invalid_year' => null,
                ],
                [
                    'id' => '02774480-c102-11ea-a0fb-065440ab2b6f',
                    'name' => 'Project Management Professional',
                    'invalid_year' => 10,
                ],
            ],
            'id'
        );
    }
}
