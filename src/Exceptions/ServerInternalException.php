<?php


namespace hamidreza2005\laravelApiErrorHandler\Exceptions;


class ServerInternalException extends ExceptionAbstract
{

    public function handleStatusCode()
    {
        $this->statusCode = 500;
    }

    public function handleMessage()
    {
        $this->message = "Server Internal Error";
    }
}
