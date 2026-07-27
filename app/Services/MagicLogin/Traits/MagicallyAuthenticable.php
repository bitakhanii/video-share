<?php

namespace App\Services\MagicLogin\Traits;

use App\Models\LoginToken;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

trait MagicallyAuthenticable
{
    /* Relation Methods */
    public function loginToken(): HasOne
    {
        return $this->hasOne(LoginToken::class);
    }

    /* End Relation Methods */

    public function generateToken()
    {
        $this->loginToken()->delete();
        return $this->loginToken()->create([
            'token' => Str::random(50),
        ]);
    }
}
