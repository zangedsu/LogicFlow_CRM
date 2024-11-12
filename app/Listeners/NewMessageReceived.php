<?php

namespace App\Listeners;

use Masmerise\Toaster\Toaster;

class NewMessageReceived
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //        Toaster::info('Получено новое сообщение!');
    }
}
