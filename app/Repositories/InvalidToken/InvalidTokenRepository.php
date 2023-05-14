<?php

namespace App\Repositories\InvalidToken;

use App\Models\InvalidToken;
use App\Repositories\Base\BaseRepository;

class InvalidTokenRepository extends BaseRepository implements InvalidTokenRepositoryInterface
{
    /**
     * InvalidTokenRepository constructor.
     *
     * @param InvalidToken $invalidToken
     */
    public function __construct(InvalidToken $invalidToken)
    {
        parent::__construct($invalidToken);
    }
}
