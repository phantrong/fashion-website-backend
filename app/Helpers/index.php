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

// Function to get the client IP address
function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
