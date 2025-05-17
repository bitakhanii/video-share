@extends('layout')

@section('title' , 'ورود مدیران')


@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-header ">
                    ورود مدیران
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="email">ایمیل</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" id="email"
                                       value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="password">رمز عبور</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-check offset-sm-3">
                                <input type="checkbox" class="form-check-input" name="remember"
                                       id="remember">
                                <label class="form-check-label"
                                       for="remember"><small>مرا به‌خاطر بسپار</small></label>
                            </div>
                        </div>
                        <div class="offset-sm-3">
                            <button type="submit" class="btn btn-primary">ورود</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
