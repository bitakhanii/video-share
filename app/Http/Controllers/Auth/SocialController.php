<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TwoFactorAuth\Traits\InteractsWithTwoFactorAuth;
use App\Services\TwoFactorAuth\TwoFactorAuthentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    use InteractsWithTwoFactorAuth;

    protected TwoFactorAuthentication $twoFactorAuth;
    public function __construct(TwoFactorAuthentication $twoFactorAuth)
    {
        $this->twoFactorAuth = $twoFactorAuth;
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $providerUser = $this->findOrCreateUser($user, $provider);

        if ($this->requiresTwoFactorChallenge($providerUser)) {
            return redirect()->route('login.two-factor-auth.form');
        }

        Auth::login($providerUser);

        return success_redirect('intended', 'welcome');
    }

    public function findOrCreateUser($user, $provider)
    {
        $providerUser = User::query()->where('email', '=', $user->getEmail())->first();

        if (!is_null($providerUser)) return $providerUser;

        return User::create([
            'provider' => $provider,
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'provider_id' => $user->getId(),
            'avatar' => $user->getAvatar(),
            'email_verified_at' => now(),
        ]);

    }
}
