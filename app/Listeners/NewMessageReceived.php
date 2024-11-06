<?php

namespace App\Listeners;

use App\Events\NewTeamMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
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
