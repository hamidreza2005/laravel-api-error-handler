<?php
namespace hamidreza2005\LaravelApiErrorHandler\Handlers;

class AccessDeniedExceptionHandler extends ExceptionHandler
{

    protected function setStatusCode(): void
    {
        $this->statusCode = 403;
    }

    protected function setMessage(): void
    {
        $this->message = "Access Denied";
    }
}
