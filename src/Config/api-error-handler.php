<?php

return [
    "Symfony\Component\HttpKernel\Exception\NotFoundHttpException" => "hamidreza2005\laravelApiErrorHandler\Exceptions\NotFoundException",
    "ErrorException" => "hamidreza2005\laravelApiErrorHandler\Exceptions\ServerInternalException",
    "Illuminate\Auth\AuthenticationException" => "hamidreza2005\laravelApiErrorHandler\Exceptions\AccessDeniedException",
    "Symfony\Component\HttpKernel\Exception\HttpException" => "hamidreza2005\laravelApiErrorHandler\Exceptions\AccessDeniedException",
    "Illuminate\Validation\ValidationException" => "hamidreza2005\laravelApiErrorHandler\Exceptions\ValidationException",
];
