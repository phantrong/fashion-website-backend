<?php

namespace App\Services\Business\Admin;

use App\Enum\CommonEnum;
use App\Enum\AdminEnum;
use App\Helpers\PaginationHelper;
use App\Models\Admin;
use App\Repositories\Repository;
use App\Services\Business\BasesBusiness;
use App\Services\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class AdminService extends BasesBusiness implements AdminServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(Admin $admin)
    {
        $this->model = $admin;
        $this->repository = Repository::getAdmin();
    }

    /**
     * Create token.
     *
     * @param array $input
     * @return string
     */
    public function createToken(array $input)
    {
        return Service::getJWT()->encode($input, CommonEnum::USER_ROLE_ADMIN);
    }

    /**
     * List all admins.
     *
     * @param array $condition
     * @return array
     */
    public function getList(array $condition)
    {
        [$condition['per_page'], $condition['page']] = PaginationHelper::getPaginationInput($condition);
        $admins = Repository::getAdmin()->getListPagination($condition, AdminEnum::COLUMNS_SELECT);

        return PaginationHelper::formatPagination($admins, 'admins');
    }

    /**
     * Get admin detail.
     *
     * @param $id
     * @return Model
     */
    public function getDetail($id)
    {
        $admin = Repository::getAdmin()->getAdminDetail([], AdminEnum::COLUMNS_SELECT);
        if (!$admin) {
            return null;
        }

        return $admin;
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
        ]);
    }
}
