<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Houseware extends Model
{
    use HasFactory, SoftDeletes, ModelTrait;

    /**
     * @var string
     */
    protected $table = 'housewares';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    public function rooms()
    {
        return $this->belongsToMany(
            Room::class,
            'room_housewares',
            'houseware_id',
            'room_id'
        )->whereNull('room_housewares.deleted_at');
    }
}
