<?php


namespace hamidreza2005\LaravelApiErrorHandler\Exceptions;


class NotFoundException extends ExceptionAbstract
{

    public function handleStatusCode():void
    {
        $this->statusCode = 404;
    }

    public function handleMessage():void
    {
        $this->message = "Not Found !";
    }
}
