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
    public function handle(): void
    {
        $expiration = config('sanctum.expiration');
        if ($expiration) {
            $tokens = PersonalAccessToken::query()
                ->where('created_at', '<',
                    now()->subMinutes($expiration + ($this->option('days') * 24 * 60)));
            $deletedTokens = $tokens->delete();

            if ($deletedTokens === 0) {
                $this->info("No expired token found.");
            } else {
                $this->info("{$deletedTokens} expired token(s) removed.");
            }
        } else {
            $this->warn('Expire time is not set!');
        }
    }
}
