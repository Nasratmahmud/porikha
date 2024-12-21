<!DOCTYPE html>
<html lang="en">

<head>
    <!-- equired meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon-->
    @php($setting = \App\Models\Setting::first())

    @if (!empty($setting))
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset($setting->favicon) }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset($setting->favicon) }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset($setting->favicon) }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset($setting->favicon) }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset($setting->favicon) }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset($setting->favicon) }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset($setting->favicon) }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset($setting->favicon) }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset($setting->favicon) }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset($setting->favicon) }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset($setting->favicon) }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset($setting->favicon) }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset($setting->favicon) }}">
        <link rel="manifest" href="{{ asset($setting->favicon) }}">
        <meta name="author" content="{{ $setting->title }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset($setting->favicon) }}">
    @else
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('dashboard/image/fav-icon.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('dashboard/image/fav-icon.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('dashboard/image/fav-icon.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('dashboard/image/fav-icon.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('dashboard/image/fav-icon.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('dashboard/image/fav-icon.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('dashboard/image/fav-icon.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('dashboard/image/fav-icon.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dashboard/image/fav-icon.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('dashboard/image/fav-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('dashboard/image/fav-icon.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('dashboard/image/fav-icon.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dashboard/image/fav-icon.png') }}">
        <link rel="manifest" href="{{ asset('dashboard/image/fav-icon.png') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('dashboard/image/fav-icon.png') }}">
    @endif

    <title> @yield('title')</title>
    <!-- Libs CSS -->

    @include('frontend.partials.style')

</head>

<body>

    <!-- Moving Submenu -->
    <div class="techwave_fn_fixedsub">
        <ul></ul>
    </div>
    <!-- !Moving Submenu -->

    <!-- Preloader -->
    <div class="techwave_fn_preloader enabled">
        <svg>
            <circle class="first_circle" cx="50%" cy="50%" r="110"></circle>
            <circle class="second_circle" cx="50%" cy="50%" r="110"></circle>
        </svg>
    </div>
    <!-- !Preloader -->


    <!-- MAIN WRAPPER -->
    <div class="techwave_fn_wrapper">
        <div class="techwave_fn_wrap">
            <!-- Start:Header -->
            @include('frontend.partials.header')
            <!-- Start:Sidebar -->
            @include('frontend.partials.sidebar')

            <!-- CONTENT -->
            <div class="techwave_fn_content">

                <!-- PAGE (all pages go inside this div) -->
                <div class="techwave_fn_page">
                    @yield('content')
                </div>
                <!-- !PAGE (all pages go inside this div) -->

                <!-- FOOTER (inside the content) -->
                <footer class="techwave_fn_footer">
                    <div class="techwave_fn_footer_content">
                        <div class="copyright">
                            <p>2023© Frenify Team</p>
                        </div>
                        <div class="menu_items">
                            <ul>
                                <li><a href="terms.html">Terms of Service</a></li>
                                <li><a href="privacy.html">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </footer>
                <!-- !FOOTER (inside the content) -->

            </div>
            <!-- !CONTENT -->


        </div>
    </div>
    <!-- !MAIN WRAPPER -->

    <!-- Scripts -->
    @include('frontend.partials.script')

</body>

</html>
