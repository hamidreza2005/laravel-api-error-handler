<?php

use hamidreza2005\LaravelApiErrorHandler\Handlers\{
    ServerInternalExceptionHandler,
    NotFoundExceptionHandler,
    AccessDeniedExceptionHandler,
    ValidationExceptionHandler
};

return [

    /*
     * this is where you define which handler deal with which errors. each handler can handle multiple errors
     */

    "handlers" =>[
        NotFoundExceptionHandler::class => [
            "Symfony\Component\HttpKernel\Exception\NotFoundHttpException",
            "Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException"
        ],
        ServerInternalExceptionHandler::class => [
            "ErrorException",
            "Illuminate\Database\QueryException"
        ],
        AccessDeniedExceptionHandler::class => [
            "Illuminate\Auth\AuthenticationException",
            "Symfony\Component\HttpKernel\Exception\HttpException"
        ],
        ValidationExceptionHandler::class => [
            "Illuminate\Validation\ValidationException"
        ],
    ],

    /*
     * if the app is not in debug mode. all unknown exceptions will be handled by this.
     */
    "internal_error_handler" => ServerInternalExceptionHandler::class,
];
