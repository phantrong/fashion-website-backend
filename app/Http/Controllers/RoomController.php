<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Services\Business;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    private $perpage = 10;

    public function getListByAdmin(Request $request)
    {
        try {
            $auth = $this->getAuth($request);

            $conditions = [
                'per_page' => $request->per_page ?? $this->perpage,
                'page' => $request->page ?? 1,
                'admin_id' => $auth->id
            ];

            $rooms = Business::getRoom()->getList($conditions);
            return $this->response()->success($rooms);
        } catch (\Exception $exception) {
            Log::error(['getListByAdmin Room']);
            throw $exception;
        }
    }

    public function getDetailByAdmin(Request $request, $id)
    {
        try {
            $auth = $this->getAuth($request);

            $conditions = [
                'admin_id' => $auth->id
            ];

            $room = Business::getRoom()->getDetail($conditions, $id);

            if (!$room) {
                return $this->response()->errorCode(
                    __('message.common_error.not_item'),
                    JsonResponse::HTTP_NOT_ACCEPTABLE
                );
            }

            return $this->response()->success($room);
        } catch (\Exception $exception) {
            Log::error(['getDetailByAdmin Room']);
            throw $exception;
        }
    }

    public function createByAdmin(RoomRequest $request)
    {
        DB::beginTransaction();
        try {
            $auth = $this->getAuth($request);

            $data = $request->only([
                'title',
                'province_id',
                'district_id',
                'ward_id',
                'address_detail',
                'maps_location',
                'is_negotiate',
                'cost',
                'acreage',
                'max_people_allowed',
                'room_type_id',
                'more_description',
                'status'
            ]);
            $data['admin_id'] = $auth->id;

            $room = Business::getRoom()->create($data);

            $roomHousewares = [];
            foreach ($request->room_housewares as $houseware) {
                $roomHousewares[] = [
                    'houseware_id' => $houseware->houseware_id,
                    'room_id' => $room->id,
                    'created_at' => getDateTimeNow(),
                    'updated_at' => getDateTimeNow()
                ];
            }
            if (empty($roomHousewares)) {
                Business::getRoomHouseware()->insert($roomHousewares);
            }

            $roomMedias = [];
            foreach ($request->room_medias as $media) {
                $roomMedias[] = [
                    'room_id' => $room->id,
                    'link' => $media->link,
                    'type' => $media->type,
                    'created_at' => getDateTimeNow(),
                    'updated_at' => getDateTimeNow()
                ];
            }
            if (empty($roomMedias)) {
                Business::getRoomMedia()->insert($roomMedias);
            }
            DB::commit();
            return $this->response()->success($room);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error(['createByAdmin Room']);
            throw $exception;
        }
    }

    public function updateByAdmin(RoomRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $auth = $this->getAuth($request);

            $conditions = [
                'admin_id' => $auth->id
            ];

            $room = Business::getRoom()->getDetail($conditions, $id);

            if (!$room) {
                return $this->response()->errorCode(
                    __('message.common_error.not_item'),
                    JsonResponse::HTTP_NOT_ACCEPTABLE
                );
            }

            $data = $request->only([
                'title',
                'province_id',
                'district_id',
                'ward_id',
                'address_detail',
                'maps_location',
                'is_negotiate',
                'cost',
                'acreage',
                'max_people_allowed',
                'room_type_id',
                'more_description',
                'status'
            ]);

            $room->update($data);

            $roomHousewares = [];
            foreach ($request->room_housewares as $houseware) {
                if ($houseware->id && $houseware->deleted_at) {
                    Business::getRoomHouseware()->delete($houseware->id);
                } elseif ($houseware->id) {
                    Business::getRoomHouseware()->update(
                        ['id' => $houseware->id],
                        [
                            'houseware_id' => $houseware->houseware_id,
                            'updated_at' => getDateTimeNow()
                        ]
                    );
                } else {
                    $roomHousewares[] = [
                        'houseware_id' => $houseware->houseware_id,
                        'room_id' => $room->id,
                        'created_at' => getDateTimeNow(),
                        'updated_at' => getDateTimeNow()
                    ];
                }
            }
            if (empty($roomHousewares)) {
                Business::getRoomHouseware()->insert($roomHousewares);
            }

            $roomMedias = [];
            foreach ($request->room_medias as $media) {
                if ($media->id && $media->deleted_at) {
                    Business::getRoomMedia()->delete($media->id);
                } elseif ($media->id) {
                    Business::getRoomMedia()->update(
                        ['id' => $media->id],
                        [
                            'link' => $media->link,
                            'type' => $media->type,
                            'updated_at' => getDateTimeNow()
                        ]
                    );
                } else {
                    $roomMedias[] = [
                        'room_id' => $room->id,
                        'link' => $media->link,
                        'type' => $media->type,
                        'created_at' => getDateTimeNow(),
                        'updated_at' => getDateTimeNow()
                    ];
                }
            }
            if (empty($roomMedias)) {
                Business::getRoomMedia()->insert($roomMedias);
            }
            DB::commit();
            return $this->response()->success($room);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error(['updateByAdmin Room']);
            throw $exception;
        }
    }

    public function deleteByAdmin(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $auth = $this->getAuth($request);

            $conditions = [
                'admin_id' => $auth->id
            ];

            $room = Business::getRoom()->getDetail($conditions, $id);

            if (!$room) {
                return $this->response()->errorCode(
                    __('message.common_error.not_item'),
                    JsonResponse::HTTP_NOT_ACCEPTABLE
                );
            }

            Business::getRoomHouseware()->deleteByRoomId($room->id);
            Business::getRoomMedia()->deleteByRoomId($room->id);
            $room->delete();

            DB::commit();
            return $this->response()->success();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error(['deleteByAdmin Room']);
            throw $exception;
        }
    }
}
