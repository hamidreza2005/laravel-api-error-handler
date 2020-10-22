<?php


namespace hamidreza2005\laravelApiErrorHandler\Exceptions;


class ValidationException extends ExceptionAbstract
{

    public function handleStatusCode()
    {
        $this->statusCode = 422;
    }

    public function handleMessage()
    {
        $this->message = $this->exception->errors();
    }
}
