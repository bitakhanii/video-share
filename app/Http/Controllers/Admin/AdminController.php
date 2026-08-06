<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function registerForm()
    {
        return view('admin.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'department' => ['required', 'int'],
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department' => $request->department,
        ]);

        $this->guard()->login($admin);

        return success_redirect('index', 'welcome');
    }

    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
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
            return success_redirect('intended', 'welcome');
        }

        return error_redirect('back', 'login');
    }

    public function logout(): RedirectResponse
    {
        auth()->guard('admin')->logout();
        return success_redirect('index', 'logout');
    }

    private function guard()
    {
        return Auth::guard('admin');
    }
}
