<?php

namespace App\Models;

use App\Enum\CertificateEnum;
use App\Traits\UuidForKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, UuidForKey, SoftDeletes, HasFactory;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'avatar',
        'name',
        'gender',
        'birthday',
        'email',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'deleted_at',
    ];

    /**
     * The certificates that belong to the user.
     *
     * @return BelongsToMany
     */
    public function certificates()
    {
        $tableUserCertificate = CertificateEnum::TABLE_USER_CERTIFICATE;

        return $this->belongsToMany(Certificate::class, $tableUserCertificate);
    }
}
