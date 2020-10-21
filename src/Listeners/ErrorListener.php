<?php

namespace hamidreza2005\LaravelApiErrorHandler\Listeners;


class ErrorListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (is_null($event->response->exception)){
            return;
        }
        dd($event->response->exception);
    }
}
