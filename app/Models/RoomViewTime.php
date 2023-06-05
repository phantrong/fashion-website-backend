<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomViewTime extends Model
{
    use HasFactory, ModelTrait;

    /**
     * @var string
     */
    protected $table = 'room_view_times';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'room_id',
        'address_ip',
        'user_agent',
    ];
}
