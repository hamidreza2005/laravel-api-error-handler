<?php

namespace hamidreza2005\LaravelApiErrorHandler\Traits;

use hamidreza2005\LaravelApiErrorHandler\HandlerFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiErrorHandler
{
    public function handle($exception): JsonResponse
    {
        $handler = (new HandlerFactory())->getHandler($exception);
        $handler->handleStatusCode();
        $handler->handleMessage();
        return $this->errorResponse($handler->getMessage(),[],$handler->getStatusCode(),["Content-Type"=>"application/json"]);
    }

    protected function errorResponse(string $message, array $data = [] ,int $statusCode = Response::HTTP_BAD_REQUEST, array $headers = []): JsonResponse
    {
        $result = [
            "message" => $message,
            "success" => false,
            "data" => $data,
            "status" => $statusCode
        ];
        return response()->json($result,$statusCode,$headers);
    }
}
