<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\TwoFactorAuthRequest;
use App\Services\TwoFactorAuth\TwoFactorAuthentication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;

class TwoFactorAuthController extends Controller
{
    protected TwoFactorAuthentication $auth;

    public function __construct(TwoFactorAuthentication $auth)
    {
        $this->auth = $auth;
    }

    public function index()
    {
        return view('auth.two-factor-auth.index');
    }

    public function sendCode(): RedirectResponse
    {
        return $this->auth->requestCode(Auth::user()) == $this->auth::CODE_SENT
            ? success_redirect('two-factor-auth.enter-code', 'send', 'code')
            : error_redirect('back', 'problem');
    }

    public function enterCode()
    {
        return view('auth.two-factor-auth.enter-code');
    }

    public function activate(TwoFactorAuthRequest $request): RedirectResponse
    {
        return $this->auth->activate($request->code) == $this->auth::ACTIVATED
            ? success_redirect('index', 'activate', '2fa')
            : error_redirect('back', 'invalid', 'code');
    }

    public function deactivate(): RedirectResponse
    {
        $this->auth->deactivate(auth()->user());
        return success_redirect('index', 'deactivate', '2fa');
    }

    public function resent(): RedirectResponse
    {
        $this->auth->resent();
        return success_redirect('back', 'send', 'code');
    }

    public function loginForm()
    {
        return view('auth.two-factor-auth.login');
    }

    public function login(TwoFactorAuthRequest $request): RedirectResponse
    {
        return $this->auth->login() == $this->auth::INVALID_CODE
            ? error_redirect('back', 'invalid', 'code')
            : success_redirect('index', 'welcome');
    }
}
