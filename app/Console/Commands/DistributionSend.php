<?php

namespace App\Console\Commands;

use App\Jobs\SendMailMessageLeadsJob;
use App\Models\Distribution;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DistributionSend extends Command
{
    protected $signature = 'app:distribution-send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $now = now();

        $distributions = Distribution::query()
            ->whereStatus(Distribution::STATUS_PENDING)
            ->where('send_at', '<=', $now)
            ->get();

        foreach ($distributions as $distribution) {
            dispatch(new SendMailMessageLeadsJob($distribution->message));

            $distribution->update(['status' => Distribution::STATUS_CONFIRMED]);
        }
    }
}
