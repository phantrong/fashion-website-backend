<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomHouseware extends Model
{
    use HasFactory, SoftDeletes, ModelTrait;

    /**
     * @var string
     */
    protected $table = 'room_housewares';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'room_id',
        'houseware_id',
    ];
}
