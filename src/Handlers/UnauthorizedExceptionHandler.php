<?php

namespace hamidreza2005\laravelApiErrorHandler\Handlers;


use Illuminate\Http\Response;

class UnauthorizedExceptionHandler extends ExceptionHandler
{

    protected function setStatusCode(): void
    {
        $this->statusCode = Response::HTTP_UNAUTHORIZED;
    }

    protected function setMessage(): void
    {
        $this->message = "Unauthorized";
    }
}
