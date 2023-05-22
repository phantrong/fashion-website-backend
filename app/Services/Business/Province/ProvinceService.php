<?php

namespace App\Services\Business\Province;

use App\Enum\ProvinceEnum;
use App\Helpers\PaginationHelper;
use App\Models\Province;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;
use Illuminate\Database\Eloquent\Model;

class ProvinceService extends BasesBusiness implements ProvinceServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(Province $province)
    {
        $this->model = $province;
        $this->repository = Repository::getProvince();
    }

    /**
     * List all provinces.
     *
     * @param array $condition
     * @return array
     */
    public function getList(array $condition)
    {
        [$condition['per_page'], $condition['page']] = PaginationHelper::getPaginationInput($condition);
        $provinces = Repository::getProvince()->getListPagination($condition, ProvinceEnum::COLUMNS_SELECT);

        return PaginationHelper::formatPagination($provinces, 'provinces');
    }

    /**
     * Get province detail.
     *
     * @param $id
     * @return Model
     */
    public function getDetail($id)
    {
        $province = Repository::getProvince()->getProvinceDetail([], ProvinceEnum::COLUMNS_SELECT);
        if (!$province) {
            return null;
        }

        return $province;
    }
}
