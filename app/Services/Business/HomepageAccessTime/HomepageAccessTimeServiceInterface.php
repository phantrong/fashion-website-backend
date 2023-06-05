<?php

namespace App\Services\Business\HomepageAccessTime;

interface HomepageAccessTimeServiceInterface
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
