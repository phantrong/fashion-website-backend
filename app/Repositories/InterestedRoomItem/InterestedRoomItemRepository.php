<?php

namespace App\Repositories\InterestedRoomItem;

use App\Enum\AdminEnum;
use App\Enum\RoomEnum;
use App\Models\Admin;
use App\Models\District;
use App\Models\InterestedRoom;
use App\Models\InterestedRoomItem;
use App\Models\Province;
use App\Models\Room;
use App\Models\Ward;
use App\Repositories\Base\BaseRepository;

class InterestedRoomItemRepository extends BaseRepository implements InterestedRoomItemRepositoryInterface
{
    private $per_page = 10;

    /**
     * InterestedRoomItemRepository constructor.
     *
     * @param InterestedRoomItem $interestedRoomItem
     */
    public function __construct(InterestedRoomItem $interestedRoomItem)
    {
        parent::__construct($interestedRoomItem);
    }

    public function addItem($data)
    {
        if (!@$data['interested_room_id'] || !@$data['room_id']) return;
        $record = $this->model->where('interested_room_id', $data['interested_room_id'])
            ->where('room_id', $data['room_id'])->first();
        if ($record) return;

        $this->model->create($data);
    }

    public function removeItem($data)
    {
        if (!@$data['interested_room_id'] || !@$data['item_id']) return;

        return $this->model->where('interested_room_id', $data['interested_room_id'])
            ->where('id', $data['item_id'])->delete();
    }

    public function getListItemByUserId($userId, $customerId = null)
    {
        $interestedRoomItemTable = $this->model->getTable();
        $interestedRoomTable = InterestedRoom::getTableName();
        $roomTable = Room::getTableName();

        return $this->model
            ->select(
                "$interestedRoomItemTable.id as item_id",
                "$roomTable.id as room_id",
                "$roomTable.title as room_title",
                "$interestedRoomItemTable.created_at as created_at",
            )
            ->join($interestedRoomTable, "$interestedRoomTable.id", '=', "$interestedRoomItemTable.interested_room_id")
            ->join($roomTable, "$roomTable.id", '=', "$interestedRoomItemTable.room_id")
            ->when($userId, function ($query) use ($userId, $interestedRoomTable) {
                $query->where("$interestedRoomTable.user_id", $userId);
            })
            ->when($customerId, function ($query) use ($customerId, $interestedRoomTable) {
                $query->where("$interestedRoomTable.customer_id", $customerId);
            })
            ->where("$roomTable.status", RoomEnum::STATUS_SHOW)
            ->whereNull("$roomTable.deleted_at")
            ->orderByDesc("$interestedRoomItemTable.created_at")
            ->with([
                'room:id',
                'room.firstImage:id,room_id,type,link'
            ])
            ->paginate(5);
    }

    public function getListDetailItemByUserId($userId, $customerId = null, $condition = [])
    {
        $interestedRoomItemTable = $this->model->getTable();
        $interestedRoomTable = InterestedRoom::getTableName();
        $roomTable = Room::getTableName();
        $provinceTable = Province::getTableName();
        $districtTable = District::getTableName();
        $wardTable = Ward::getTableName();
        $adminTable = Admin::getTableName();

        return $this->model
            ->select(
                "$interestedRoomItemTable.id as item_id",
                "$interestedRoomItemTable.room_id as room_id",
                "$roomTable.title",
                "$roomTable.province_id",
                "$provinceTable.name as province_name",
                "$roomTable.district_id",
                "$districtTable.name as district_name",
                "$roomTable.ward_id",
                "$wardTable.name as ward_name",
                "$roomTable.address_detail",
                "$roomTable.room_type_id",
                "$roomTable.is_negotiate",
                "$roomTable.cost",
                "$roomTable.acreage",
                "$roomTable.status",
                "$roomTable.created_at",
                "$roomTable.updated_at",
                "$adminTable.id as admin_id",
                "$adminTable.name as admin_name"
            )
            ->join($interestedRoomTable, "$interestedRoomTable.id", '=', "$interestedRoomItemTable.interested_room_id")
            ->join($roomTable, "$roomTable.id", '=', "$interestedRoomItemTable.room_id")
            ->join($provinceTable, "$provinceTable.id", '=', "$roomTable.province_id")
            ->join($districtTable, "$districtTable.id", '=', "$roomTable.district_id")
            ->join($wardTable, "$wardTable.id", '=', "$roomTable.ward_id")
            ->join($adminTable, "$adminTable.id", '=', "$roomTable.admin_id")
            ->when($userId, function ($query) use ($userId, $interestedRoomTable) {
                $query->where("$interestedRoomTable.user_id", $userId);
            })
            ->when($customerId, function ($query) use ($customerId, $interestedRoomTable) {
                $query->where("$interestedRoomTable.customer_id", $customerId);
            })
            ->where("$roomTable.status", RoomEnum::STATUS_SHOW)
            ->where("$adminTable.status", AdminEnum::STATUS_ACTIVE)
            ->whereNull("$roomTable.deleted_at")
            // order by
            ->when(in_array(@$condition['order_by_created_at'], ['asc', 'desc']), function ($query)
            use ($condition, $interestedRoomItemTable) {
                $query->orderBy("$interestedRoomItemTable.created_at", $condition['order_by_created_at']);
            })
            ->when(in_array(@$condition['order_by_room_created_at'], ['asc', 'desc']), function ($query)
            use ($condition, $roomTable) {
                $query->orderBy("$roomTable.created_at", $condition['order_by_room_created_at']);
            })
            ->when(in_array(@$condition['order_by_cost'], ['asc', 'desc']), function ($query)
            use ($condition, $roomTable) {
                $query->orderBy("$roomTable.cost", $condition['order_by_cost']);
            })
            ->when(in_array(@$condition['order_by_acreage'], ['asc', 'desc']), function ($query)
            use ($condition, $roomTable) {
                $query->orderBy("$roomTable.acreage", $condition['order_by_acreage']);
            })
            ->when(!in_array(@$condition['order_by_created_at'], ['asc', 'desc']), function ($query)
            use ($interestedRoomItemTable) {
                $query->orderByDesc("$interestedRoomItemTable.created_at");
            })
            ->with([
                'room:id,room_type_id',
                'room.roomType:id,name',
                'room.medias:id,room_id,type,link'
            ])
            ->paginate(@$condition['per_page'] ?? $this->per_page);
    }
}
