<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\TwoFactorAuthRequest;
use App\Services\TwoFactorAuth\TwoFactorAuthentication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request, TwoFactorAuthentication $auth): RedirectResponse
    {
        $user = $request->authenticate($auth);

        session([
            'remember' => $request->remember,
        ]);

        if ($user->hasTwoFactorAuth()) {
            $auth->requestCode($user);
            return $this->sendTwoFactorAuthResponse();
        }

        Auth::login($user, $request->remember);

        $request->session()->regenerate();

        return redirect()->intended();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function sendTwoFactorAuthResponse()
    {
        return redirect()->route('login.two-factor-auth.form');
    }
}
