<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\TwoFactorAuthRequest;
use App\Services\TwoFactorAuth\TwoFactorAuthentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthController extends Controller
{
    protected $auth;

    public function __construct(TwoFactorAuthentication $auth)
    {
        $this->auth = $auth;
    }

    public function index()
    {
        return view('auth.two-factor-auth.index');
    }

    public function sendCode()
    {
        return $this->auth->requestCode(Auth::user()) == $this->auth::CODE_SENT
            ? redirect()->route('two-factor-auth.enter-code')->with([
                'alert' => __('alerts.success.send', ['attribute' => 'کد احرازهویت']),
                'alert-type' => 'success',
            ])
            : back()->with([
                'alert' => __('alerts.danger.problem'),
                'alert-type' => 'danger',
            ]);
    }

    public function enterCode()
    {
        return view('auth.two-factor-auth.enter-code');
    }

    public function activate(TwoFactorAuthRequest $request)
    {
        return $this->auth->activate($request->code) == $this->auth::ACTIVATED
            ? redirect()->route('index')->with([
                'alert' => __('alerts.success.activate', ['attribute' => 'احراز هویت دومرحله‌ای']),
                'alert-type' => 'success',
            ])
            : redirect()->route('two-factor-auth.index')->with([
                'alert' => __('alerts.danger.invalid', ['attribute' => 'کد وارد شده']),
                'alert-type' => 'danger',
            ]);
    }

    public function deactivate()
    {
        $this->auth->deactivate();
        return redirect()->route('index')->with([
            'alert' => __('alerts.success.deactivate', ['attribute' => 'احرازهویت دومرحله‌ای']),
            'alert-type' => 'success',
        ]);
    }

    public function resent()
    {
        $this->auth->resent();
        return back()->with([
            'alert' => __('alerts.success.send', ['attribute' => 'کد احراز هویت مجددا']),
            'alert-type' => 'success',
        ]);
    }

    public function loginForm()
    {
        return view('auth.two-factor-auth.login');
    }

    public function login(TwoFactorAuthRequest $request)
    {
        return $this->auth->login() == $this->auth::INVALID_CODE
            ? back()->with([
                'alert' => __('alerts.danger.invalid', ['attribute' => 'کد وارد شده']),
                'alert-type' => 'danger',
            ])
            :redirect()->route('index')->with([
                'alert' => __('alerts.success.welcome'),
                'alert-type' => 'success',
            ]);
    }
}
