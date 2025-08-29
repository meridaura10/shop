<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Actions\SitemapGenerate as SitemapGenerateAction;

class SitemapGenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate sitemap';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        SitemapGenerateAction::run();
    }
}
