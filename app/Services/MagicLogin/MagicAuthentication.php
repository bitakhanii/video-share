<?php

namespace App\Services\MagicLogin;

use App\Models\LoginToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MagicAuthentication
{
    const INVALID_TOKEN = 'invalid token';
    const AUTHENTICATED = 'authenticated';

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function requestLink()
    {
        $user = $this->getUser();
        $user->generateToken()->send([
            'remember' => $this->request->has('remember'),
        ]);

    }

    public function authenticate(LoginToken $token)
    {
        $token->delete();
        if ($token->isExpired()) {
            return self::INVALID_TOKEN;
        }

        Auth::login($token->user, $this->request->remember);
        return self::AUTHENTICATED;
    }

    protected function getUser()
    {
        return User::query()->where('email', '=', $this->request->email)->first();
    }
}
