<?php

namespace App\Console\Commands;

use App\Actions\RecalculateRatingAction;
use Illuminate\Console\Command;

class RecalculateRating extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rating:recalculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'recalculate rating to models';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        RecalculateRatingAction::run();
    }
}
