<?php

namespace App\Models;

use App\Enum\RoomMediaEnum;
use App\Traits\FullTextSearch;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes, ModelTrait, FullTextSearch;

    /**
     * @var string
     */
    protected $table = 'rooms';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
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
        'status',
        'is_sent_mail_to_user',
        'admin_id'
    ];

    /**
     * The columns of the full text index
     */
    protected $searchable = [
        'title',
        'address_detail',
        'more_description'
        // 'rooms.title',
        // 'rooms.address_detail',
        // 'rooms.more_description',
        // 'provinces.name',
        // 'districts.name',
        // 'wards.name',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function housewares()
    {
        return $this->belongsToMany(
            Houseware::class,
            'room_housewares',
            'room_id',
            'houseware_id',
        )->withPivot('id')->whereNull('room_housewares.deleted_at');
    }

    public function medias()
    {
        return $this->hasMany(RoomMedia::class);
    }

    public function firstImage()
    {
        return $this->medias()->where('type', RoomMediaEnum::MEDIA_IMAGE_TYPE)->limit(1);
    }
}
