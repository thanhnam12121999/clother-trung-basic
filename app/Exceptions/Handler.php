<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException as DatabaseQueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof  ModelNotFoundException) {
            return response()->json([
                "statusCode" => Response::HTTP_NOT_FOUND,
                "message" => $exception->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
        
        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        if ($exception instanceof  DatabaseQueryException) {
            return response()->json([
                "statusCode" => $statusCode,
                "message" => $exception->getMessage()
            ], $statusCode);
        }
        
        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                "statusCode" => Response::HTTP_BAD_REQUEST,
                'message' => 'Method is not allowed for the requested route',
            ], Response::HTTP_BAD_REQUEST);
        }
        return parent::render($request, $exception);
    }
}
