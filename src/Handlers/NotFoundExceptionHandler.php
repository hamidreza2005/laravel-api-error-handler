<?php
namespace hamidreza2005\LaravelApiErrorHandler\Handlers;

use Illuminate\Http\Response;

class NotFoundExceptionHandler extends ExceptionHandler
{

    protected function setStatusCode(): void
    {
        $this->statusCode = Response::HTTP_NOT_FOUND;
    }

    protected function setMessage(): void
    {
        $this->message = "Not Found !";
    }
}
