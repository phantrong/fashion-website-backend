<?php

namespace App\Repositories\Room;

use App\Models\Room;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RoomRepository extends BaseRepository implements RoomRepositoryInterface
{
    private $per_page = 10;

    /**
     * RoomRepository constructor.
     *
     * @param Room $room
     */
    public function __construct(Room $room)
    {
        parent::__construct($room);
    }

    public function getListByAdmin(array $condition)
    {
        $roomTable = $this->model->getTable();

        return $this->model->select([
            "$roomTable.id",
            "$roomTable.title",
            "$roomTable.province_id",
            "$roomTable.district_id",
            "$roomTable.ward_id",
            "$roomTable.address_detail",
            "$roomTable.room_type_id",
            "$roomTable.is_negotiate",
            "$roomTable.cost",
            "$roomTable.acreage",
            "$roomTable.status",
            "$roomTable.created_at",
            "$roomTable.updated_at",
        ])
            ->when(@$condition['admin_id'], function ($query) use ($condition, $roomTable) {
                $query->where("$roomTable.admin_id", $condition['admin_id']);
            })
            ->with([
                'province:id,name',
                'district:id,name',
                'ward:id,name',
                'roomType:id,name',
                'firstImage:id,room_id,type,link'
            ])
            ->paginate(@$condition['per_page'] ?? $this->per_page);
    }

    public function getDetailByAdmin($id, array $condition)
    {
        $roomTable = $this->model->getTable();

        return $this->model->select([
            "$roomTable.id",
            "$roomTable.title",
            "$roomTable.province_id",
            "$roomTable.district_id",
            "$roomTable.ward_id",
            "$roomTable.address_detail",
            "$roomTable.maps_location",
            "$roomTable.room_type_id",
            "$roomTable.is_negotiate",
            "$roomTable.cost",
            "$roomTable.acreage",
            "$roomTable.max_people_allowed",
            "$roomTable.status",
            "$roomTable.created_at",
            "$roomTable.updated_at",
        ])
            ->where("$roomTable.id", $id)
            ->when(@$condition['admin_id'], function ($query) use ($condition, $roomTable) {
                $query->where("$roomTable.admin_id", $condition['admin_id']);
            })
            ->with([
                'medias:id,room_id,type,link',
                'housewares:id,name',
            ])
            ->first();
    }

    /**
     * Get room detail.
     *
     * @param array $condition
     * @param $columns
     * @return Builder|Model
     */
    public function getRoomDetail(array $condition, $columns = ['*'])
    {
        return $this->querySelect($condition, $columns)->first();
    }
}
