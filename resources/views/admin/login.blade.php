@extends('layout')

@section('title', 'ورود مدیران')

@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">

                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-dark text-white text-center py-4 rounded-top-4">
                        <h3 class="mb-1">پنل مدیریت</h3>
                        <p class="mb-0 text-light small">برای ورود اطلاعات خود را وارد کنید.</p>
                    </div>

                    <div class="card-body p-4">

                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">ایمیل</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="example@email.com"
                                    required
                                    autofocus>
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

                            <div class="form-check mb-4">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="remember"
                                    name="remember">

                                <label class="form-check-label" for="remember">
                                    مرا به خاطر بسپار
                                </label>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark btn-lg">
                                    ورود
                                </button>
                            </div>
                        </form>

                        <hr class="my-4">

                        <div class="text-center">
                            <span class="text-muted">حساب کاربری ندارید؟</span>
                            <a href="{{ route('admin.register.form') }}"
                               class="text-decoration-none fw-bold ms-1">
                                ثبت‌نام مدیر
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
