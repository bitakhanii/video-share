@extends('auth-layout')
@section('body-class', 'sing-up-page')
@section('content')
    <div id="log-in" class="site-form log-in-form">

        <div id="log-in-head">
            <h1>ثبت نام</h1>
            <div id="logo"><a href="{{ route('index') }}"><img src="img/logo.png" alt=""></a></div>
        </div>

        <div class="form-output">
            <x-alerts></x-alerts>
            <x-validation-errors></x-validation-errors>
            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <div class="form-group label-floating">
                    <label class="control-label">@lang('labels.name')</label>
                    <input class="form-control" name="name" type="text">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">@lang('labels.email')</label>
                    <input class="form-control" name="email" type="email">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">@lang('labels.phone_number')</label>
                    <input class="form-control" name="phone_number" type="text">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">@lang('labels.password')</label>
                    <input class="form-control" name="password" type="password">
                </div>

                <div class="form-group label-floating">
                    <label class="control-label">@lang('labels.password_confirmation')</label>
                    <input class="form-control" name="password_confirmation" type="password">
                </div>

                <button type="submit" class="btn btn-lg btn-primary full-width">ثبت نام</button>

                <div class="or"></div>

                <p>شما یک حساب کاربری دارید؟ <a href="{{ route('login.create') }}"> ورود!</a> </p>
            </form>
        </div>
    </div>

@endsection
