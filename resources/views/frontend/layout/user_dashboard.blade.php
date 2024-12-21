@extends('frontend.app')
<!-- Title -->
@section('title', 'User Dashboard')
@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <style>
        .icon img {
            height: 124px;
            object-fit: cover;
            padding: 14px;
            border-radius: 50%;
        }

        .section_home .section_right {
            padding: 93px 40px 80px;
        }

        .courses__item {
            overflow: visible;
        }

        .owl-stage {
            padding: 24px 0px;
        }

        .courses__item {
            background-color: var(--techwave-site-bg-color);
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            -o-border-radius: 10px;
            -ms-border-radius: 10px;
            border-radius: 5px;
            padding: 24px;
            border: 1px solid var(--techwave-border-color);
            transition: all 0.2s ease-out 0s;

        }

        .courses__item:hover {
            filter: drop-shadow(10px 10px 0px var(--techwave-some-a-bg-color));
        }


        .courses__item-thumb {
            width: 100%;
        }

        .courses__item-thumb img {
            width: 100%;
            height: 196px;
            object-fit: cover;
            border-radius: 10px;
        }

        .courses__item-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px 20px;
            margin: 0 0 15px;
            flex-wrap: wrap;
        }

        .courses__item-meta li {
            list-style: none;
        }

        .courses__item-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .courses__item-bottom .price {
            color: var(--techwave-main-color);
            font-weight: 600;
            margin-bottom: 0;
        }

        .courses {
            -ms-overflow-style: none;
            /* for Internet Explorer, Edge */
            scrollbar-width: none;
            /* for Firefox */
            overflow-y: scroll;
        }

        .courses::-webkit-scrollbar {
            display: none;
        }

        /*Book Card*/
        .book-card {
            width: 280px;
            padding: 16px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        }

        .book-card .book-card__cover {
            position: relative;
            width: 200px;
            height: 300px;
            margin: 0 auto 8px auto;
            perspective: 1000px;
        }

        .book-card .book-card__book {
            height: 100%;
            transform-style: preserve-3d;
            transition: all 250ms ease;
        }

        .book-card .book-card__book-front {
            position: absolute;
            height: 100%;
        }

        .book-card .book-card__book-back {
            position: absolute;
            top: 0;
            height: 100%;
            width: 100%;
            transform: translateZ(-40px);
        }

        .book-card .book-card__book-side {
            position: absolute;
            top: 5px;
            bottom: 2px;
            right: -29px;
            width: 40px;
            background-size: 5px;
            background-color: #e1e1e1;
            background-image: linear-gradient(to right, #ccc 35%, #e1e1e1 35%);
            opacity: 0;
            transform: rotate3d(0, 1, 0, 90deg);
        }

        .book-card .book-card__img {
            width: 100%;
            height: 100%;
            background-color: #e1e1e1;
        }

        .book-card .book-card__title {
            font-size: 16px;
            margin-bottom: 8px;
            margin-top: 22px;
        }

        .book-card .book-card__author {
            color: #757575;
            font-size: 1em;
        }

        .book-card:hover .book-card__book {
            transform: rotate3d(0, -1, 0, 30deg) translate(-15px, -30px);
        }

        .book-card:hover .book-card__book-back {
            box-shadow: 5px 10px 15px rgba(0, 0, 0, 0.35);
        }

        .book-card:hover .book-card__book-side {
            opacity: 1;
        }

        .techwave_fn_interactive_list .item {
            border: 1px solid var(--techwave-border-color);
        }

        /*Course Card*/
        .cards-box {
            position: relative;
            transform: translateX(-15px);
            margin-top: 64px;
        }

        .cards-box .card {
            width: calc(18rem + 19vh);
            max-width: 80vw;
            background: #f7fffd;
            border-radius: 14px;
            cursor: pointer;
        }

        .cards-box .card.hide {
            visibility: hidden;
        }

        .cards-box .card:not(.hide) {
            position: absolute;
            top: 0;
            left: 0;
            transition: all 0.8s cubic-bezier(0.18, 0.98, 0.45, 1);
            box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.07);
        }

        .cards-box .card:not(.hide)[data-slide='0'] {
            transform: translate(0px, 0px) scale(1);
            z-index: 6;
            opacity: 1;
        }

        .cards-box .card:not(.hide)[data-slide='1'] {
            transform: translate(15px, 15px) scale(0.975);
            z-index: 5;
            opacity: 0.9;
        }

        .cards-box .card:not(.hide)[data-slide='2'] {
            transform: translate(30px, 30px) scale(0.95);
            z-index: 4;
            opacity: 0.8;
        }

        .cards-box .card:not(.hide)[data-slide='3'] {
            transform: translate(45px, 45px) scale(0.925);
            z-index: 3;
            opacity: 0.7;
        }

        .cards-box .card:not(.hide)[data-slide='4'] {
            transform: translate(60px, 60px) scale(0.9);
            z-index: 2;
            opacity: 0.6;
        }

        .cards-box .card:not(.hide)[data-slide='5'] {
            transform: translate(75px, 75px) scale(0.875);
            z-index: 1;
            opacity: 0.5;
        }

        .cards-box .card:not(.hide)[data-slide='0'] {
            transition: all 0.32s cubic-bezier(0.18, 0.98, 0.45, 1);
        }

        .techwave_fn_title_holder {
            text-align: start;
        }
    </style>
