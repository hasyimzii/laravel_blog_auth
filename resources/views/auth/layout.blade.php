<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('assets/dashboard/images/favicon.png') }}">
    <link href="{{ asset('assets/dashboard/css/style.css') }}" rel="stylesheet">

</head>

<body class="h-100">
    @include('sweetalert::alert')
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-4">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <!-- CONTENT -->
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('assets/dashboard/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/quixnav-init.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/custom.min.js') }}"></script>

</body>

</html>