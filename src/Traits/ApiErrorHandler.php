<?php

namespace hamidreza2005\LaravelApiErrorHandler\Traits;

use hamidreza2005\LaravelApiErrorHandler\Exceptions\DefaultException;
use hamidreza2005\LaravelApiErrorHandler\Exceptions\ServerInternalException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

trait ApiErrorHandler
{
    public function handleError($exception): JsonResponse
    {
        $exceptions = config("api-error-handler") ?? [];
        $class = array_key_exists(get_class($exception),$exceptions) ?
            $exceptions[get_class($exception)] :
            (config('app.debug') ? DefaultException::class : ServerInternalException::class
        );
        $handler = new $class($exception);
        $handler->handleStatusCode();
        $handler->handleMessage();
        return $this->errorResponse(["error"=>$handler->getMessage()],$handler->getStatusCode(),["Content-Type"=>"application/json"]);
    }

    protected function errorResponse(array $data,int $statusCode, array $headers): JsonResponse
    {
        return Response::json($data,$statusCode,$headers);
    }
}
