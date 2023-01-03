<?php

namespace App\Providers;

use App\Providers\EventNewOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewOrder
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
     * @param  \App\Providers\EventNewOrder  $event
     * @return void
     */
    public function handle(EventNewOrder $event)
    {
        //
    }
}
