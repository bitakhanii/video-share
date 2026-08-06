@extends('layout')

@section('title', 'ثبت نام مدیران')

@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">

                <div class="card shadow-lg border-0 rounded-4">

                    <div class="card-header bg-dark text-white text-center py-4 rounded-top-4">
                        <h3 class="mb-1">ثبت نام مدیران</h3>
                        <p class="mb-0 text-light small">
                            اطلاعات زیر را برای ایجاد حساب کاربری وارد کنید.
                        </p>
                    </div>

                    <div class="card-body p-4">

                        <x-validation-errors />

                        <form method="POST" action="{{ route('admin.register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">نام</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="نام مدیر"
                                    required
                                    autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">ایمیل</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="example@email.com"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">رمز عبور</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    placeholder="••••••••"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">
                                    تکرار رمز عبور
                                </label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="••••••••"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label for="department" class="form-label">بخش</label>

                                <select class="form-select" id="department" name="department">
                                    <option value="0">فنی</option>
                                    <option value="1">مالی</option>
                                    <option value="2">پشتیبانی</option>
                                </select>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark btn-lg">
                                    ثبت نام
                                </button>
                            </div>

                        </form>

                        <hr class="my-4">

                        <div class="text-center">
                        <span class="text-muted">
                            قبلاً ثبت‌نام کرده‌اید؟
                        </span>

                            <a href="{{ route('admin.login.form') }}"
                               class="text-decoration-none fw-bold ms-1">
                                ورود به پنل مدیریت
                            </a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
