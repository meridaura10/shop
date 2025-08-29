<?php

namespace App\Jobs;

use App\Mail\MessageLeadMail;
use App\Models\Lead;
use App\Models\Product;
use App\Notifications\DistributionLeadNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendMailMessageLeadsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected string $message)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach (Lead::query()->cursor() as $lead) {
            if(!$lead->routeNotificationForMail()){
                return;
            }

            Notification::send($lead, new DistributionLeadNotification($this->message));
        }
    }
}
