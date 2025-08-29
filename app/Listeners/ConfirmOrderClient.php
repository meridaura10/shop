<?php

namespace App\Listeners;

use App\Events\ConfirmOrder;
use App\Notifications\ConfirmOrderClientNotification;
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
    public function handle(ConfirmOrder $event): void
    {
        if(!$event->order->user){
            return;
        }

        Notification::send($event->order->user, new ConfirmOrderClientNotification($event->order));
    }
}
