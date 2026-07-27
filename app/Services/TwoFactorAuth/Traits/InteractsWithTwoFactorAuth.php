<?php

namespace App\Services\TwoFactorAuth\Traits;

use App\Models\User;

trait InteractsWithTwoFactorAuth
{
    protected function requiresTwoFactorChallenge(User $user): bool
    {
        if (! $user->hasTwoFactorAuth()) {
            return false;
        }

        $this->twoFactorAuth->requestCode($user);

        return  true;
    }
}
