<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DailyLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily-log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Log a daily message to the system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $message = 'This is a message for date: '. now();
        Log::info($message);

        $this->info('Log message added.');
    }
}
