<?php

namespace App\Http\Controllers;

use App\Enum\CommonEnum;
use App\Enum\RoomEnum;
use App\Http\Requests\FileMediaRequest;
use App\Http\Requests\RoomRequest;
use App\Services\Business;
use App\Services\Service;
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
            if ($request->key_word) {
                $conditions['key_word'] = $request->key_word;
            }
            $rooms = Business::getRoom()->getListByAdmin($conditions);
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

            $room = Business::getRoom()->getDetailByAdmin($id, $conditions);

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

    /**
     * Upload file.
     *
     * @param FileRequest $request
     * @return JsonResponse
     */
    public function uploadMedia(FileMediaRequest $request)
    {
        $urlFile = Service::getFile()->store($request->file, CommonEnum::FOLDER_TEMP_MEDIA);

        return $this->response()->success([
            'url_file' => $urlFile,
        ]);
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
            if ($request->room_housewares) {
                foreach ($request->room_housewares as $houseware) {
                    $roomHousewares[] = [
                        'houseware_id' => $houseware['houseware_id'],
                        'room_id' => $room->id,
                        'created_at' => getDateTimeNow(),
                        'updated_at' => getDateTimeNow()
                    ];
                }
            }
            if (!empty($roomHousewares)) {
                Business::getRoomHouseware()->insert($roomHousewares);
            }

            $roomMedias = [];
            foreach ($request->room_medias as $media) {
                $urlFile = Service::getFile()->moveFile(
                    $media['link'],
                    CommonEnum::FOLDER_MEDIA,
                    CommonEnum::FOLDER_TEMP_MEDIA
                );
                if (count($roomMedias) < RoomEnum::MAX_NUMBER_VIDEO_AND_IMAGE) {
                    $roomMedias[] = [
                        'room_id' => $room->id,
                        'link' => $urlFile,
                        'type' => $media['type'],
                        'created_at' => getDateTimeNow(),
                        'updated_at' => getDateTimeNow()
                    ];
                }
            }
            if (!empty($roomMedias)) {
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
            if ($request->room_housewares) {
                foreach ($request->room_housewares as $houseware) {
                    if (@$houseware['id'] && @$houseware['deleted_at']) {
                        Business::getRoomHouseware()->delete(['id' => $houseware['id']]);
                    } elseif (@$houseware['id']) {
                        Business::getRoomHouseware()->update(
                            ['id' => $houseware['id']],
                            [
                                'houseware_id' => $houseware['houseware_id'],
                                'updated_at' => getDateTimeNow()
                            ]
                        );
                    } else {
                        $roomHousewares[] = [
                            'houseware_id' => $houseware['houseware_id'],
                            'room_id' => $room->id,
                            'created_at' => getDateTimeNow(),
                            'updated_at' => getDateTimeNow()
                        ];
                    }
                }
            }
            if (!empty($roomHousewares)) {
                Business::getRoomHouseware()->insert($roomHousewares);
            }

            $roomMedias = [];
            $countRoomMedias = count($room->medias());
            foreach ($request->room_medias as $media) {
                if (@$media['id'] && @$media['deleted_at']) {
                    Business::getRoomMedia()->delete(['id' => $media['id']]);
                    $countRoomMedias--;
                } elseif (@$media['id']) {
                    $urlFile = $media['link'];
                    if (str_contains($media['link'], CommonEnum::FOLDER_TEMP_MEDIA)) {
                        $urlFile = Service::getFile()->moveFile(
                            $media['link'],
                            CommonEnum::FOLDER_MEDIA,
                            CommonEnum::FOLDER_TEMP_MEDIA
                        );
                    }
                    Business::getRoomMedia()->update(
                        ['id' => $media['id']],
                        [
                            'link' => $urlFile,
                            'type' => $media['type'],
                            'updated_at' => getDateTimeNow()
                        ]
                    );
                } else {
                    $urlFile = Service::getFile()->moveFile(
                        $media['link'],
                        CommonEnum::FOLDER_MEDIA,
                        CommonEnum::FOLDER_TEMP_MEDIA
                    );
                    if ($countRoomMedias + count($roomMedias) < RoomEnum::MAX_NUMBER_VIDEO_AND_IMAGE) {
                        $roomMedias[] = [
                            'room_id' => $room->id,
                            'link' => $urlFile,
                            'type' => $media['type'],
                            'created_at' => getDateTimeNow(),
                            'updated_at' => getDateTimeNow()
                        ];
                    }
                }
            }
            if (!empty($roomMedias)) {
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

    public function getListRoomType()
    {
        try {
            $roomTypes = Business::getRoomType()->getList();
            return $this->response()->success($roomTypes);
        } catch (\Exception $exception) {
            Log::error(['getListRoomType']);
            throw $exception;
        }
    }

    public function getListSearchByUser(Request $request)
    {
        try {
            $conditions = $request->only([
                'admin_id',
                'room_type_id',
                'province_id',
                'district_id',
                'ward_id',
                'is_negotiate',
                'start_cost',
                'end_cost',
                'start_acreage',
                'end_acreage',
                'key_word',
                'order_by_created_at',
                'order_by_cost',
                'order_by_acreage'
            ]);
            $conditions['per_page'] = $request->per_page ?? $this->perpage;
            $conditions['page'] = $request->page ?? 1;

            $dataUser = $this->getCustomerIdOrUserId($request);
            if (!$dataUser) return Service::response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);

            if ($conditions['key_word']) {
                Business::getHistorySearchKeyWord()->createOrUpdate(
                    $conditions['key_word'],
                    $dataUser['user_id'],
                    $dataUser['customer_id'],
                );
            }

            $rooms = Business::getRoom()->getListSearchByUser($conditions);
            return $this->response()->success($rooms);
        } catch (\Exception $exception) {
            Log::error(['getListSearchByUser Room']);
            throw $exception;
        }
    }

    public function getDetailByUser(Request $request, $id)
    {
        try {
            $room = Business::getRoom()->getDetailByUser($id, []);

            if (!$room) {
                return $this->response()->errorCode(
                    __('message.common_error.not_item'),
                    JsonResponse::HTTP_NOT_ACCEPTABLE
                );
            }

            // view time
            $dataUser = $this->getCustomerIdOrUserId($request);
            if (!$dataUser) return Service::response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
            $dataView = [
                'address_ip' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'room_id' => $room->id,
                'user_id' => $dataUser['user_id'],
                'customer_id' => $dataUser['customer_id'],
            ];
            Business::getRoomViewTime()->addViewTime($dataView);

            $room->total_view_times = Business::getRoomViewTime()->getTotalViewTimesByRoomId($room->id);

            return $this->response()->success($room);
        } catch (\Exception $exception) {
            Log::error(['getDetailByUser Room']);
            throw $exception;
        }
    }

    public function getCountRoomByAddressHomepage(Request $request)
    {
        try {
            $conditions['per_page'] = $request->per_page ?? $this->perpage;
            $conditions['page'] = $request->page ?? 1;

            $rooms = Business::getRoom()->getCountRoomInHanoi($conditions);
            return $this->response()->success($rooms);
        } catch (\Exception $exception) {
            Log::error(['getCountRoomByAddressHomepage Room']);
            throw $exception;
        }
    }

    public function getListRelatedByDetail(Request $request, $id)
    {
        try {
            $room = Business::getRoom()->getDetailByUser($id, []);

            if (!$room) {
                return $this->response()->errorCode(
                    __('message.common_error.not_item'),
                    JsonResponse::HTTP_NOT_ACCEPTABLE
                );
            }

            $conditions = [
                'per_page' => $request->per_page ?? $this->perpage,
                'page' => $request->page ?? 1,
                'room_type_id' => $room->room_type_id,
                'province_id' => $room->province_id,
                'district_id' => $room->district_id,
                'ward_id' => $room->ward_id,
                'not_in_ids' => [$room->id]
            ];

            $rooms = Business::getRoom()->getListSearchByUser($conditions);

            return $this->response()->success($rooms);
        } catch (\Exception $exception) {
            Log::error(['getListRelatedByDetail Room']);
            throw $exception;
        }
    }

    public function getListRoomHistoryViewByUser(Request $request)
    {
        try {
            $dataUser = $this->getCustomerIdOrUserId($request);
            if (!$dataUser) return Service::response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
            $roomIds = Business::getRoomViewTime()->getHistoryArrayRoomIdsByUserId(
                $dataUser['user_id'],
                $dataUser['customer_id'],
            );
            $conditions = [
                'per_page' => $request->per_page ?? $this->perpage,
                'page' => $request->page ?? 1,
                'in_ids' => $roomIds
            ];

            $rooms = Business::getRoom()->getListSearchByUser($conditions);

            return $this->response()->success($rooms);
        } catch (\Exception $exception) {
            Log::error(['getListRoomHistoryViewByUser Room']);
            throw $exception;
        }
    }

    public function getListHistorySearchKeyWord(Request $request)
    {
        try {
            $dataUser = $this->getCustomerIdOrUserId($request);
            if (!$dataUser) return Service::response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);
            $keyWords = Business::getHistorySearchKeyWord()->getListByUserId(
                $dataUser['user_id'],
                $dataUser['customer_id'],
            );

            return $this->response()->success($keyWords);
        } catch (\Exception $exception) {
            Log::error(['getListHistorySearchKeyWord Room']);
            throw $exception;
        }
    }

    public function deleteHistorySearchKeyWord(Request $request, $id)
    {
        try {
            $dataUser = $this->getCustomerIdOrUserId($request);
            if (!$dataUser) return Service::response()->error(__('message.error.401'), JsonResponse::HTTP_UNAUTHORIZED);

            $keyWord = Business::getHistorySearchKeyWord()->find($id);

            if (
                !$keyWord || ($dataUser['user_id'] != $keyWord->user_id &&
                    $dataUser['customer_id'] != $keyWord->customer_id)
            ) {
                return $this->response()->errorCode(
                    __('message.common_error.not_item'),
                    JsonResponse::HTTP_NOT_ACCEPTABLE
                );
            }

            $keyWord->delete();

            return $this->response()->success();
        } catch (\Exception $exception) {
            Log::error(['deleteHistorySearchKeyWord Room']);
            throw $exception;
        }
    }
}
