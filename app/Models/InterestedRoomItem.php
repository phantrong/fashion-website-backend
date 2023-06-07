<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestedRoomItem extends Model
{
    use HasFactory, ModelTrait;

    /**
     * @var string
     */
    protected $table = 'interested_room_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'interested_room_id',
        'room_id',
    ];

    public function interestedRoom()
    {
        return $this->belongsTo(InterestedRoom::class);
    }

    public function room()
    {
        return $this->hasOne(Room::class, 'id', 'room_id');
    }
}
