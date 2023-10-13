<?php
namespace hamidreza2005\LaravelApiErrorHandler\Handlers;

class DefaultExceptionHandler extends ExceptionHandler
{

    protected function setStatusCode(): void
    {
        $this->statusCode = method_exists($this->exception,'getStatusCode')
            ? $this->exception->getStatusCode()
            : 500;
    }

    protected function setMessage(): void
    {
        $this->message = $this->exception->getMessage();
    }
}
