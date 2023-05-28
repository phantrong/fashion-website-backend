<?php

namespace App\Services\Business\RoomType;

use App\Enum\RoomTypeEnum;
use App\Models\RoomType;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;

class RoomTypeService extends BasesBusiness implements RoomTypeServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(RoomType $roomType)
    {
        $this->model = $roomType;
        $this->repository = Repository::getRoomType();
    }

    /**
     * List all.
     *
     * @param array $condition
     * @return array
     */
    public function getList(array $condition = [], $columns = RoomTypeEnum::COLUMNS_SELECT)
    {
        return $this->repository->getList($condition, $columns);
    }
}
