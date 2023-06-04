<?php

namespace App\Http\Controllers;

use App\Enum\CommonEnum;
use App\Enum\UserEnum;
use App\Enum\VerifyEnum;
use App\Http\Requests\RegisterUserRequest;
use App\Repositories\Repository;
use App\Services\Business;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function registerUser(RegisterUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only([
                'first_name',
                'last_name',
                'birthday',
                'email'
            ]);
            $data['password'] = Hash::make($request->password);

            $user = Business::getUser()->getUserByEmail($data['email']);
            if ($user && $user->status == UserEnum::STATUS_NEW) {
                $user->update($data);
            } else {
                $user = Business::getUser()->create($data);
            }
            $user->user_role = CommonEnum::USER_ROLE_USER;

            $this->sendEmailUserVerifyEmail($user, VerifyEnum::TYPE_REGISTER_SETTING_PWD);

            DB::commit();
            return $this->response()->success($user);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error(['registerUser']);
            throw $exception;
        }
    }

    public function verifyEmail(Request $request)
    {
        DB::beginTransaction();
        try {
            $verify = Repository::getVerify()->getVerifyByCode(
                $request->code,
                ['*'],
                [
                    'type' => VerifyEnum::TYPE_REGISTER_SETTING_PWD,
                    'user_role' => CommonEnum::USER_ROLE_USER
                ]
            );
            if (!$verify) {
                return $this->response()->errorCode(
                    __('message.common_error.not_item'),
                    JsonResponse::HTTP_NOT_ACCEPTABLE
                );
            }

            $user = Business::getUser()->getUserByEmail($verify->email_phone);
            if (!$user || $user->status != UserEnum::STATUS_NEW) {
                return $this->response()->errorCode(
                    __('message.common_error.not_item'),
                    JsonResponse::HTTP_NOT_ACCEPTABLE
                );
            }
            $user->status = UserEnum::STATUS_ACTIVE;
            $user->save();

            $verify->delete();
            DB::commit();
            return $this->response()->success();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error(['verifyEmail']);
            throw $exception;
        }
    }

    public function getUserProfile(Request $request)
    {
        try {
            $user = $this->getAuth($request);

            return $this->response()->success($user);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('[getUserProfile]');
            throw $exception;
        }
    }

    public function updateUserProfile(Request $request)
    {
        try {
            $user = $this->getAuth($request);

            $input = $request->only([
                'avatar',
                'first_name',
                'last_name',
                'birthday',
                'notifications_email',
            ]);

            $user->update($input);

            return $this->response()->success($user);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('[Update user]');
            throw $exception;
        }
    }
}
