<?php


namespace hamidreza2005\laravelApiErrorHandler\Exceptions;


class AccessDeniedException extends ExceptionAbstract
{

    public function handleStatusCode()
    {
        $this->statusCode = 403;
    }

    public function handleMessage()
    {
        $this->message = "Access Denied";
    }
}
