<?php

namespace hamidreza2005\LaravelApiErrorHandler\Tests\Unit;

use App\Exceptions\Handler;
use hamidreza2005\LaravelApiErrorHandler\Handlers\AccessDeniedExceptionHandler;
use hamidreza2005\LaravelApiErrorHandler\Handlers\DefaultExceptionHandler;
use hamidreza2005\LaravelApiErrorHandler\Handlers\ServerInternalExceptionHandler;
use hamidreza2005\LaravelApiErrorHandler\HandlerFactory;
use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class HandlerFactoryTest extends TestCase
{
    public function test_handler_class_works_with_configs_correctly()
    {
        Config::set("app.debug",true);
        Config::shouldReceive("get")
            ->with('app.debug')
            ->andReturn(true);

        Config::shouldReceive("get")
            ->with("api-error-handler.handlers");

        Config::shouldReceive("get")
            ->with("api-error-handler.internal_error_handler")
            ->andReturn(ServerInternalExceptionHandler::class);

        $exceptionClass = new \Exception("fdf");
        $handler = (new HandlerFactory())->getHandler($exceptionClass);
        $this->assertTrue(true); // just so phpunit doesn't give warning
    }

    public function test_handler_class_gives_the_right_handler()
    {
        Config::set("api-error-handler.handlers",[
            AccessDeniedExceptionHandler::class => \Exception::class
        ]);

        $exception = new \Exception("Error");
        $handler = (new HandlerFactory())->getHandler($exception);
        $this->assertInstanceOf(AccessDeniedExceptionHandler::class,$handler);
    }

    public function test_handler_can_have_multiple_exceptions()
    {
        Config::set("api-error-handler.handlers",[
            AccessDeniedExceptionHandler::class => [\Exception::class,AccessDeniedHttpException::class]
        ]);

        $exception = new AccessDeniedHttpException("Error");
        $handler = (new HandlerFactory())->getHandler($exception);
        $this->assertInstanceOf(AccessDeniedExceptionHandler::class,$handler);
    }

    public function test_handler_class_gives_server_internal_if_unknown_exception_occurs_when_debug_mode_is_false()
    {
        Config::set("app.debug",false);
        Config::set("api-error-handler.handlers",[
            AccessDeniedExceptionHandler::class => \Exception::class
        ]);

        $exception = new AccessDeniedHttpException("Error");
        $handler = (new HandlerFactory())->getHandler($exception);
        $this->assertInstanceOf(ServerInternalExceptionHandler::class,$handler);
    }
    public function test_handler_class_gives_risen_exception_if_unknown_exception_occurs_when_debug_mode_is_false()
    {
        Config::set("app.debug",true);
        Config::set("api-error-handler.handlers",[
            AccessDeniedExceptionHandler::class => \Exception::class
        ]);

        $exception = new AccessDeniedHttpException("Error");
        $handler = (new HandlerFactory())->getHandler($exception);
        $this->assertInstanceOf(DefaultExceptionHandler::class,$handler);
    }
}
