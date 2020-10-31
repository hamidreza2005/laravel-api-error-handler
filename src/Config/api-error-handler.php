<?php

return [
    "Symfony\Component\HttpKernel\Exception\NotFoundHttpException" => "\hamidreza2005\LaravelApiErrorHandler\Exceptions\NotFoundException",
    "ErrorException" => "\hamidreza2005\LaravelApiErrorHandler\Exceptions\ServerInternalException",
    "Illuminate\Database\QueryException" => "\hamidreza2005\LaravelApiErrorHandler\Exceptions\ServerInternalException",
    "Illuminate\Auth\AuthenticationException" => "\hamidreza2005\LaravelApiErrorHandler\Exceptions\AccessDeniedException",
    "Symfony\Component\HttpKernel\Exception\HttpException" => "\hamidreza2005\LaravelApiErrorHandler\Exceptions\AccessDeniedException",
    "Illuminate\Validation\ValidationException" => "\hamidreza2005\LaravelApiErrorHandler\Exceptions\ValidationException",
    "Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException"=>"\hamidreza2005\LaravelApiErrorHandler\Exceptions\NotFoundException",
];
