<!DOCTYPE html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Meta -->
<meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
<meta name="author" content="BERNITEK">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- vendor css -->
<link href="{{ asset('lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">

<!-- DashForge CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/dashforge.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/dashforge.auth.css') }}">
</head>

<body>

    <div class="content content-fixed content-auth-alt">
        <div class="container ht-100p tx-center">
            <div class="ht-100p d-flex flex-column align-items-center justify-content-center">
                <div class="wd-70p wd-sm-250 wd-lg-300 mg-b-15"><img src="{{ asset('error_undraw.svg') }}"
                        class="img-fluid" alt=""></div>
                <h1 class="tx-color-01 tx-24 tx-sm-32 tx-lg-36 mg-xl-b-5">@yield('code') @yield('message')</h1>
                <h5 class="tx-16 tx-sm-18 tx-lg-20 tx-normal mg-b-20">Oopps. The service is temporarily unavailable.
                </h5>
                <p class="tx-color-03 mg-b-30">The server is unable to service your request due to maintenance downtime
                    or capacity problems.</p>
                <div class="mg-b-40"><a class="btn btn-white bd-2 pd-x-30" href="{{ url('/') }}">Back to Home</a></div>
            </div>
        </div><!-- container -->
    </div><!-- content -->

    <footer class="footer">
        <div>
            <span>&copy; 2020 {{ config('app.name') }} v1.0.0. </span>
            <span>Created by <a href="http://hafizhfadh.github.io">Hafizh Fadhlurrohman</a></span>
        </div>
        <div>
            <nav class="nav">
                <a href="https://themeforest.net/licenses/standard" class="nav-link">Licenses</a>
            </nav>
        </div>
    </footer>

    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('lib/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('lib/jquery.flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('lib/jquery.flot/jquery.flot.resize.js') }}"></script>

    <script src="{{ asset('assets/js/dashforge.js') }}"></script>
    <script src="{{ asset('assets/js/dashforge.aside.js') }}"></script>

    <!-- append theme customizer -->
    <script src="{{ asset('lib/js-cookie/js.cookie.js') }}"></script>

</body>

</html>