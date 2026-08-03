<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Video Post – Video Sharing HTML Template')</title>
    <meta name="keywords" content="Blog website templates"/>
    <meta name="description" content="Author - Personal Blog Wordpress Template">
    <meta name="author" content="Rabie Elkheir">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Owl Carousel Assets -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          rel="stylesheet"
          type="text/css"/>

    <!--Google Fonts-->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|Raleway:400,500,700|Roboto:300,400,500,700,900|Ubuntu:300,300i,400,400i,500,500i,700"
        rel="stylesheet">

    @vite(['resources/js/main.js', 'resources/css/main.css'])

    {{--    <link rel="stylesheet" href="{{ asset('css/main.css') }}">--}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!--======= header =======-->

<style>
    .site-header{ background: #3a4057; border-bottom:1px solid rgba(255,255,255,.08); }
    .btn-accent{ background:#FF5A36; color:#fff; }
    .btn-accent:hover{ background:#e64c26; color:#fff; }
    .text-accent{ color:#FF5A36 !important; }
    .btn-link-light{ color:#E8E8F0; text-decoration:none; font-size:14px; }
    .btn-link-light:hover{ color:#FF5A36; }
</style>

<!--======= header =======-->
<header class="site-header text-light py-2">
    <div class="container-fluid px-4 px-md-5">
        <div class="d-flex align-items-center justify-content-between gap-3">

            <!-- Logo + mobile toggle -->
            <div class="d-flex align-items-center gap-3 P-4">
                <a id="main-category-toggler" class="btn btn-outline-light btn-sm rounded-circle d-md-none" href="#">
                    <i class="fa fa-navicon"></i>
                </a>
                <a id="main-category-toggler-close" class="btn btn-outline-light btn-sm rounded-circle d-none" href="#">
                    <i class="fa fa-close"></i>
                </a>
                <div id="logo">
                    <a href="{{ route('index') }}"><img src="{{ Vite::asset('public/img/logo.png') }}" height="32" alt=""></a>
                </div>
            </div>

            <!-- Search -->
            <form id="hgh" action="{{ route('videos.search') }}" method="GET"
                  class="d-none d-md-flex flex-grow-1 mx-3" style="max-width:420px;">
                <input type="text" name="q" value="{{ request()->query('q') }}"
                       class="form-control rounded-pill bg-transparent text-light border-secondary"
                       placeholder="جستجو ...">
                <button type="submit" class="btn btn-accent rounded-circle ms-2" style="width:38px;height:38px;">
                    <i class="fa fa-search"></i>
                </button>
            </form>

            <!-- Actions -->
            @inject('basket', 'App\Support\Basket\Basket')
            <div class="d-flex align-items-center gap-2">

                <a href="{{ route('basket.index') }}" class="btn btn-outline-light btn-sm me-5">
                    <i class="fa fa-shopping-basket me-1"></i>
                    سبد خرید
                    <span class="badge bg-accent" style="background:#FF5A36;">{{ $basket->itemCount() }}</span>
                </a>

                @auth
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-light text-decoration-none dropdown-toggle"
                           id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->gravatar }}" class="rounded-circle me-2"
                                 width="34" height="34" alt="{{ auth()->user()->name }}">
                            <div class="d-none d-md-block">
                                <div class="small fw-semibold">{{ auth()->user()->name }}</div>
                                <div class="small text-secondary">25 اشتراک</div>
                            </div>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="userDropdown"
                        style="z-index: 10000;">
                            <li><a class="dropdown-item" href="#"><i class="fa fa-edit text-accent me-2"></i>ویرایش پروفایل</a></li>
                            <li><a class="dropdown-item" href="{{ route('orders.index') }}"><i class="fa fa-shopping-cart text-accent me-2"></i>سفارشات</a></li>
                            <li><a class="dropdown-item" href="{{ route('videos.create') }}"><i class="fa fa-video-camera text-accent me-2"></i>اضافه کردن فیلم</a></li>
                            <li><a class="dropdown-item" href="{{ route('file.create') }}"><i class="fa fa-upload text-accent me-2"></i>آپلود فایل</a></li>
                            <li><a class="dropdown-item" href="{{ route('file.index') }}"><i class="fa fa-folder text-accent me-2"></i>فایل‌ها</a></li>
                            <li><a class="dropdown-item" href="{{ route('two-factor-auth.index') }}"><i class="fa fa-shield text-accent me-2"></i>احراز هویت دو مرحله‌ای</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @role('admin', 'editor')
                            <li><a class="dropdown-item" href="{{ route('users.index') }}"><i class="fa fa-tachometer text-accent me-2"></i>پنل مدیریت</a></li>
                            @endrole
                            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="fa fa-sign-out me-2"></i>خروج</a></li>
                        </ul>
                    </div>
                @endauth

                @guest()
                    <a class="btn-link-light" href="{{ route('login.create') }}">ورود</a>
                    <a class="btn btn-accent rounded-pill btn-sm px-3" href="{{ route('register.create') }}">
                        <i class="fa fa-user-plus me-1"></i> ثبت نام
                    </a>
                @endguest
            </div>

        </div>
    </div>
</header><!-- // header -->

<x-header-menu></x-header-menu>

{{--@if(!request()->routeIs('roles.index', 'roles.edit'))
    <x-validation-errors></x-validation-errors>
@endif--}}

<div class="site-output" id="app">

    <div id="all-output" class="col-md-12" style="margin-top: 30px !important;">
        @yield('content')
    </div>
</div>

@include('sweetalert::alert')

<script>

    window.user = {!!
          json_encode([
              'authenticated' => auth()->check(),
              'id' => auth()->check() ? auth()->user()->id : null,
              'name' => auth()->check() ? auth()->user()->name : null,
          ])
    !!}

</script>
</body>

</html>
