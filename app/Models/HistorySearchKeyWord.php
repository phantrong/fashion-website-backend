<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorySearchKeyWord extends Model
{
    use HasFactory, ModelTrait;

    /**
     * @var string
     */
    protected $table = 'history_search_key_words';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'key_word',
        'user_id',
        'customer_id',
    ];
}
