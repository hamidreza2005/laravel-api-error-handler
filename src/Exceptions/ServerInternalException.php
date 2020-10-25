<?php


namespace hamidreza2005\LaravelApiErrorHandler\Exceptions;


class ServerInternalException extends ExceptionAbstract
{

    public function handleStatusCode():void
    {
        $this->statusCode = 500;
    }

    public function handleMessage():void
    {
        $this->message = "Server Internal Error";
    }
}
