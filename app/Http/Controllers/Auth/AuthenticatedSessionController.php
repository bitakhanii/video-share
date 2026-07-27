<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\TwoFactorAuth\Traits\InteractsWithTwoFactorAuth;
use App\Services\TwoFactorAuth\TwoFactorAuthentication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    use InteractsWithTwoFactorAuth;

    protected TwoFactorAuthentication $twoFactorAuth;

    public function __construct(TwoFactorAuthentication $twoFactorAuth)
    {
        $this->twoFactorAuth = $twoFactorAuth;
    }

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     * @throws ValidationException
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $user = $request->authenticate();

        session([
            'remember' => $request->remember,
        ]);

        if ($this->requiresTwoFactorChallenge($user)) {
            return redirect()->route('login.two-factor-auth.form');
        }

        Auth::login($user, $request->remember);

        $request->session()->regenerate();

        return success_redirect('intended', 'welcome');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return success_redirect('index', 'logout');
    }
}
