<?php

namespace App\Models;

use App\Traits\FullTextSearch;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory, ModelTrait, FullTextSearch;

    /**
     * @var string
     */
    protected $table = 'districts';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'province_id',
        'gso_id',
    ];

    /**
     * The columns of the full text index
     */
    protected $searchable = [
        'name'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
