<?php

namespace App\Models;

use App\Jobs\SendEmail;
use App\Mail\SendMagicLink;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class LoginToken extends Model
{
    protected $fillable = [
        'token',
        'user_id',
    ];

    public function getRouteKeyName()
    {
        return 'token';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function send($options)
    {
        Mail::to($this->user)->send(new SendMagicLink($this, $options));
        //way2 SendEmail::dispatch($this->user, new SendMagicLink($this, $options));
    }

    public function isExpired()
    {
        return $this->created_at->diffInSeconds(now()) > 120;
    }

    public function scopeExpired($query)
    {
        return $query->where('created_at', '<', now()->subSeconds(120));
    }
}
