<?php

namespace App\Exceptions;

use App\Services\Service;
use Firebase\JWT\ExpiredException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Report or log an exception.
     *
     * @param Throwable $exception
     * @throws Throwable
     */
    public function report(Throwable $exception)
    {
        Log::error("{$exception->getMessage()} - {$exception->getFile()} - {$exception->getLine()}");
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $exception
     * @return JsonResponse
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        switch (get_class($exception)) {
            case UnauthorizedHttpException::class:
            case AuthenticationException::class:
            case ExpiredException::class:
                $message = __('message.error.401');
                $statusCode = JsonResponse::HTTP_UNAUTHORIZED;
                break;
            case ModelNotFoundException::class:
            case NotFoundHttpException::class:
                $message = __('message.error.404');
                $statusCode = JsonResponse::HTTP_NOT_FOUND;
                break;
            case MethodNotAllowedHttpException::class:
                $message = __('message.error.405');
                $statusCode = JsonResponse::HTTP_METHOD_NOT_ALLOWED;
                break;
            default:
                $message = __('message.error.500');
                $statusCode = JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
                break;
        }

        return Service::response()->error($message, $statusCode);
    }
}
