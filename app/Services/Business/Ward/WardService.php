<?php

namespace App\Services\Business\Ward;

use App\Enum\WardEnum;
use App\Helpers\PaginationHelper;
use App\Models\Ward;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;
use Illuminate\Database\Eloquent\Model;

class WardService extends BasesBusiness implements WardServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(Ward $ward)
    {
        $this->model = $ward;
        $this->repository = Repository::getWard();
    }

    /**
     * List all.
     *
     * @param array $condition
     * @return array
     */
    public function getList(array $condition = [], $columns = WardEnum::COLUMNS_SELECT)
    {
        return $this->repository->getList($condition, $columns);
    }

    /**
     * Get ward detail.
     *
     * @param $id
     * @return Model
     */
    public function getDetail($id)
    {
        $ward = Repository::getWard()->getWardDetail([], WardEnum::COLUMNS_SELECT);
        if (!$ward) {
            return null;
        }

        return $ward;
    }
}
