<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request , Throwable $exception) : Response {
        if ($exception instanceof BaseException) {
            return new JsonResponse(
                [
                    'message' => $exception->getMessage(),
                ],
                $exception->getCode()
            );

        }
        return parent::render($request, $exception);


    }
}
