<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginToken;
use App\Services\MagicLogin\MagicAuthentication;
use Illuminate\Http\Request;

class MagicLoginController extends Controller
{
    protected $auth;

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
        return back()->with([
            'alert' => __('alerts.success.send', ['attribute' => 'ایمیل']),
            'alert-type' => 'success',
        ]);
    }

    public function login(LoginToken $token)
    {
        return $this->auth->authenticate($token) == $this->auth::AUTHENTICATED
            ? redirect()->route('index')
            : redirect()->route('login.magic.create')->with([
                'alert' => __('alerts.danger.invalid', ['attribute' => 'لینک']),
                'alert-type' => 'danger',
            ]);
    }

    private function validateRequest($request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);
    }
}
