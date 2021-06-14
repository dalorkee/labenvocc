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
                            <a href="page_register.html" class="btn-link text-white ml-auto">Register</a>
                        </div>
                    </div>
                    <div class="flex-1" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
                        <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                            <div class="row">
                                <div class="col col-md-6 col-lg-7 hidden-sm-down">
                                    <h2 class="fs-xxl fw-500 mt-4 text-white">ข่าว/ประกาศ</h2>
                                        <ul>
                                            <li>
                                                <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60">
                                                    คำแนะนำการปฏิบัติตนสำหรับเจ้าหน้าที่หน่วยงานอื่นๆ (ไม่ใช่เจ้าหน้าที่สาธารณสุข) 
                                                    ที่เข้าไปปฏิบัติงานในพื้นที่ที่เกิดการระบาดของโรคติดเชื้อไวรัสโคโรนา 2019
                                                </small>
                                            </li>
                                            <li>
                                                <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60">
                                                    All of the authentication view's rendering logic may be 
                                                    customized using the appropriate methods available via the Laravel\Fortify\Fortify
                                                </small>
                                            </li>
                                            <li>
                                                <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60">
                                                    Sometimes, you may wish to have full customization over how user credentials are authenticated 
                                                    and how users are retrieved from your application's database. Thankfully, Jetstream allows you 
                                                    to easily accomplish this using the Fortify::authenticateUsing method.
                                                </small>
                                            </li>
                                        </ul>
                                    <div class="d-sm-flex flex-column align-items-center justify-content-center d-md-block">
                                        <div class="px-0 py-1 mt-5 text-white fs-nano opacity-50">
                                            Env-Occ social media
                                        </div>
                                        <div class="d-flex flex-row opacity-70">
                                            <a href="#" class="mr-2 fs-xxl text-white">
                                                <i class="fab fa-facebook-square"></i>
                                            </a>
                                            <a href="#" class="mr-2 fs-xxl text-white">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto">
                                    <h1 class="text-white fw-300 mb-3 d-sm-block d-md-none">App Sing in</h1>
                                    <div class="card p-4 rounded-plus bg-faded">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="form-label" for="username">Username/Email</label>
                                                <input name="identity" type="text" id="username" class="form-control form-control-lg" required autofocus>
                                                <div class="invalid-feedback">No, you missed this one.</div>
                                                <div class="help-block">Your unique username to app</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="password">Password</label>
                                                <input name="password" type="password" id="password" class="form-control form-control-lg" required>
                                                <div class="invalid-feedback">Sorry, you missed this one.</div>
                                                <div class="help-block">Your password</div>
                                            </div>
                                            <div class="form-group text-left">
                                                <div class="custom-control custom-checkbox">
                                                    <input name="remember" type="checkbox" id="remember_me" class="custom-control-input">
                                                    <label class="custom-control-label" for="rememberme"> Remember me.</label>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-lg-6 pr-lg-1 my-2">
                                                    <button type="reset" class="btn btn-warning btn-block btn-lg text-white">Clear</button>
                                                </div>
                                                <div class="col-lg-6 pl-lg-1 my-2">
                                                    <button id="js-login-btn" type="submit" class="btn btn-info btn-block btn-lg"> Sign in</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                                2021 © Power by &nbsp;<a href='#' class='text-white opacity-40 fw-500' title='Talek Team' target='_blank'>Talek team.</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ URL::asset('assets/js/vendors.bundle.js') }}"></script>
        <script src="{{ URL::asset('assets/js/app.bundle.js') }}"></script>
        <script>
            $("#js-login-btn").click(function(event) {
                // Fetch form to apply custom Bootstrap validation
                var form = $("#js-login")
                if (form[0].checkValidity() === false) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.addClass('was-validated');
                // Perform ajax submit here...
            });
        </script>
    </body>
</html>
