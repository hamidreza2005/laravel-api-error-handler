<?php

namespace hamidreza2005\LaravelApiErrorHandler;

use hamidreza2005\LaravelApiErrorHandler\Listeners\ErrorListener;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class LaravelApiErrorHandlerServiceProvider extends ServiceProvider{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/Config/api-error-handler.php','api-error-handler');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/api-error-handler.php'=>config_path('api-error-handler.php')
        ],'laravel-api-error-handler');

        Event::listen(RequestHandled::class,ErrorListener::class);
    }
}
