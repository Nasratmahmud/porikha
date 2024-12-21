<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        Pricing || iManifest System || Escape depression, unlock new knowledge.
    </title>
    <!-- Theme Core -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/vendor/normalize-css/normalize.css') }}">
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/vendor/bootstrap-5.3.0/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/vendor/bootstrap-icons-1.10.3/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}">
    <!-- Google Font : poppins, Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Roboto&display=swap" rel="stylesheet">
</head>
<body>

    <!-- Header :: Start -->
    <header id="primary-header" class="primary-header">
        <div class="header-container">
            <div class="header-row">
                <div class="header-col">
                    <div class="header-logo">
                        <a href="{{ route('root.page') }}"><img src="{{ asset('frontend/images/logo/logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="header-col col-button">
                    <div class="mode--toggler">
                        <input type="checkbox" class="checkbox" id="checkbox">
                        <label for="checkbox" class="checkbox-label">
                            <i class="bi bi-brightness-high"></i>
                            <i class="bi bi-moon"></i>
                            <span class="ball"></span>
                        </label>
                    </div>
                    <div class="header-nav">
                        <a href="{{ route('login') }}" class="header-btn">Sign in</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header :: End -->

    <!-- Pricing :: Start -->
    <section id="pricing" class="section-wrapper">
        <div class="section-slide">
            <div class="section-title">
                <h1>Our Pricing</h1>
            </div>
            <div class="pricing-row">
                <!-- Card : Start -->
                <div class="pricing-col">
                    <div class="pricing-card">
                        <span class="offer-tag">10% Off - for Today</span>
                        <div class="pricing-card-header">
                            <!-- <span class="popular-tag">Most Popular</span> -->
                            <span class="package-type silver-package">Silver</span>
                            <p><i class="bi bi-currency-dollar"></i>88.88</p>
                            <span>Per Person, Per Month</span>
                        </div>
                        <div class="pricing-card-services">
                            <ul class="m-0 p-0">
                                <li>
                                    <p class="m-0 p-0"><i class="bi bi-check-circle-fill"></i> All Exclusive Premium Courses</p>
                                </li>
                                <li>
                                    <p class="m-0 p-0"><i class="bi bi-check-circle-fill"></i> All Exclusive Video</p>
                                </li>
                                <li>
                                    <p class="m-0 p-0"><i class="bi bi-check-circle-fill"></i> All Exclusive Premium Videos</p>
                                </li>
                                <li>
                                    <p class="m-0 p-0"><i class="bi bi-check-circle-fill"></i> All Exclusive Premium PDF Books</p>
                                </li>
                                <li>
                                    <p class="m-0 p-0"><i class="bi bi-check-circle-fill"></i> Global Community</p>
                                </li>
                                <li>
                                    <p class="m-0 p-0"><i class="bi bi-check-circle-fill"></i> Exclusive Journal Portal</p>
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('register') }}" class="buy-btn">Buy Now</a>
                    </div>
                </div>
                <!-- Card : End -->
                <!-- Card : Start -->
                <div class="pricing-col ">
                    <div class="pricing-card">
                        <span class="offer-tag">10% Off - for Today</span>
                        <div class="pricing-card-header">
                            <!-- <span class="popular-tag">Exclusive</span> -->
                            <span class="package-type gold-package">Gold</span>
                            <p><i class="bi bi-currency-dollar"></i>88.88</p>
                            <span>Per Person, Per Month</span>
                        </div>
                        <div class="pricing-card-services">
                            <ul class="m-0 p-0">
                                <li>
                                    <p class="m-0 p-0"><i class="bi bi-check-circle-fill"></i> All Exclusive Premium Courses</p>
                                </li>
                                <li>
                                    <p class="m-0 p-0"><i class="bi bi-check-circle-fill"></i> All Exclusive Video</p>
                                </li>
                                <li>
                                    <p class="m-0 p-0"><i class="bi bi-check-circle-fill"></i> All Exclusive Premium Videos</p>
                                </li>
                                <li>
                                    <p class="m-0 p-0"><i class="bi bi-check-circle-fill"></i> All Exclusive Premium PDF Books</p>
                                </li>
                                <li>
                                    <p class="m-0 p-0"><i class="bi bi-check-circle-fill"></i> Global Community</p>
                                </li>
                                <li>
                                    <p class="m-0 p-0"><i class="bi bi-check-circle-fill"></i> Exclusive Journal Portal</p>
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('register') }}" class="buy-btn">Buy Now</a>
                    </div>
                </div>
                <!-- Card : End -->
            </div>
        </div>
    </section>
    <!-- Pricing :: End -->

    <!-- Footer :: Start -->
    <footer id="footer" class="primary-footer">
        <div class="footer-container">
            <div class="footer-row">
                <!-- Footer - Social Media -->
                <div class="footer-col">
                    <div class="footer-link-item footer-social">
                        <ul class="m-0 p-0">
                            <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                            <li><a href="#"><i class="bi bi-linkedin"></i></a></li>
                            <li><a href="#"><i class="bi bi-youtube"></i></a></li>
                            <li><a href="#"><i class="bi bi-instagram"></i></a></li>
                            <li><a href="#"><i class="bi bi-pinterest"></i></a></li>
                            <li><a href="#"><i class="bi bi-twitter"></i></a></li>
                            <li><a href="#"><i class="bi bi-twitch"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- Footer - Useful Link -->
                <div class="footer-col">
                    <div class="footer-link-item footer-link">
                        <ul class="m-0 p-0">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="about.html">About</a></li>
                            <li><a href="pricing.html">Pricing</a></li>
                            <li><a href="privacy-policy.html">Privacy Policy</a></li>
                            <li><a href="cookies-policy.html">Cookies Policy</a></li>
                            <li><a href="terms-conditions.html">Terms and Conditions</a></li>
                            <li><a href="refund-policy.html">Refund Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer :: End -->

    <!-- back to top -->
    <a class="btn btn-md btn-primary rounded-circle position-fixed bottom-0 end-0 translate-middle d-none"
       onclick="scrollToTop()" id="back-to-up" role="button"><i class="bi bi-arrow-up"></i>
    </a>


    <!-- JS -->
    <script src="{{ asset('frontend/vendor/bootstrap-5.3.0/js/bootstrap.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/plugins/jQuery/jquery-3.6.3.slim.js') }}"></script>
    <script src="{{ asset('frontend/plugins/venobox/venobox.js') }}"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="{{ asset('frontend/plugins/controller/yt-controller/yt.controller.js') }}"></script>
    <script>
        let navbar = document.getElementById("primary-header");
        let navOffset = navbar.offsetTop;
        window.addEventListener("scroll", () => {
            (window.scrollY >= navOffset) ? navbar.classList.add("sticky_nav") : navbar.classList.remove("sticky_nav")
        });
    </script>

@stack('script')



</body>

</html>

