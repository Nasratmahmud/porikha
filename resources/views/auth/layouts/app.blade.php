<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>

    <!-- Theme Core -->
    <link rel="stylesheet" href="{{ asset('frontend_old/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_old/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_old/css/dashboard-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_old/css/dashboard-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_old/vendor/normalize-css/normalize.css') }}">
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('frontend_old/vendor/bootstrap-5.3.0/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_old/vendor/bootstrap-icons-1.10.3/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend_old/css/nice-select.css') }}">
    <!-- Google Font : poppins, Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Roboto&display=swap"
        rel="stylesheet">

    @stack('css_style')
</head>


<body>

    @yield('content')


    <!-- JS -->
    <script src="{{ asset('frontend_old/vendor/bootstrap-5.3.0/js/bootstrap.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('frontend_old/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend_old/js/main.js') }}"></script>

    <!-- JS -->
    <script src="{{ asset('frontend_old/vendor/bootstrap-5.3.0/js/bootstrap.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('frontend_old/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend_old/js/main.js') }}"></script>

    @stack('script')



</body>

</html>

