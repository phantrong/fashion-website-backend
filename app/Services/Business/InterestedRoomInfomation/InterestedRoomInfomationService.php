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
}
