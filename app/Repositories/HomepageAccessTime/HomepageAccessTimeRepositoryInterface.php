<?php

namespace App\Repositories\HomepageAccessTime;

interface HomepageAccessTimeRepositoryInterface
{
    /**
     * addAccessTime
     *
     * @param  array $data
     * @return void
     */
    public function addAccessTime(array $data);

    /**
     * getTotalAccessTimes
     *
     * @param  string $startTime
     * @param  string $endTime
     * @return int
     */
    public function getTotalAccessTimes(string $startTime = null, string $endTime = null);
}
