<?php

namespace App\Services\Business\User;

use App\Enum\CommonEnum;
use App\Enum\UserEnum;
use App\Helpers\PaginationHelper;
use App\Repositories\Repository;
use App\Services\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class UserService implements UserServiceInterface
{
    /**
     * Create token.
     *
     * @param array $input
     * @return string
     */
    public function createToken(array $input)
    {
        return Service::getJWT()->encode($input);
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
     * Update user.
     *
     * @param $id
     * @param array $input
     * @return array
     */
    public function update($id, array $input)
    {
        $user = Repository::getUser()->getUserDetail([
            'id' => $id,
        ], UserEnum::COLUMNS_SELECT);
        if (!$user) {
            return [
                'message' => __('message.error.406'),
                'status' => JsonResponse::HTTP_NOT_ACCEPTABLE,
            ];
        }

        // Replace file name if input has file
        if (isset($input['avatar'])) {
            $oldAvatar = $input['avatar'];
            $input['avatar'] = Service::getFile()->replaceContentWithNewFileUrl(
                $input['avatar'],
                $input['avatar'],
                CommonEnum::FOLDER_USER
            );
        }

        Repository::getUser()->updateWithModel($user, $input);
        if (isset($oldAvatar)) {
            Service::getFile()->moveFile($oldAvatar, CommonEnum::FOLDER_USER);
        }

        return [];
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
