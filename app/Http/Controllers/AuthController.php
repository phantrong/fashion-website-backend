<?php

namespace App\Http\Controllers;

use App\Enum\AdminEnum;
use App\Enum\UserEnum;
use App\Http\Requests\LoginGoogleRequest;
use App\Http\Requests\LoginRequest;
use App\Services\Business;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Login.
     *
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function loginUser(LoginRequest $request)
    {
        $input = $request->only('email', 'password');
        if (!Auth::attempt($input)) {
            return $this->response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();
        if (!$user || $user->status == AdminEnum::STATUS_NEW) {
            return $this->response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
        }
        if ($user->status == AdminEnum::STATUS_BLOCK) {
            return $this->response()->errorCode(__('message.user.blocked'), JsonResponse::HTTP_NOT_ACCEPTABLE);
        }

        return $this->responseTokenByUser($user);
    }

    public function loginUserByGoogle(LoginGoogleRequest $request)
    {
        DB::beginTransaction();
        try {
            $dataRequest = $request->only([
                'email',
                'given_name',
                'family_name',
                'picture',
                'sub'
            ]);

            $user = Business::getUser()->getUserByEmail($dataRequest['email'], ['*']);

            if ($user) {
                if ($user->status == AdminEnum::STATUS_NEW || !Hash::check($dataRequest['sub'], $user->google_id)) {
                    return $this->response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
                }
                if ($user->status == AdminEnum::STATUS_BLOCK) {
                    return $this->response()->errorCode(__('message.user.blocked'), JsonResponse::HTTP_NOT_ACCEPTABLE);
                }
                if (!$user->google_id) {
                    $user->google_id = Hash::make($dataRequest['sub']);
                    $user->save();
                }
            } else {
                $newUser = [
                    'first_name' => $dataRequest['given_name'],
                    'last_name' => $dataRequest['family_name'],
                    'avatar' => $dataRequest['picture'],
                    'email' => $dataRequest['email'],
                    'password' => Hash::make(bin2hex(random_bytes(10))),
                    'status' => UserEnum::STATUS_ACTIVE,
                    'notifications_email' => 1,
                    'google_id' => Hash::make($dataRequest['sub']),
                ];

                $user = Business::getUser()->create($newUser);
            }
            DB::commit();
            return $this->responseTokenByUser($user);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error(['loginUserByGoogle']);
            throw $exception;
        }
    }

    private function responseTokenByUser($user)
    {
        $dataToken = [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'birthday' => $user->birthday,
            'avatar' => $user->avatar,
            'notifications_email' => $user->notifications_email,
            'status' => $user->status,
            'is_google_auth' => $user->google_id ? 1 : 0
        ];

        $accessToken = Business::getUser()->createToken($dataToken);

        return $this->response()->success([
            'token' => $accessToken,
            'user' => $dataToken
        ]);
    }

    /**
     * Logout for user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logoutUser(Request $request)
    {
        Business::getUser()->destroyToken($request->bearerToken());

        return $this->response()->success();
    }

    /**
     * Login.
     *
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function loginAdmin(LoginRequest $request)
    {
        $input = $request->only('email', 'password');
        if (!Auth::guard('admin')->attempt($input)) {
            return $this->response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
        }
        $admin = Auth::guard('admin')->user();
        if (!$admin || $admin->status == AdminEnum::STATUS_NEW) {
            return $this->response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
        }
        if ($admin->status == AdminEnum::STATUS_BLOCK) {
            return $this->response()->error(__('message.error.406'), JsonResponse::HTTP_NOT_ACCEPTABLE);
        }
        $dataToken = [
            'id' => $admin->id,
            'name' => $admin->name,
            'type' => $admin->type,
            'status' => $admin->status
        ];

        $accessToken = Business::getAdmin()->createToken($dataToken);

        return $this->response()->success([
            'token' => $accessToken,
            'admin' => $dataToken
        ]);
    }

    /**
     * Logout for Admin
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logoutAdmin(Request $request)
    {
        Business::getAdmin()->destroyToken($request->bearerToken());

        return $this->response()->success();
    }
}
