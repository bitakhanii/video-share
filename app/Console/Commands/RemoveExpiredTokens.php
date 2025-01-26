<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Sanctum\PersonalAccessToken;

class RemoveExpiredTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:remove {--days=7 : The number of days to retain expired tokens}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all expired tokens';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiration = config('sanctum.expiration');
        if ($expiration) {
            $tokens = PersonalAccessToken::query()->where('created_at', '<', now()->subMinutes($expiration + ($this->option('days')* 24 * 60)));
            $tokens->delete();
            $this->info('All expired tokens removed.');
        } else {
            $this->warn('Expire time is not set!');
        }
    }
}
