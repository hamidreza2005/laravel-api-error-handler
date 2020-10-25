<?php


namespace hamidreza2005\LaravelApiErrorHandler\Exceptions;


class AccessDeniedException extends ExceptionAbstract
{

    public function handleStatusCode():void
    {
        $this->statusCode = 403;
    }

    public function handleMessage():void
    {
        $this->message = "Access Denied";
    }
}
