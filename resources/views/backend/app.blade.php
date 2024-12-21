<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Codescandy">
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

    {{-- <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon/favicon.ico"> --}}



    <title> @yield('title')</title>
    <!-- Libs CSS -->

    @include('backend.partials.style')
   

</head>

<body>

    <main id="main-wrapper" class="main-wrapper">
        <!-- Start:Header -->
        @include('backend.partials.header')

        <!-- Start:Sidebar -->
        @include('backend.partials.sidebar')


        <!-- Page content -->
        <div id="app-content">
            @if(session('success'))
            <script>
                toastr.success("{{ session('success') }}");
            </script>
            @endif
        
            @if(session('error'))
                <script>
                    toastr.error("{{ session('error') }}");
                </script>
            @endif
            <!-- Container fluid -->
            @yield('content')
        </div>
    </main>

  
    @include('backend.partials.script')



</body>



</html>
