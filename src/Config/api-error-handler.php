<?php

use hamidreza2005\LaravelApiErrorHandler\Exceptions\{
    ServerInternalException,
    NotFoundException,
    AccessDeniedException,
    ValidationException
};

return [

    /*
     * this is where you define which handler deal with which errors. each handler can handle multiple errors
     */

    "handlers" =>[
        NotFoundException::class => [
            "Symfony\Component\HttpKernel\Exception\NotFoundHttpException",
            "Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException"
        ],
        ServerInternalException::class => [
            "ErrorException",
            "Illuminate\Database\QueryException"
        ],
        AccessDeniedException::class => [
            "Illuminate\Auth\AuthenticationException",
            "Symfony\Component\HttpKernel\Exception\HttpException"
        ],
        ValidationException::class => [
            "Illuminate\Validation\ValidationException"
        ],
    ],

    /*
     * if the app is not in debug mode. all unknown exceptions will be handled by this.
     */
    "internal_error_handler" => ServerInternalException::class,
];
