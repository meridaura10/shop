<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Actions\Location\LocationImport as LocationImportAction;

class LocationImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'location:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command import locations from xml file';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
       LocationImportAction::run();
    }
}
