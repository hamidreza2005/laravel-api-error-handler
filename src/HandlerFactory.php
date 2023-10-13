<?php

namespace hamidreza2005\LaravelApiErrorHandler;

use hamidreza2005\LaravelApiErrorHandler\Handlers\DefaultExceptionHandler;
use hamidreza2005\LaravelApiErrorHandler\Handlers\ExceptionHandler;
use hamidreza2005\LaravelApiErrorHandler\Handlers\ServerInternalExceptionHandler;
use Illuminate\Support\Facades\Config;

class HandlerFactory
{
    private bool $debugMode;

    private array $handlers;

    private string $internalErrorHandler;
    public function __construct()
    {
        $this->debugMode = app()->hasDebugModeEnabled();
        $this->loadHandlers();
    }

    protected function loadHandlers(): void
    {
        $this->handlers = $this->loadHandlersFromConfigs();
        $this->internalErrorHandler = Config::get("api-error-handler.internal_error_handler") ?? ServerInternalExceptionHandler::class;
    }

    private function loadHandlersFromConfigs(): array
    {
        return array_map(
            fn($exceptions)=> is_array($exceptions) ? $exceptions : [$exceptions],
            Config::get("api-error-handler.handlers") ?? []
        );
    }

    private function exceptionHasHandler($exception): bool
    {
        return !is_null($this->findHandlerByException($exception));
    }

    private function findHandlerByException($exception): string|null
    {
        $exceptionClassName = get_class($exception);
        foreach ($this->handlers as $handler => $exceptions){
            if (in_array($exceptionClassName,$exceptions)){
                return $handler;
            }
        }
        return null;
    }

    protected function makeHandler(string $handlerClassName,$exception)
    {
        return new $handlerClassName($exception);
    }

    public function getHandler($exception): ExceptionHandler
    {
        $handlerClassName = $this->findHandlerByException($exception);
        if (!$handlerClassName){
            $handlerClassName = $this->debugMode ?
                DefaultExceptionHandler::class :
                $this->internalErrorHandler;
        }

        return $this->makeHandler($handlerClassName,$exception);
    }
}
