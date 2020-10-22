<?php


namespace hamidreza2005\laravelApiErrorHandler\Exceptions;


class DefaultException extends ExceptionAbstract
{

    public function handleStatusCode()
    {
        $this->statusCode = method_exists($this->exception,'getStatusCode') ? $this->exception->getStatusCode() : $this->exception->status;
    }

    public function handleMessage()
    {
        $this->message = $this->exception->getMessage();
    }
}
