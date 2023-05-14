<?php

namespace App\Repositories\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    /**
     * Get user detail.
     *
     * @param array $condition
     * @param $columns
     * @return Builder|Model
     */
    public function getUserDetail(array $condition, $columns = ['*']);
}
