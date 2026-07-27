<?php

namespace App\Models;

use App\Jobs\SendEmail;
use App\Mail\SendMagicLink;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Mail;

class LoginToken extends Model
{
    const EXPIRY_SECONDS = 120;

    protected $fillable = [
        'token',
        'user_id',
    ];

    public function getRouteKeyName(): string
    {
        return 'token';
    }

    /* Relation Methods */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* End Relation Methods */

    public function send($options): void
    {
        Mail::to($this->user)->send(new SendMagicLink($this, $options));
        //way2 SendEmail::dispatch($this->user, new SendMagicLink($this, $options));
    }

    public function isExpired(): bool
    {
        return $this->created_at->diffInSeconds(now()) > self::EXPIRY_SECONDS;
    }

    public function scopeExpired($query)
    {
        return $query->where('created_at', '<', now()->subSeconds(self::EXPIRY_SECONDS));
    }
}
