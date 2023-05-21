<?php

use Carbon\Carbon;

/**
 *
 * @return Carbon
 */
function getNow()
{
    return Carbon::now()->setTimezone(config('app.timezone'));
}

/**
 *
 * @return string
 */
function getDateTimeNow()
{
    return Carbon::now()->setTimezone(config('app.timezone'))->format('Y-m-d H:i:s');
}
