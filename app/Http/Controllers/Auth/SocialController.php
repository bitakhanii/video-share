<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $providerUser = $this->findOrCreateUser($user, $provider);

        Auth::login($providerUser);

        return redirect()->intended();
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
            ''
        ]);

    }
}
