<?php
namespace hamidreza2005\LaravelApiErrorHandler\Handlers;

class ValidationExceptionHandler extends ExceptionHandler
{

    protected function setStatusCode(): void
    {
        $this->statusCode = 422;
    }

    protected function setMessage(): void
    {
        $this->message = $this->exception->getMessage();
    }

    protected function setData(): void
    {
        $this->data = $this->exception->validator->errors()->getMessages();
    }
}
