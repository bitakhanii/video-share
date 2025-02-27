@extends('auth-layout')
@section('content')
    <div id="log-in" class="site-form log-in-form">

        <div id="log-in-head">
            <h1>احراز هویت دومرحله‌ای</h1>
            <div id="logo"><a href="{{ route('index') }}"><img src="img/logo.png" alt=""></a></div>
        </div>

        <div class="mb-4 text-sm text-gray-600" style="padding: 10px">
            کد احراز هویت به ایمیل شما ارسال شده‌است. لطفا کد را در ورودی زیر وارد نمایید.
            <br>
            توجه داشته‌باشد که این کد فقط به مدت یک دقیقه معتبر می‌باشد.
        </div>
        <div class="form-output">
            <x-validation-errors></x-validation-errors>
            <form action="{{ route('two-factor-auth.activate') }}" method="POST">
                @csrf
                <input class="form-control" name="code" placeholder="کد را اینجا وارد کنید...">
                <a class="small ml-2" href="{{ route('two-factor-auth.resent') }}">کد را دریافت نکرده‌اید؟</a>
                <button type="submit" class="btn btn-lg btn-primary full-width">اعمال کد</button>
            </form>
        </div>
    </div>
@endsection
