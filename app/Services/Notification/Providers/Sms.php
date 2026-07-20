<?php

namespace App\Services\Notification\Providers;

use App\Models\User;
use App\Services\Notification\Exceptions\UserDoesNotHavePhoneNumber;
use App\Services\Notification\Providers\Contracts\Provider;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class Sms implements Provider
{
    private User $user;
    private string $text;

    public function __construct(User $user, string $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    /**
     * @throws ConnectionException
     */
    public function send(): array
    {
        $apiKey = config('services.sms.sms_api_key');
        $url = 'https://api.sms.ir/v1/send/verify';
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'text/plain',
            'x-api-key' => $apiKey,
        ];

        $response = Http::withoutVerifying()
            ->withHeaders($headers)
            ->post($url, [
                'mobile'     => $this->user->phone_number,
                'templateId' => 123456,
                'parameters' => [
                    ['name' => 'Code', 'value' => '12345'],
                ],
            ]);

        if ($response->successful()) {
            return ['success' => true, 'data' => $response->body()];
        }

        return [
            'success' => false,
            'status'  => $response->status(),
            'message' => $response->body(),
        ];

        /*$result = Http::withoutVerifying()->withHeaders($headers)
            ->get('https://api.sms.ir/v1/send/' . $response['data']['messageId']);
        dd($result->json()['data']['lineNumber']);*/
    }
}
