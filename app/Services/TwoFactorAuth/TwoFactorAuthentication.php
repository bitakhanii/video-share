<?php

namespace App\Services\TwoFactorAuth;

use App\Models\TwoFactorAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthentication
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    const CODE_SENT = 'code.sent';
    const ACTIVATED = 'activated';
    const INVALID_CODE = 'invalid-code';

    public function requestCode($user)
    {
        $code = TwoFactorAuth::generateCode($user);
        $code->send();
        $this->setSession($code);
        return static::CODE_SENT;
    }

    public function activate()
    {
        if (!$this->isValidCode()) return self::INVALID_CODE;

        $this->getUser()->makeHasTwoFactorAuthTrue();
        $this->getCode()->delete();
        $this->forgetSession();
        return self::ACTIVATED;
    }

    public function deactivate()
    {
        $user = auth()->user();
        $user->makeHasTwoFactorAuthFalse();
    }

    public function login()
    {
        if (!$this->isValidCode()) return self::INVALID_CODE;

        $this->getCode()->delete();
        Auth::login($this->getUser(), session('remember'));

        $this->forgetSession();
    }

    public function resent()
    {
        $this->requestCode($this->getUser());
    }

    protected function isValidCode()
    {
        return !$this->getCode()->isExpired() && $this->getCode()->isEqualsWith($this->request->code);
    }

    protected function setSession($code)
    {
        session([
            'code_id' => $code->id,
            'user_id' => $code->user_id,
        ]);
    }

    protected function forgetSession()
    {
        session()->forget(['user_id', 'code_id', 'remember']);
    }

    protected function getCode()
    {
        return $this->code ?? TwoFactorAuth::query()->where('id', '=', session('code_id'))->first();
    }

    protected function getUser()
    {
        return User::query()->where('id', '=', session('user_id'))->first();
    }
}
