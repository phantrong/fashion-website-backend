<?php

namespace App\Repositories\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface AdminRepositoryInterface
{
    /**
     * Get admin detail.
     *
     * @param array $condition
     * @param $columns
     * @return Builder|Model
     */
    public function getAdminDetail(array $condition, $columns = ['*']);
}
