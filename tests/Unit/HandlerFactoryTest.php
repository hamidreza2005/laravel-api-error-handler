<?php

namespace hamidreza2005\LaravelApiErrorHandler\Tests\Unit;

use App\Exceptions\Handler;
use hamidreza2005\LaravelApiErrorHandler\Exceptions\AccessDeniedException;
use hamidreza2005\LaravelApiErrorHandler\Exceptions\DefaultException;
use hamidreza2005\LaravelApiErrorHandler\Exceptions\ServerInternalException;
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
            ->andReturn(ServerInternalException::class);

        $exceptionClass = new \Exception("fdf");
        $handler = (new HandlerFactory())->getHandler($exceptionClass);
        $this->assertTrue(true); // just so phpunit doesn't give warning
    }

    public function test_handler_class_gives_the_right_handler()
    {
        Config::set("api-error-handler.handlers",[
            AccessDeniedException::class => \Exception::class
        ]);

        $exception = new \Exception("Error");
        $handler = (new HandlerFactory())->getHandler($exception);
        $this->assertInstanceOf(AccessDeniedException::class,$handler);
    }

    public function test_handler_can_have_multiple_exceptions()
    {
        Config::set("api-error-handler.handlers",[
            AccessDeniedException::class => [\Exception::class,AccessDeniedHttpException::class]
        ]);

        $exception = new AccessDeniedHttpException("Error");
        $handler = (new HandlerFactory())->getHandler($exception);
        $this->assertInstanceOf(AccessDeniedException::class,$handler);
    }

    public function test_handler_class_gives_server_internal_if_unknown_exception_occurs_when_debug_mode_is_false()
    {
        Config::set("app.debug",false);
        Config::set("api-error-handler.handlers",[
            AccessDeniedException::class => \Exception::class
        ]);

        $exception = new AccessDeniedHttpException("Error");
        $handler = (new HandlerFactory())->getHandler($exception);
        $this->assertInstanceOf(ServerInternalException::class,$handler);
    }
    public function test_handler_class_gives_rised_exception_if_unknown_exception_occurs_when_debug_mode_is_false()
    {
        Config::set("app.debug",true);
        Config::set("api-error-handler.handlers",[
            AccessDeniedException::class => \Exception::class
        ]);

        $exception = new AccessDeniedHttpException("Error");
        $handler = (new HandlerFactory())->getHandler($exception);
        $this->assertInstanceOf(DefaultException::class,$handler);
    }
}
