@extends('auth-layout')
@section('content')
    <div id="log-in" class="site-form log-in-form">

        <div id="log-in-head">
            <h1>احراز هویت دومرحله‌ای</h1>
            <div id="logo"><a href="{{ route('index') }}"><img src="img/logo.png" alt=""></a></div>
        </div>

        @if(auth()->user()->hasTwoFactorAuth())
            <div class="mb-4 text-sm text-gray-600" style="padding: 10px">
                احراز هویت دومرحله‌ای برای شما فعال می‌باشد.
                <br>
                در صورت تمایل برای غیرفعالسازی این قابلیت روی دکمه ی زیر کلیک کنید.
            </div>
            <div class="form-output">
                <form method="POST" action="{{ route('two-factor-auth.deactivate') }}">
                    @csrf
                    <button class="btn btn-lg btn-primary full-width">غیرفعالسازی</button>
                </form>
            </div>
        @else
            <div class="mb-4 text-sm text-gray-600" style="padding: 10px">
                احراز هویت دومرحله‌ای برای شما فعال نمی‌باشد.
                <br>
                شماره همراه ثبت شده توسط شما درسیستم ما {{ auth()->user()->phone_number }} می‌باشد.
                <br>
                در صورت تمایل برای فعالسازی این قابلیت روی دکمه ی زیر کلیک کنید.
            </div>
            <div class="form-output">
                <a href="{{ route('two-factor-auth.send-code') }}" class="btn btn-lg btn-primary full-width">دریافت کد
                    و
                    فعالسازی</a>
            </div>
        @endif
    </div>
@endsection
