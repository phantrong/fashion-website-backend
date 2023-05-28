<?php

namespace App\Services\Business\Houseware;

use App\Enum\HousewareEnum;
use App\Helpers\PaginationHelper;
use App\Models\Houseware;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;
use Illuminate\Database\Eloquent\Model;

class HousewareService extends BasesBusiness implements HousewareServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(Houseware $houseware)
    {
        $this->model = $houseware;
        $this->repository = Repository::getHouseware();
    }

    /**
     * List all housewares.
     *
     * @param array $condition
     * @return array
     */
    public function getListByAdmin(array $condition)
    {
        [$condition['per_page'], $condition['page']] = PaginationHelper::getPaginationInput($condition);
        $housewares = Repository::getHouseware()->getListByAdmin($condition, HousewareEnum::COLUMNS_SELECT);

        return PaginationHelper::formatPagination($housewares, 'housewares');
    }

    /**
     * Get houseware detail.
     *
     * @param $id
     * @return Model
     */
    public function getDetail($id)
    {
        $houseware = Repository::getHouseware()->getHousewareDetail([], HousewareEnum::COLUMNS_SELECT);
        if (!$houseware) {
            return null;
        }

        return $houseware;
    }
}
