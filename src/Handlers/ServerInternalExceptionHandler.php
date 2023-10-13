<?php
namespace hamidreza2005\LaravelApiErrorHandler\Handlers;

class ServerInternalExceptionHandler extends ExceptionHandler
{

    protected function setStatusCode(): void
    {
        $this->statusCode = 500;
    }

    protected function setMessage(): void
    {
        $this->message = "Server Internal Error";
    }
}
