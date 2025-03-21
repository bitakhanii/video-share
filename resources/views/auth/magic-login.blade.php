@extends('auth-layout')
@section('content')
    <div id="log-in" class="site-form log-in-form">

        <div id="log-in-head">
            <h1>ورود بدون رمز عبور</h1>
            <div id="logo"><a href="{{ route('index') }}"><img src="img/logo.png" alt=""></a></div>
        </div>

        <div class="form-output">
            <x-validation-errors></x-validation-errors>
            <form method="POST" action="{{ route('login.magic.store') }}">
                @csrf
                <div class="form-group label-floating">
                    <label class="control-label">ایمیل</label>
                    <input name="email" class="form-control" placeholder="" type="email">
                </div>

                <div class="remember">
                    <div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox">
                            مرا به خاطر بسپار
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-lg btn-primary full-width">ارسال لینک ورود</button>

            </form>
        </div>
    </div>

@endsection
