<?php

namespace App\Console\Commands;

use App\Models\LoginToken;
use Illuminate\Console\Command;

class ClearLoginTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:clear-tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all login tokens.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        LoginToken::expired()->delete();

        $this->info('Expired login tokens deleted successfully.');
    }
}
