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
            $dataUser = $this->getCustomerIdOrUserId($request);
            if (!$dataUser) return Service::response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
            $interestedRooms = Business::getInterestedRoom()->getInterestedRoomsByUserId(
                $dataUser['user_id'],
                $dataUser['customer_id']
            );
            if (!$interestedRooms) {
                $interestedRooms = Business::getInterestedRoom()->create([
                    'user_id' => $dataUser['user_id'],
                    'customer_id' => $dataUser['customer_id'],
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

    public function removeItem(Request $request)
    {
        try {
            $dataUser = $this->getCustomerIdOrUserId($request);
            if (!$dataUser) return Service::response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);

            $interestedRooms = Business::getInterestedRoom()->getInterestedRoomsByUserId(
                $dataUser['user_id'],
                $dataUser['customer_id']
            );
            if (!$interestedRooms) {
                return $this->response()->success();
            }
            
            Business::getInterestedRoomItem()->removeItem([
                'interested_room_id' => $interestedRooms->id,
                'item_id' => $request->item_id,
            ]);

            return $this->response()->success();
        } catch (\Exception $exception) {
            Log::error(['removeItem InterestedRoom']);
            throw $exception;
        }
    }

    public function getListByUser(Request $request)
    {
        try {
            $dataUser = $this->getCustomerIdOrUserId($request);
            if (!$dataUser) return Service::response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
            $items = Business::getInterestedRoomItem()->getListItemByUserId(
                $dataUser['user_id'],
                $dataUser['customer_id']
            );

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

            $dataUser = $this->getCustomerIdOrUserId($request);
            if (!$dataUser) return Service::response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
            $items = Business::getInterestedRoomItem()->getListDetailItemByUserId(
                $dataUser['user_id'],
                $dataUser['customer_id'],
                $conditions
            );

            return $this->response()->success($items);
        } catch (\Exception $exception) {
            Log::error(['getListDetailByUser InterestedRoom']);
            throw $exception;
        }
    }
}
