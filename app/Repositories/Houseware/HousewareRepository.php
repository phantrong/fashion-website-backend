<?php

namespace App\Repositories\Houseware;

use App\Models\Houseware;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class HousewareRepository extends BaseRepository implements HousewareRepositoryInterface
{
    /**
     * HousewareRepository constructor.
     *
     * @param Houseware $houseware
     */
    public function __construct(Houseware $houseware)
    {
        parent::__construct($houseware);
    }

    /**
     * Get houseware detail.
     *
     * @param array $condition
     * @param $columns
     * @return Builder|Model
     */
    public function getHousewareDetail(array $condition, $columns = ['*'])
    {
        return $this->querySelect($condition, $columns)->first();
    }
}
