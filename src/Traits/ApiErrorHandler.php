<?php

namespace hamidreza2005\LaravelApiErrorHandler\Traits;

use hamidreza2005\LaravelApiErrorHandler\Exceptions\DefaultException;
use Illuminate\Support\Facades\Response;

trait ApiErrorHandler
{
    public function handleError($exception)
    {
        $exceptions = config("api-error-handler") ?? [];
        $class = array_key_exists(get_class($exception),$exceptions) ? $exceptions[get_class($exception)] : DefaultException::class;
        $handler = new $class($exception);
        $handler->handleStatusCode();
        $handler->handleMessage();
        return Response::json(["error"=>$handler->getMessage()],$handler->getStatusCode(),["Content-Type"=>"application/json"]);
    }
}
