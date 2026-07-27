<?php

namespace App\Services\MagicLogin;

use App\Models\LoginToken;
use App\Models\User;
use App\Services\TwoFactorAuth\Traits\InteractsWithTwoFactorAuth;
use App\Services\TwoFactorAuth\TwoFactorAuthentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MagicAuthentication
{
    use InteractsWithTwoFactorAuth;
    const INVALID_TOKEN = 'invalid-token';
    const AUTHENTICATED = 'authenticated';
    const REQUIRES_TWO_FACTOR = 'requires-two-factor';

    protected Request $request;

    protected TwoFactorAuthentication $twoFactorAuth;

    public function __construct(Request $request, TwoFactorAuthentication $twoFactorAuth)
    {
        $this->request = $request;
        $this->twoFactorAuth = $twoFactorAuth;
    }

    public function requestLink(): void
    {
        $user = $this->getUser();
        $user->generateToken()->send([
            'remember' => $this->request->has('remember'),
        ]);
    }

    public function authenticate(LoginToken $token): string
    {
        if ($token->isExpired()) {
            return self::INVALID_TOKEN;
        }

        if ($this->requiresTwoFactorChallenge($token->user)) {
            return self::REQUIRES_TWO_FACTOR;
        }

        Auth::login($token->user, $this->request->remember);

        $token->delete();

        return self::AUTHENTICATED;
    }

    protected function getUser(): ?User
    {
        return User::query()->where('email', '=', $this->request->email)->first();
    }
}
