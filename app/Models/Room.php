<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

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
        'admin_id'
    ];
}
