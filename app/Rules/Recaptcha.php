<?php

namespace App\Rules;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class Recaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString $fail
     * @throws ConnectionException
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $response = Http::withoutVerifying()->asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $value,
        ]);

        if (! $response->json('success')) {
            $fail(__('auth.invalid-recaptcha'));
        }
    }
}
