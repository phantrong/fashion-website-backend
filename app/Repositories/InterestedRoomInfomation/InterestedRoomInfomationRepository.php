<?php

namespace App\Repositories\InterestedRoomInfomation;

use App\Models\InterestedRoomInfomation;
use App\Repositories\Base\BaseRepository;

class InterestedRoomInfomationRepository extends BaseRepository implements InterestedRoomInfomationRepositoryInterface
{
    /**
     * InterestedRoomInfomationRepository constructor.
     *
     * @param InterestedRoomInfomation $interestedRoomInfomation
     */
    public function __construct(InterestedRoomInfomation $interestedRoomInfomation)
    {
        parent::__construct($interestedRoomInfomation);
    }

    public function createOrUpdate($data)
    {
        $record = $this->model
            ->when(@$data['user_id'], function ($query) use ($data) {
                $query->where('user_id', $data['user_id']);
            })
            ->when(@$data['customer_id'], function ($query) use ($data) {
                $query->where('customer_id', $data['customer_id']);
            })
            ->where('district_id', $data['district_id'])
            ->where('ward_id', $data['ward_id'])
            ->where('room_type_id', $data['room_type_id'])
            ->first();

        if ($record) {
            $record->delete();
        }

        return $this->model->create([
            'user_id' => $data['user_id'],
            'customer_id' => $data['customer_id'],
            'district_id' => $data['district_id'],
            'ward_id' => $data['ward_id'],
            'room_type_id' => $data['room_type_id']
        ]);
    }

    public function getListByUserId($userId, $customerId = null)
    {
        return $this->model->select('id', 'district_id', 'ward_id', 'room_type_id')
            ->when($userId, function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->when($customerId, function ($query) use ($customerId) {
                $query->where('customer_id', $customerId);
            })
            ->orderByDesc('updated_at')
            ->limit(5)->get();
    }
}
