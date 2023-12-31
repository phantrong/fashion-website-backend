<?php

namespace App\Services\Business\District;

use App\Enum\DistrictEnum;
use App\Helpers\PaginationHelper;
use App\Models\District;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;
use Illuminate\Database\Eloquent\Model;

class DistrictService extends BasesBusiness implements DistrictServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(District $district)
    {
        $this->model = $district;
        $this->repository = Repository::getDistrict();
    }

    /**
     * List all.
     *
     * @param array $condition
     * @return array
     */
    public function getList(array $condition = [], $columns = DistrictEnum::COLUMNS_SELECT)
    {
        return $this->repository->getList($condition, $columns);
    }

    /**
     * Get district detail.
     *
     * @param $id
     * @return Model
     */
    public function getDetail($id)
    {
        $district = Repository::getDistrict()->getDistrictDetail([], DistrictEnum::COLUMNS_SELECT);
        if (!$district) {
            return null;
        }

        return $district;
    }
}
