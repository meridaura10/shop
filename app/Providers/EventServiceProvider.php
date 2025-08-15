<?php

namespace App\Providers;

use App\Events\ConfirmOrder;
use App\Listeners\ConfirmOrderClient;
use App\Listeners\NotifyAdminsOnUserRegistered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;


class EventServiceProvider extends \Illuminate\Foundation\Support\Providers\EventServiceProvider
{
    public function boot(): void
    {
        Event::listen(function (Registered $event) {
            (new NotifyAdminsOnUserRegistered())->handle($event->user);
        });

        Event::listen(function (ConfirmOrder $event) {
            (new ConfirmOrderClient())->handle($event->order);
        });
    }
}
