<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Jobs\SendSms;
use App\Models\User;
use App\Models\Video;
use App\Services\Notification\Constants\EmailTypes;
use App\Services\Notification\Notification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Throwable;

class NotificationController extends Controller
{
    public function email()
    {
        $users = User::all();
        $emailTypes = EmailTypes::toString();
        return view('notification.email', compact('users', 'emailTypes'));
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'user' => ['integer', 'exists:users,id'],
            'email_type' => ['integer'],
        ], ['user' => __('notification.user_id_not_found')]);

        try {
            $user = User::query()->find($request->user);
            $mailable = EmailTypes::toMail($request->email_type, ['user' => $user]);
            SendEmail::dispatch($user, $mailable);

            return $this->redirectBack('success', 'sending_queued', 'email');

        } catch (Throwable $th) {
            return $this->redirectBack('failed', 'service_has_a_problem', 'email');
        }
    }

    public function sms()
    {
        $users = User::all();
        return view('notification.sms', compact('users'));
    }

    public function sendSms(Request $request)
    {
        $request->validate([
            'user' => ['integer', 'exists:users,id'],
            'text' => ['string', 'max:256'],
        ], ['user' => __('notification.user_id_not_found')]);

        try {
            $user = User::query()->findOrFail($request->user);
            SendSms::dispatch($user, $request->text);
            return $this->redirectBack('success', 'sending_queued', 'sms');
        } catch (Throwable $e) {
            return $this->redirectBack('failed', 'service_has_a_problem', 'sms');
        }
    }

    private function redirectBack(string $alert, string $message, String $replace = '')
    {
        return redirect()
            ->back()
            ->with($alert, __('notification.' . $message , ['attribute' => __('notification.' . $replace)]));
    }
}
