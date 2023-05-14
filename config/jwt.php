<?php

use Illuminate\Support\Str;

return [
    'key' => env('JWT_KEY', 'secret'),
    'algorithm' => env('JWT_ALGORITHM', 'HS256'),
    'expire_time' => env('JWT_EXPIRE_TIME', 3600),
];
