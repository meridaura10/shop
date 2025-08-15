<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\AdminNewUserRegisteredNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NotifyAdminsOnUserRegistered
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
        $admins = User::query()->whereHas('roles', fn ($q) => $q->where('name', 'admin'))->get();

        Notification::send($admins, new AdminNewUserRegisteredNotification($event->user));
    }
}
