<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvalidToken extends Model
{
    use HasFactory;

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
        'token',
        'user_role',
    ];
}
