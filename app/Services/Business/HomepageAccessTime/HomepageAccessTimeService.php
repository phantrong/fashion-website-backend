<?php

namespace App\Services\Business\HomepageAccessTime;

use App\Models\HomepageAccessTime;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;

class HomepageAccessTimeService extends BasesBusiness implements HomepageAccessTimeServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(HomepageAccessTime $homepageAccessTime)
    {
        $this->model = $homepageAccessTime;
        $this->repository = Repository::getHomepageAccessTime();
    }

    public function addAccessTime(array $data)
    {
        return $this->repository->addAccessTime($data);
    }

    public function getTotalAccessTimes(string $startTime = null, string $endTime = null)
    {
        return $this->repository->getTotalAccessTimes($startTime, $endTime);
    }
}
