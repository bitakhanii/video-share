<?php

namespace App\Models;

use App\Jobs\SendEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TwoFactorAuth extends Model
{
    protected $fillable = [
        'user_id',
        'code',
    ];

    public static function generateCode($user)
    {
        $user->TwoFactorAuth()->delete();
        return static::create([
            'user_id' => $user->id,
            'code' => mt_rand(10000, 99999),
        ]);
    }

    /* Relations Methods */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* End Relations Methods */

    public function send(): void
    {
        SendEmail::dispatch($this->user, new \App\Mail\TwoFactorAuth($this->code));
    }

    public function isExpired(): bool
    {
        return $this->created_at->diffInSeconds(now()) > 60;
    }

    public function isEqualsWith($code): bool
    {
        return $this->code == $code;
    }
}
