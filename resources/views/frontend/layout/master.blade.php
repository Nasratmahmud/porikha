<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $setting = \App\Models\Setting::first();
    @endphp
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
    <title>@yield('title', $setting->title ?? 'Home')</title>
    <!-- Theme Core -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('fontend/vendor/normalize-css/normalize.css') }}">
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/vendor/bootstrap-5.3.0/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/vendor/bootstrap-icons-1.10.3/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}">
    <!-- Google Font : poppins, Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Roboto&display=swap"
        rel="stylesheet">
    @stack('style')
</head>

<body>

    <!-- Header :: Start -->
    <header id="primary-header" class="primary-header">
        <div class="header-container">
            <div class="header-row">
                <div class="header-col">
                    <div class="header-logo">
                        <a href="{{ route('root.page') }}"><img
                                src="{{ !empty($setting->logo) ? asset($setting->logo) : asset('frontend/images/logo/logo.png') }}"
                                alt="{{ $setting->title ?? null }}"></a>
                    </div>
                </div>
                <div class="header-col col-button">
                    <div class="header-nav">
                        <a href="{{ route('login') }}" class="header-btn">Sign in</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header :: End -->

    @yield('content')

    <footer id="footer" class="primary-footer">
        <div class="footer-container">
            <div class="footer-row">
                <!-- Footer - Social Media -->
                <div class="footer-col">
                    <div class="footer-link-item footer-social">
                        <ul class="m-0 p-0">
                            @php
                                $social_media = App\Models\SocialMedia::where('status', 1)->get();
                            @endphp
                            @foreach ($social_media as $item)
                                <li><a href="{{ $item['url'] }}" class="bg-transparent"><i
                                            class="bi bi-{{ strtolower($item['title']) }}"></i></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- Footer - Useful Link -->
                <div class="footer-col">
                    <div class="footer-link-item footer-link">
                        <ul class="m-0 p-0 text-end">
                            @php
                                $dynamicPages = App\Models\DynamicPage::where('status', 1)
                                    ->orderBy('page_title')
                                    ->get();
                            @endphp

                            @foreach ($dynamicPages as $dynamicPage)
                                <li><a class="p-2 bg-transparent"
                                        href="{{ route('custom.page', $dynamicPage['page_slug']) }}">{{ $dynamicPage['page_title'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- back to top -->
    <a class="btn btn-md btn-primary rounded-circle position-fixed bottom-0 end-0 translate-middle d-none"
        onclick="scrollToTop()" id="back-to-up" role="button">
        <i class="bi bi-arrow-up"></i>
    </a>


    <!-- JS -->
    <script src="{{ asset('frontend/vendor/bootstrap-5.3.0/js/bootstrap.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/plugins/jQuery/jquery-3.6.3.slim.js') }}"></script>
    <script src="{{ asset('frontend/plugins/venobox/venobox.js') }}"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="{{ asset('frontend') }}"></script>
    <script>
        let navbar = document.getElementById("primary-header");
        let navOffset = navbar.offsetTop;
        window.addEventListener("scroll", () => {
            (window.scrollY >= navOffset) ? navbar.classList.add("sticky_nav"): navbar.classList.remove(
                "sticky_nav")
        });
    </script>

    @stack('script')



</body>

</html>
