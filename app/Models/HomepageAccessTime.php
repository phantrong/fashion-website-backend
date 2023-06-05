<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageAccessTime extends Model
{
    use HasFactory, ModelTrait;

    /**
     * @var string
     */
    protected $table = 'homepage_access_times';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'address_ip',
        'user_agent',
    ];
}
