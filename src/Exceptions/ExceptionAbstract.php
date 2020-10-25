<?php


namespace hamidreza2005\LaravelApiErrorHandler\Exceptions;


abstract class ExceptionAbstract
{
    protected $exception;

    protected $statusCode;

    protected $message;

    public function __construct($exception)
    {
        $this->exception = $exception;
    }

    public function getMessage(){
        return $this->message;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    abstract public function handleStatusCode():void;

    abstract public function handleMessage():void;
}
