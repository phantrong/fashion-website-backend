<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verify extends Model
{
    use HasFactory, ModelTrait;

    /**
     * @var string
     */
    protected $table = 'verifies';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email_phone',
        'code_verify',
        'type',
        'user_role',
    ];
}
