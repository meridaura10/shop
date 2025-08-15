<?php

namespace App\Listeners;

use App\Notifications\ConfirmOrderClientNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class ConfirmOrderClient
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
        if(!$event->order->user){
            return;
        }

        Notification::send($event->order->user, new ConfirmOrderClientNotification($event->order));
    }
}
