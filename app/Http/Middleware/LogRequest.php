<?php

namespace App\Http\Middleware;

use App\Enum\CommonEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequest
{
    /**
     * Get time start of request.
     *
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->start = microtime(true);

        return $next($request);
    }

    /**
     * Get time end of request.
     *
     * @param $request
     * @param $response
     */
    public function terminate(Request $request, $response)
    {
        $request->end = microtime(true);
        $this->log($request, $response);
    }

    /**
     * Log request.
     *
     * @param $request
     * @param $response
     */
    protected function log(Request $request, $response)
    {
        $duration = $request->end - $request->start;
        $url = $request->fullUrl();
        $method = $request->getMethod();
        $ip = $request->getClientIp();
        $userAgent = $request->userAgent();
        $req = json_encode($this->maskData($request->all()));
        $res = $response->getContent();
        $log = "$ip - $userAgent: $method@$url - {$duration}ms\nRequest: {$req}\nResponse: $res";
        Log::channel('api')->info($log);
    }

    /**
     * Mask data with some key.
     *
     * @param array $input
     * @return array
     */
    private function maskData(array $input)
    {
        foreach ($input as $key => $value) {
            if (in_array($key, CommonEnum::MASKED_KEY)) {
                $input[$key] = '***';
            }
        }

        return $input;
    }
}
