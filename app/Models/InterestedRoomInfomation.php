<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestedRoomInfomation extends Model
{
    use HasFactory, ModelTrait;

    /**
     * @var string
     */
    protected $table = 'interested_room_infomations';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'ward_id',
        'district_id',
        'room_type_id',
        'user_id',
        'customer_id',
    ];
}
