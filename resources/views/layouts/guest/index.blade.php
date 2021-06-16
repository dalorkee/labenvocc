<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LAB ENV-OCC</title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" media="screen, print" href="{{ URL::asset('assets/css/vendors.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ URL::asset('assets/css/app.bundle.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('assets/img/favicon/favicon-32x32.png') }}">
    <link rel="mask-icon" href="{{ URL::asset('assets/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="{{ URL::asset('assets/css/fa-brands.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ URL::asset('css/fonts.css') }}">
    <style type="text/css">
         .font-sukhumvit {font-family: "sukhumvit"};
    </style>
    @yield('style')
</head>
<body>
<div class="page-wrapper">
    <div class="page-inner bg-brand-gradient">
        <div class="page-content-wrapper bg-transparent m-0">
            <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                <div class="d-flex align-items-center container p-0">
                    <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9">
                        <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                            <img src="{{ URL::asset('assets/img/small-moph-logo.png') }}" alt="logo" aria-roledescription="logo">
                            <span class="page-logo-text mr-1">LAB ENV-OCC</span>
                        </a>
                    </div>
                    <a href="{{ route('register.create') }}" title="Register" class="btn-link text-white ml-auto font-sukhumvit">ลงทะเบียน</a>
                </div>
            </div>
            <div class="flex-1" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
                <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                    @yield('content')
                </div>
                @include('layouts.guest.footer')
            </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset('assets/js/vendors.bundle.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.bundle.js') }}"></script>
@yield('script')
</body>
</html>