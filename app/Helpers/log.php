<?php

use Illuminate\Support\Facades\Log;

function log_dispatch_email($email, $nameLog, $data)
{
    Log::channel($nameLog)->info('dispatch: ' . $email);
    if ($data) {
        Log::channel($nameLog)->info(json_encode($data));
    }
}

function log_send_email($email, $nameLog, $data)
{
    Log::channel($nameLog)->info('send: ' . $email);
    if ($data) {
        Log::channel($nameLog)->info(json_encode($data));
    }
}

function log_channel($nameLog, $data)
{
    if ($data) {
        Log::channel($nameLog)->info($data);
    }
}
