<?php

namespace App\Repositories\Room;

use App\Enum\AdminEnum;
use App\Enum\RoomEnum;
use App\Models\Admin;
use App\Models\District;
use App\Models\Province;
use App\Models\Room;
use App\Models\Ward;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
            ->when(@$condition['key_word'], function ($query) use ($condition, $roomTable) {
                $query->where("$roomTable.title", 'like', '%' . $condition['key_word'] . '%');
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
            "$roomTable.more_description",
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

    public function getListSearchByUser(array $condition)
    {
        $roomTable = $this->model->getTable();
        $provinceTable = Province::getTableName();
        $districtTable = District::getTableName();
        $wardTable = Ward::getTableName();
        $adminTable = Admin::getTableName();

        return $this->model->select([
            "$roomTable.id",
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
        ])
            ->join($provinceTable, "$provinceTable.id", '=', "$roomTable.province_id")
            ->join($districtTable, "$districtTable.id", '=', "$roomTable.district_id")
            ->join($wardTable, "$wardTable.id", '=', "$roomTable.ward_id")
            ->join($adminTable, "$adminTable.id", '=', "$roomTable.admin_id")
            ->where("$roomTable.status", RoomEnum::STATUS_SHOW)
            ->where("$adminTable.status", AdminEnum::STATUS_ACTIVE)
            ->when(@$condition['admin_id'], function ($query) use ($condition, $roomTable) {
                $query->where("$roomTable.admin_id", $condition['admin_id']);
            })
            ->when(@$condition['room_type_id'], function ($query) use ($condition, $roomTable) {
                $query->where("$roomTable.room_type_id", $condition['room_type_id']);
            })
            ->when(@$condition['province_id'], function ($query) use ($condition, $roomTable) {
                $query->where("$roomTable.province_id", $condition['province_id']);
            })
            ->when(@$condition['district_id'], function ($query) use ($condition, $roomTable) {
                $query->where("$roomTable.district_id", $condition['district_id']);
            })
            ->when(@$condition['ward_id'], function ($query) use ($condition, $roomTable) {
                $query->where("$roomTable.ward_id", $condition['ward_id']);
            })
            ->when(@$condition['is_negotiate'], function ($query) use ($condition, $roomTable) {
                $query->where("$roomTable.is_negotiate", $condition['is_negotiate']);
            })
            // cost
            ->when(@$condition['start_cost'] && @$condition['end_cost'], function ($query)
            use ($condition, $roomTable) {
                $query->where("$roomTable.cost", '>=', $condition['start_cost'])
                    ->where("$roomTable.cost", '<=', $condition['end_cost']);
            })
            ->when(!@$condition['start_cost'] && @$condition['end_cost'], function ($query)
            use ($condition, $roomTable) {
                $query->where("$roomTable.cost", '<=', $condition['end_cost']);
            })
            ->when(@$condition['start_cost'] && !@$condition['end_cost'], function ($query)
            use ($condition, $roomTable) {
                $query->where("$roomTable.cost", '>=', $condition['start_cost']);
            })
            // acreage
            ->when(@$condition['start_acreage'] && @$condition['end_acreage'], function ($query)
            use ($condition, $roomTable) {
                $query->where("$roomTable.acreage", '>=', $condition['start_acreage'])
                    ->where("$roomTable.acreage", '<=', $condition['end_acreage']);
            })
            ->when(!@$condition['start_acreage'] && @$condition['end_acreage'], function ($query)
            use ($condition, $roomTable) {
                $query->where("$roomTable.acreage", '<=', $condition['end_acreage']);
            })
            ->when(@$condition['start_acreage'] && !@$condition['end_acreage'], function ($query)
            use ($condition, $roomTable) {
                $query->where("$roomTable.acreage", '>=', $condition['start_acreage']);
            })
            // key_word
            ->when(@$condition['key_word'], function ($query)
            use ($condition, $roomTable, $provinceTable, $districtTable, $wardTable) {
                $query->where(function ($query)
                use ($condition, $roomTable, $provinceTable, $districtTable, $wardTable) {
                    $query->where("$roomTable.title", 'like', '%' . $condition['key_word'] . '%')
                        ->orWhere("$roomTable.more_description", 'like', '%' . $condition['key_word'] . '%')
                        ->orWhere("$provinceTable.name", 'like', '%' . $condition['key_word'] . '%')
                        ->orWhere("$districtTable.name", 'like', '%' . $condition['key_word'] . '%')
                        ->orWhere("$wardTable.name", 'like', '%' . $condition['key_word'] . '%')
                        ->orWhere("$roomTable.address_detail", 'like', '%' . $condition['key_word'] . '%')
                        ->orWhere(function ($query) use ($condition) {
                            $query->search($condition['key_word']);
                        });
                });
            })
            // order by
            ->when(in_array(@$condition['order_by_created_at'], ['asc', 'desc']), function ($query)
            use ($condition, $roomTable) {
                $query->orderBy("$roomTable.created_at", $condition['order_by_created_at']);
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
            use ($roomTable) {
                $query->orderByDesc("$roomTable.created_at");
            })
            ->with([
                'roomType:id,name',
                'medias:id,room_id,type,link'
            ])
            ->paginate(@$condition['per_page'] ?? $this->per_page);
    }

    public function getDetailByUser($id, array $condition)
    {
        $roomTable = $this->model->getTable();
        $provinceTable = Province::getTableName();
        $districtTable = District::getTableName();
        $wardTable = Ward::getTableName();
        $adminTable = Admin::getTableName();

        return $this->model->select([
            "$roomTable.id",
            "$roomTable.title",
            "$roomTable.province_id",
            "$provinceTable.name as province_name",
            "$roomTable.district_id",
            "$districtTable.name as district_name",
            "$roomTable.ward_id",
            "$wardTable.name as ward_name",
            "$roomTable.address_detail",
            "$roomTable.maps_location",
            "$roomTable.room_type_id",
            "$roomTable.is_negotiate",
            "$roomTable.cost",
            "$roomTable.acreage",
            "$roomTable.max_people_allowed",
            "$roomTable.more_description",
            "$roomTable.status",
            "$roomTable.created_at",
            "$roomTable.updated_at",
            "$adminTable.id as admin_id",
            "$adminTable.name as admin_name"
        ])
            ->join($provinceTable, "$provinceTable.id", '=', "$roomTable.province_id")
            ->join($districtTable, "$districtTable.id", '=', "$roomTable.district_id")
            ->join($wardTable, "$wardTable.id", '=', "$roomTable.ward_id")
            ->join($adminTable, "$adminTable.id", '=', "$roomTable.admin_id")
            ->where("$roomTable.id", $id)
            ->where("$roomTable.status", RoomEnum::STATUS_SHOW)
            ->where("$adminTable.status", AdminEnum::STATUS_ACTIVE)
            ->with([
                'roomType:id,name',
                'medias:id,room_id,type,link',
                'housewares:id,name',
            ])
            ->first();
    }

    public function getCountRoomInHanoi($condition = [])
    {
        $roomTable = $this->model->getTable();
        $provinceTable = Province::getTableName();
        $districtTable = District::getTableName();
        $wardTable = Ward::getTableName();
        $adminTable = Admin::getTableName();

        return $this->model->select(
            "$districtTable.name as district_name",
            DB::raw("count($roomTable.id) as count_room"),
        )
            ->join($provinceTable, "$provinceTable.id", '=', "$roomTable.province_id")
            ->join($districtTable, "$districtTable.id", '=', "$roomTable.district_id")
            ->join($wardTable, "$wardTable.id", '=', "$roomTable.ward_id")
            ->join($adminTable, "$adminTable.id", '=', "$roomTable.admin_id")
            ->where("$roomTable.status", RoomEnum::STATUS_SHOW)
            ->where("$adminTable.status", AdminEnum::STATUS_ACTIVE)
            ->where(function ($query) use ($provinceTable) {
                $query->where("$provinceTable.gso_id", RoomEnum::GSO_ID_HA_NOI)
                    ->orWhere("$provinceTable.name", RoomEnum::HA_NOI_CITY);
            })
            ->groupBy("$roomTable.district_id")
            ->orderByDesc('count_room')
            ->paginate(@$condition['per_page'] ?? $this->per_page);
    }
}
