<?php

namespace App\Console;

use App\Console\Commands\DistributionSend;
use Illuminate\Console\Scheduling\Schedule;


class Handler
{
    public function __invoke(Schedule $schedule): void
    {
        $schedule->command(DistributionSend::class)->everyMinute();
    }
}
