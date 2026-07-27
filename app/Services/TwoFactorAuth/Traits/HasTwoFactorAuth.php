<?php

namespace App\Services\TwoFactorAuth\Traits;

use App\Models\TwoFactorAuth;

trait HasTwoFactorAuth
{
    /* Relations Methods */
    public function twoFactorAuth()
    {
        return $this->hasOne(TwoFactorAuth::class);
    }

    /* End Relations Methods */

    public function hasTwoFactorAuth(): bool
    {
        return $this->has_2fa;
    }

    public function makeHasTwoFactorAuthTrue(): void
    {
        $this->has_2fa = true;
        $this->save();
    }

    public function makeHasTwoFactorAuthFalse(): void
    {
        $this->has_2fa = false;
        $this->save();
    }
}
