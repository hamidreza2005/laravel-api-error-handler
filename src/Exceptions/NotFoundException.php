<?php


namespace hamidreza2005\laravelApiErrorHandler\Exceptions;


class NotFoundException extends ExceptionAbstract
{

    public function handleStatusCode()
    {
        $this->statusCode = 404;
    }

    public function handleMessage()
    {
        $this->message = "Not Found !";
    }
}
