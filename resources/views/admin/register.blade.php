@extends('layout')

@section('title' , 'ثبت نام مدیران')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">
                    ثبت نام مدیران
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.register') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="email">ایمیل</label>
                            <div class="col-sm-9"><input type="email" name="email"
                                                         class="form-control" id="email" value=""
                                                         aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="name">نام</label>
                            <div class="col-sm-9">
                                <input value="" type="text" name="name" class="form-control" id="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="password">رمز عبور</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control"
                                       id="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"
                                   for="password_confirmation">تکرار رمز عبور</label>
                            <div class="col-sm-9">
                                <input type="password" name="password_confirmation"
                                       class="form-control"
                                       id="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="department">بخش</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="department" name="department">
                                    <option value="0">فنی</option>
                                    <option value="1">مالی</option>
                                    <option value="2">پشتیبانی</option>
                                </select>

                            </div>
                        </div>
                        <button type="submit"
                                class="btn btn-primary">ثبت‌نام</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
