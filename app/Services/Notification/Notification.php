<?php

namespace App\Services\Notification;

use App\Models\User;
use App\Services\Notification\Providers\Contracts\Provider;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Mail\Mailable;

class Notification
{
    /**
     * @method sendSms(User $user, String $text)
     * @method sendEmail(User $user, Mailable $mailable)
     * @throws Exception
     */

    public function __call($method, $arguments)
    {
        $providerPath = __NAMESPACE__ . '\Providers\\' . substr($method, 4);
        if (! class_exists($providerPath)) {
            throw new Exception("The provider does not exists");
        }

        $providerInstance = new $providerPath(... $arguments);
        if (! is_subclass_of($providerInstance, Provider::class)) {
            throw new Exception("The class must implements " . Provider::class);
        }

        return $providerInstance->send();
    }
}
