<?php

use App\Enum\CommonEnum;

/**
 * @param  int $useRole
 * @return string
 */
function getLinkFrontend($useRole)
{
    switch ($useRole) {
        case CommonEnum::USER_ROLE_ADMIN:
            $key = config('services.link_service_front_admin');
            break;
        case CommonEnum::USER_ROLE_USER:
            $key = config('services.link_service_front_user');
            break;
        default:
            $key = config('services.link_service_front_user');
            break;
    }
    return $key;
}
