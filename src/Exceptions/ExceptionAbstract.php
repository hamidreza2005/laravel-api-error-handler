<?php


namespace hamidreza2005\laravelApiErrorHandler\Exceptions;


abstract class ExceptionAbstract
{
    protected $exception;

    private $statusCode;

    private $message;

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

    abstract public function handleStatusCode();

    abstract public function handleMessage();
}
