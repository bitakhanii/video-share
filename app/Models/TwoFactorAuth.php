<?php

namespace App\Models;

use App\Jobs\SendEmail;
use Illuminate\Database\Eloquent\Model;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function send()
    {
        SendEmail::dispatch($this->user, new \App\Mail\TwoFactorAuth($this->code));
    }

    public function isExpired()
    {
        return $this->created_at->diffInSeconds(now()) > 60;
    }

    public function isEqualsWith($code)
    {
        return $this->code == $code;
    }
}
