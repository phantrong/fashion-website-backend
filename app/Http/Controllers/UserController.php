<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserListRequest;
use App\Http\Requests\UserRequest;
use App\Services\Business;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Get the list of users.
     *
     * @param UserListRequest $request
     * @return JsonResponse
     */
    public function list(UserListRequest $request)
    {
        $input = $request->only([
            'per_page',
            'page',
        ]);
        $users = Business::getUser()->getList($input);

        return $this->response()->success($users);
    }

    /**
     * Get user detail.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getDetail($id)
    {
        $user = Business::getUser()->getDetail($id);
        if (!$user) {
            return $this->response()->error(__('message.error.406'), JsonResponse::HTTP_NOT_ACCEPTABLE);
        }

        return $this->response()->success($user);
    }

    /**
     * Get user detail.
     *
     * @param int $id
     * @param UserRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function update($id, UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $input = $request->only([
                'avatar',
                'name',
                'gender',
                'birthday',
                'email',
            ]);
            $data = Business::getUser()->update($id, $input);
            if (isset($data['message']) && isset($data['status'])) {
                DB::rollBack();

                return $this->response()->error($data['message'], $data['status']);
            }
            DB::commit();

            return $this->response()->success();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('[Update user]');
            throw $exception;
        }
    }
}
