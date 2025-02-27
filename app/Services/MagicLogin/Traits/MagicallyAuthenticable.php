<?php

namespace App\Services\MagicLogin\Traits;

use App\Models\LoginToken;
use Illuminate\Support\Str;

Trait MagicallyAuthenticable
{
    public function loginToken()
    {
        return $this->hasOne(LoginToken::class);
    }

    public function generateToken()
    {
        $this->loginToken()->delete();
        return $this->loginToken()->create([
            'token' => Str::random(50),
        ]);
    }
}