@endpush

{{-- Main Content --}}
@section('content')
    <div class="techwave_fn_home">
        <div class="section_home">
            <div class="section_left">

                <!-- Title Shortcode -->
                <div class="techwave_fn_title_holder">
                    <h1 class="title">Fresh Arrivals in Our Library</h1>
                    <p class="fn__animated_text desc">An Introduction to Our Latest Literary Gems</p>
                </div>
                <!-- !Title Shortcode -->

                <!-- Interactive List Shortcode -->
                <div class="techwave_fn_interactive_list">

                    <!-- Set up your HTML -->
                    <div class="owl-carousel">
                        @foreach ($books as $book)
                            <div class="item book-card">
                                <div class="book-card__cover">
                                    <div class="book-card__book">
                                        <div class="book-card__book-front">
                                            <img class="book-card__img" src="{{ asset($book->feature_image) }}"
                                                alt="{{ $book->book_name }}" />
                                        </div>
                                        <div class="book-card__book-back"></div>
                                        <div class="book-card__book-side"></div>
                                    </div>
                                </div>
                                <div>
                                    <h2 class="book-card__title title">
                                        {{ Str::limit($book->book_name, 25, '...') }}
                                    </h2>

                                    @if ($book->book_author)
                                        <div class="book-card__author">
                                            {{ $book->book_author }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
                <!-- !Interactive List Shortcode -->

            </div>
            <div class="section_right">
                <!-- Title Shortcode -->
                <div class="techwave_fn_title_holder">
                    <h1 class="title fn__animated_text">Academic Odyssey</h1>
                    <p class="desc">A Journey Through Evolving Learning Landscapes</p>
                </div>
                <!-- !Title Shortcode -->

                <div class="cards-box">
                    @forelse ($courses as $course)
                        <div class="card">
                            <div class="courses__item shine__animate-item">
                                <div class="courses__item-thumb">
                                    <a href="#" class="shine__animate-link" title="Click to swap item">
                                        <img src="{{ asset($course['course_feature_image']) }}"
                                            alt="{{ $course['course_title'] }}">
                                    </a>
                                </div>
                                <div class="courses__item-content">
                                    <ul class="courses__item-meta">
                                        <li style="display: flex;align-items:center;gap:5px;margin-top:8px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16"
                                                x="0" y="0" viewBox="0 0 682.667 682.667"
                                                style="enable-background:new 0 0 512 512" xml:space="preserve"
                                                class="">
                                                <g>
                                                    <defs>
                                                        <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                                            <path d="M0 512h512V0H0Z" fill="var(--techwave-body-color)"
                                                                opacity="1" data-original="var(--techwave-body-color)">
                                                            </path>
                                                        </clipPath>
                                                    </defs>
                                                    <g clip-path="url(#a)"
                                                        transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                                        <path
                                                            d="M0 0c40.404-43.855 65.081-102.422 65.081-166.753 0-135.955-110.214-246.168-246.168-246.168-135.955 0-246.169 110.213-246.169 246.168S-317.042 79.415-181.087 79.415a248.69 248.69 0 0 0 30.018-1.812"
                                                            style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            transform="translate(437.087 422.753)" fill="none"
                                                            stroke="var(--techwave-body-color)" stroke-width="20"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                            data-original="var(--techwave-body-color)" class="">
                                                        </path>
                                                        <path
                                                            d="M0 0c69.932 44.079 163.466 35.661 224.382-25.256 70.685-70.685 70.685-185.287 0-255.972-70.684-70.685-185.287-70.685-255.972 0-61.007 61.006-69.36 154.727-25.06 224.692"
                                                            style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            transform="translate(159.604 409.242)" fill="none"
                                                            stroke="var(--techwave-body-color)" stroke-width="20"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                            data-original="var(--techwave-body-color)" class="">
                                                        </path>
                                                        <path d="M0 0v38h38"
                                                            style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            transform="translate(435.333 386.167)" fill="none"
                                                            stroke="var(--techwave-body-color)" stroke-width="20"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                            data-original="var(--techwave-body-color)" class="">
                                                        </path>
                                                        <path
                                                            d="M0 0c0-13.503 10.947-24.45 24.45-24.45S48.9-13.503 48.9 0 37.953 24.45 24.45 24.45 0 13.503 0 0Z"
                                                            style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            transform="translate(231.55 256)" fill="none"
                                                            stroke="var(--techwave-body-color)" stroke-width="20"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-miterlimit="10" stroke-dasharray="none"
                                                            stroke-opacity="" data-original="var(--techwave-body-color)"
                                                            class=""></path>
                                                        <path d="M0 0h-12.333"
                                                            style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            transform="translate(398.333 255.837)" fill="none"
                                                            stroke="var(--techwave-body-color)" stroke-width="20"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-miterlimit="10" stroke-dasharray="none"
                                                            stroke-opacity="" data-original="var(--techwave-body-color)"
                                                            class=""></path>
                                                        <path d="M0 0h12.333"
                                                            style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            transform="translate(113.667 256.163)" fill="none"
                                                            stroke="var(--techwave-body-color)" stroke-width="20"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-miterlimit="10" stroke-dasharray="none"
                                                            stroke-opacity="" data-original="var(--techwave-body-color)"
                                                            class=""></path>
                                                        <path d="M0 0v-12.333"
                                                            style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            transform="translate(256.163 398.333)" fill="none"
                                                            stroke="var(--techwave-body-color)" stroke-width="20"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-miterlimit="10" stroke-dasharray="none"
                                                            stroke-opacity="" data-original="var(--techwave-body-color)"
                                                            class=""></path>
                                                        <path d="M0 0v12.333"
                                                            style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            transform="translate(255.837 113.667)" fill="none"
                                                            stroke="var(--techwave-body-color)" stroke-width="20"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-miterlimit="10" stroke-dasharray="none"
                                                            stroke-opacity="" data-original="var(--techwave-body-color)"
                                                            class=""></path>
                                                        <path d="m0 0-39.907 39.907"
                                                            style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            transform="translate(238.711 273.289)" fill="none"
                                                            stroke="var(--techwave-body-color)" stroke-width="20"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-miterlimit="10" stroke-dasharray="none"
                                                            stroke-opacity="" data-original="var(--techwave-body-color)"
                                                            class=""></path>
                                                        <path d="m0 0 74.398 74.398"
                                                            style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            transform="translate(273.289 273.289)" fill="none"
                                                            stroke="var(--techwave-body-color)" stroke-width="20"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-miterlimit="10" stroke-dasharray="none"
                                                            stroke-opacity="" data-original="var(--techwave-body-color)"
                                                            class=""></path>
                                                        <path d="M0 0v0"
                                                            style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            transform="translate(128.014 383.986)" fill="none"
                                                            stroke="var(--techwave-body-color)" stroke-width="20"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-miterlimit="10" stroke-dasharray="none"
                                                            stroke-opacity="" data-original="var(--techwave-body-color)"
                                                            class=""></path>
                                                        <path d="M0 0v0"
                                                            style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                            transform="translate(325.275 492.286)" fill="none"
                                                            stroke="var(--techwave-body-color)" stroke-width="20"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-miterlimit="10" stroke-dasharray="none"
                                                            stroke-opacity="" data-original="var(--techwave-body-color)"
                                                            class=""></path>
                                                    </g>
                                                </g>
                                            </svg> {{ $course['duration'] }}
                                        </li>
                                    </ul>
                                    <h5 class="title"><a
                                            href="{{ route('course.enrollment', $course['id']) }}">{{ Str::limit($course['course_title'], 40, '...') }}</a>
                                    </h5>
                                    <div class="courses__item-bottom">
                                        @if (in_array($course['id'], $enrollment))
                                            <div class="button">
                                                <a href="{{ route('course.enrollment', $course['id']) }}"
                                                    class="btn-gradient-fill">Learning</a>
                                            </div>
                                        @else
                                            @if ($course['course_price'] == null || $course['course_price'] == 0)
                                                <div class="button">
                                                    <a href="{{ route('course.enrollment', $course['id']) }}"
                                                        class="btn-gradient-fill">Free Enroll</a>
                                                </div>
                                            @else
                                                <div class="button">
                                                    <a href="{{ route('course.enrollment', $course['id']) }}"
                                                        class="btn-gradient-fill">Enroll</a>
                                                </div>
                                                <h5 class="price">${{ $course['course_price'] }}</h5>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 20,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            })
        });

        window.onload = () => {
            let sliderImagesBox = document.querySelectorAll(".cards-box");
            sliderImagesBox.forEach((el) => {
                let imageNodes = el.querySelectorAll(".card:not(.hide)");
                let arrIndexes = []; // Index array
                (() => {
                    // The loop that added values to the arrIndexes array for the first time
                    let start = 0;
                    while (imageNodes.length > start) {
                        arrIndexes.push(start++);
                    }
                })();

                let setIndex = (arr) => {
                    for (let i = 0; i < imageNodes.length; i++) {
                        imageNodes[i].dataset.slide = arr[i]; // Set indexes
                    }
                };
                el.addEventListener("click", () => {
                    arrIndexes.unshift(arrIndexes.pop());
                    setIndex(arrIndexes);
                });
                setIndex(arrIndexes); // The first indexes addition
            });
        };
    </script>
@endpush
