<?php
namespace App\Services\TwoFactorAuth\Traits;

use App\Models\TwoFactorAuth;

Trait HasTwoFactorAuth
{
    public function twoFactorAuth()
    {
        return $this->hasOne(TwoFactorAuth::class);
    }

    public function hasTwoFactorAuth()
    {
        return $this->has_2fa;
    }

    public function makeHasTwoFactorAuthTrue()
    {
        $this->has_2fa = true;
        $this->save();
    }

    public function makeHasTwoFactorAuthFalse()
    {
        $this->has_2fa = false;
        $this->save();
    }
}
