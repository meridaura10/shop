<?php

namespace App\Console;

use App\Actions\RecalculateRatingAction;
use App\Console\Commands\DistributionSend;
use App\Actions\SitemapGenerate as SitemapGenerateAction;
use Illuminate\Console\Scheduling\Schedule;



class Handler
{
    public function __invoke(Schedule $schedule): void
    {
        $schedule->command(DistributionSend::class)->everyMinute();
        $schedule->call(fn() => SitemapGenerateAction::makeJob())->everySixHours();
        $schedule->call(fn() => RecalculateRatingAction::makeJob())->daily();
    }
}
