<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Jobs\SendSms;
use App\Models\User;
use App\Services\Notification\Constants\EmailTypes;
use App\Services\Notification\Exceptions\UserDoesNotHavePhoneNumber;
use App\Services\Notification\Notification;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;
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
        ]);

        try {
            $user = User::query()->find($request->user);
            $mailable = EmailTypes::toMail($request->email_type);
            SendEmail::dispatch($user, new $mailable);

            return redirect()->back()->with('success', 'ایمیل با موفقیت ارسال شد.');

        } catch (Throwable $th) {
            return $this->redirectBack('failed', 'service_has_a_problem', 'ایمیل');
        }
    }

    public function sms()
    {
        $users = User::all();
        return view('notification.sms', compact('users'));
    }

    public function sendSms(Request $request, Notification $notification)
    {
        $request->validate([
            'user' => ['integer', 'exists:users,id'],
            'text' => ['string', 'max:256'],
        ], ['user.integer' => 'کاربری با این آیدی وجود ندارد.']);

        try {
            $user = User::query()->find($request->user);
            SendSms::dispatch($user, $request->text);
            return $this->redirectBack('success', 'sms_sent_successfully');
        } catch (Exception $e) {
            return $this->redirectBack('failed', 'service_has_a_problem', 'پیام کوتاه');
        }
    }

    private function redirectBack(string $alert, string $message, String $replace = '')
    {
        return redirect()->back()->with($alert, __('notification.' . $message , ['attribute' => $replace]));
    }
}
