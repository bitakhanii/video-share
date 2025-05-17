<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function registerForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'department' => ['required'],
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department' => $request->department,
        ]);

        $this->guard()->login($admin);

        return redirect(route('index', absolute: false));
    }

    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        if ($this->guard()->attempt($request->only('email', 'password'))) {
            session([
                'remember' => $request->remember,
            ]);

            $request->session()->regenerate();
            return redirect()->intended();
        }

        return back()->with([
            'alert' => __('alerts.danger.login'),
            'alert-type' => 'danger',
        ]);
    }

    private function guard()
    {
        return Auth::guard('admin');
    }
}
