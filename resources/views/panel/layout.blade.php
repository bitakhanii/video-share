@extends('layout')
@section('content')

    <div id="panel-table" class="container pt-5">
        <div class="row">
            <!-- منو در سمت راست با ارتفاع کامل -->
            <div class="col-md-4 order-md-last">
                <div class="card h-100" style="min-height: 100vh;">
                    <div class="card-header bg-dark text-white">پنل مدیریت</div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><a href="#">داشبورد</a></li>
                            <li class="list-group-item"><a href="{{ route('users.index') }}">مدیریت کاربران</a></li>
                            <li class="list-group-item"><a href="{{ route('roles.index') }}">مدیریت نقش‌ها</a></li>
                            <li class="list-group-item"><a href="#">تنظیمات</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            @yield('panel-content')

        </div>
    </div>

@endsection
