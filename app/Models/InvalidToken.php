<?php

namespace App\Models;

use App\Traits\UuidForKey;
use Illuminate\Database\Eloquent\Model;

class InvalidToken extends Model
{
    use UuidForKey;

    /**
     * @var string
     */
    protected $table = 'invalid_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'token',
    ];
}
