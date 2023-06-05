<?php

namespace App\Repositories\RoomViewTime;

use App\Enum\CommonEnum;
use App\Models\RoomViewTime;
use App\Repositories\Base\BaseRepository;

class RoomViewTimeRepository extends BaseRepository implements RoomViewTimeRepositoryInterface
{
    /**
     * RoomViewTimeRepository constructor.
     *
     * @param RoomViewTime $roomViewTime
     */
    public function __construct(RoomViewTime $roomViewTime)
    {
        parent::__construct($roomViewTime);
    }

    public function addViewTime(array $data)
    {
        if (!@$data['address_ip'] || !@$data['user_agent'] || !@$data['room_id']) return;

        $record = $this->model->where('address_ip', $data['address_ip'])
            ->where('user_agent', $data['user_agent'])
            ->where('room_id', $data['room_id'])
            ->orderByDesc('created_at')
            ->first();

        if (
            $record &&
            getNow()->subMinutes(CommonEnum::ACCESS_VIEW_DISTANCE_TIME_MINUTE) < getTimeParse($record->created_at)
        ) {
            return;
        }

        return $this->model->create($data);
    }

    public function getTotalViewTimesByRoomId(int $roomId, string $startTime = null, string $endTime = null)
    {
        return $this->model
            ->where('room_id', $roomId)
            ->when($startTime && $endTime, function ($query) use ($startTime, $endTime) {
                $query->whereDate('created_at', '>=', $startTime)
                    ->whereDate('created_at', '<=', $endTime);
            })
            ->when(!$startTime && $endTime, function ($query) use ($endTime) {
                $query->whereDate('created_at', '<=', $endTime);
            })
            ->when($startTime && !$endTime, function ($query) use ($startTime) {
                $query->whereDate('created_at', '>=', $startTime);
            })
            ->count();
    }
}
