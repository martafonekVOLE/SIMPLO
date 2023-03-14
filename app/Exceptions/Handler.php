<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
        //
        });
    }
    public function render($request, Throwable $e)
    {
        //return $this->apiExceptions($request, $e);
        return parent::render($request, $e);

    }
    private function apiExceptions($request, Throwable $e){
        $e = $this->prepareException($e);

        if($e instanceof HttpResponseException){
            $e = $e->getResponse();
        }
        if($e instanceof ValidationException){
            $this->convertValidationExceptionToResponse($e, $request);
        }

        return $this->customApiException($e, $request);
    }
    private function customApiException($e, $request){
        $statusCode = (method_exists($e, 'getStatusCode')) ? $e->getStatusCode() : 500;
        $response = [];

        if(config('app.debug')){
            $response['status'] = $statusCode;
        }

        switch ($statusCode){
            case 404:
                return parent::render($request, $e);
                break;
            case 405:
                $response['message'] = "Method not Allowed! " . $e->getMessage();
                break;
            default:
                $response['message'] = ($statusCode == 500) ? 'Internal server error.' : $e->getMessage();
                break;
        }

        return response()->json($response, $statusCode);
    }
}
