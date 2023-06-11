<?php

namespace App\Services\Business\InterestedRoomInfomation;

use App\Models\InterestedRoomInfomation;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;

class InterestedRoomInfomationService extends BasesBusiness implements InterestedRoomInfomationServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(InterestedRoomInfomation $interestedRoomInfomation)
    {
        $this->model = $interestedRoomInfomation;
        $this->repository = Repository::getInterestedRoomInfomation();
    }

    public function createOrUpdate($data)
    {
        return $this->repository->createOrUpdate($data);
    }

    public function getListByUserId($userId, $customerId = null)
    {
        return $this->repository->getListByUserId($userId, $customerId);
    }
}
