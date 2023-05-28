<?php

namespace App\Services\Business\User;

use App\Enum\CommonEnum;
use App\Enum\UserEnum;
use App\Helpers\PaginationHelper;
use App\Models\User;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;
use App\Services\Service;
use Illuminate\Database\Eloquent\Model;

class UserService extends BasesBusiness implements UserServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(User $user)
    {
        $this->model = $user;
        $this->repository = Repository::getUser();
    }

    /**
     * Create token.
     *
     * @param array $input
     * @return string
     */
    public function createToken(array $input)
    {
        return Service::getJWT()->encode($input, CommonEnum::USER_ROLE_USER);
    }

    /**
     * List all users.
     *
     * @param array $condition
     * @return array
     */
    public function getList(array $condition)
    {
        [$condition['per_page'], $condition['page']] = PaginationHelper::getPaginationInput($condition);
        $users = Repository::getUser()->getListPagination($condition, UserEnum::COLUMNS_SELECT);

        return PaginationHelper::formatPagination($users, 'users');
    }

    /**
     * Get user detail.
     *
     * @param $id
     * @return Model
     */
    public function getDetail($id)
    {
        $user = Repository::getUser()->getUserDetail([], UserEnum::COLUMNS_SELECT);
        if (!$user) {
            return null;
        }

        return $user;
    }

    /**
     * Destroy token.
     *
     * @param string $token
     */
    public function destroyToken(string $token)
    {
        Repository::getInvalidToken()->create([
            'token' => $token,
            'user_role' => CommonEnum::USER_ROLE_USER,
        ]);
    }

    public function getUserByEmail($email)
    {
        $user = Repository::getUser()->getUserDetail([
            'email' => $email
        ], UserEnum::COLUMNS_SELECT);
        if (!$user) {
            return null;
        }

        return $user;
    }
}
