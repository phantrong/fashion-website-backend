<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     * Get user detail.
     *
     * @param array $condition
     * @param $columns
     * @return Builder|Model
     */
    public function getUserDetail(array $condition, $columns = ['*'])
    {
        return $this->querySelect($condition, $columns)->first();
    }
}
