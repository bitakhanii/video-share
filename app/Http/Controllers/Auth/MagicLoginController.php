<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginToken;
use App\Services\MagicLogin\MagicAuthentication;
use Illuminate\Http\Request;

class MagicLoginController extends Controller
{
    protected MagicAuthentication $auth;

    public function __construct(MagicAuthentication $auth)
    {
        $this->auth = $auth;
    }

    public function create()
    {
        return view('auth.magic-login');
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $this->auth->requestLink();
        return success_redirect('back', 'send', 'email');
    }

    public function login(LoginToken $token)
    {
        return match ($this->auth->authenticate($token)) {
            $this->auth::AUTHENTICATED => success_redirect('index', 'welcome'),
            $this->auth::REQUIRES_TWO_FACTOR => redirect()->route('login.two-factor-auth.form'),
            default => error_redirect('magic-login.create', 'invalid', 'link'),
        };
    }

    private function validateRequest($request): void
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);
    }
}
