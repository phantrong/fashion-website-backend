<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddInterestedRoomItemRequest;
use App\Services\Business;
use App\Services\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InterestedRoomController extends Controller
{
    private $perpage = 10;

    public function addItem(AddInterestedRoomItemRequest $request)
    {
        try {
            $user = $this->getAuth($request);
            if (!$user) {
                $customerId = $request->header('customer_id');
                if (!$customerId) {
                    return Service::response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
                }
                $interestedRooms = Business::getInterestedRoom()->getInterestedRoomsByUserId(null, $customerId);
                if (!$interestedRooms) {
                    $interestedRooms = Business::getInterestedRoom()->create([
                        'customer_id' => $customerId,
                    ]);
                }
                Business::getInterestedRoomItem()->addItem([
                    'interested_room_id' => $interestedRooms->id,
                    'room_id' => $request->room_id,
                ]);

                return $this->response()->success();
            }
            $interestedRooms = Business::getInterestedRoom()->getInterestedRoomsByUserId($user->id);
            if (!$interestedRooms) {
                $interestedRooms = Business::getInterestedRoom()->create([
                    'user_id' => $user->id,
                ]);
            }
            Business::getInterestedRoomItem()->addItem([
                'interested_room_id' => $interestedRooms->id,
                'room_id' => $request->room_id,
            ]);

            return $this->response()->success();
        } catch (\Exception $exception) {
            Log::error(['addItem InterestedRoom']);
            throw $exception;
        }
    }

    public function getListByUser(Request $request)
    {
        try {
            $user = $this->getAuth($request);
            if (!$user) {
                $customerId = $request->header('customer_id');
                if (!$customerId) {
                    return Service::response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
                }
                $items = Business::getInterestedRoomItem()->getListItemByUserId(null, $customerId);

                return $this->response()->success($items);
            }
            $items = Business::getInterestedRoomItem()->getListItemByUserId($user->id);

            return $this->response()->success($items);
        } catch (\Exception $exception) {
            Log::error(['getListByUser InterestedRoom']);
            throw $exception;
        }
    }

    public function getListDetailByUser(Request $request)
    {
        try {
            $conditions = $request->only([
                'order_by_created_at',
                'order_by_room_created_at',
                'order_by_cost',
                'order_by_acreage'
            ]);
            $conditions['per_page'] = $request->per_page ?? $this->perpage;
            $conditions['page'] = $request->page ?? 1;

            $user = $this->getAuth($request);
            if (!$user) {
                $customerId = $request->header('customer_id');
                if (!$customerId) {
                    return Service::response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
                }
                $items = Business::getInterestedRoomItem()->getListDetailItemByUserId(null, $customerId, $conditions);

                return $this->response()->success($items);
            }
            $items = Business::getInterestedRoomItem()->getListDetailItemByUserId($user->id, null, $conditions);

            return $this->response()->success($items);
        } catch (\Exception $exception) {
            Log::error(['getListDetailByUser InterestedRoom']);
            throw $exception;
        }
    }
}
