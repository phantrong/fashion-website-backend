<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterestedRoom extends Model
{
    use HasFactory, SoftDeletes, ModelTrait;

    /**
     * @var string
     */
    protected $table = 'interested_rooms';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'customer_id',
    ];

    public function items()
    {
        return $this->hasMany(InterestedRoomItem::class);
    }
}
