@extends('frontend.app')
<!-- Title -->
@section('title', 'Courses')
@push('style')
    <style>
        .fn__generation_item {
            border-bottom: none;
            margin-top: 80px;
        }

        .courses__item {
            background-color: var(--techwave-site-bg-color);
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            -o-border-radius: 10px;
            -ms-border-radius: 10px;
            border-radius: 10px;
            padding: 24px;
            border: 1px solid #B5B5C3;
            transition: all 0.2s ease-out 0s;
            margin-bottom: 34px;
        }

        .courses__item:hover {
            filter: drop-shadow(10px 10px 0px var(--techwave-some-a-bg-color));
        }


        .courses__item-thumb {
            width: 370px;
        }

        .courses__item-thumb img {
            width: 100%;
            height: 190px;
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

        .techwave_fn_changelog {
            display: flex;
            flex-flow: wrap;
            justify-content: space-between;
        }
    </style>
@endpush

{{-- Main Content --}}
@section('content')

    <div class="app-content-area">
        <div class="techwave_fn_models_page">
            <div class="fn__title_holder">
                <div class="container">
                    <h1 class="title fn__animated_text">List of course</h1>
                </div>
            </div>
            <div class="techwave_fn_models">
                <div class="container">
                    <!-- models content -->
                    <div class="models__content">
                        <div class="models__results">
                            <div class="fn__tabs_content">
                                <div class="tab__item active">
                                    <div class="techwave_fn_changelog">
                                        @forelse ($courses as $course)
                                            <div class="courses__item shine__animate-item">
                                                <div class="courses__item-thumb">
                                                    <a href="{{ route('course.enrollment', $course['id']) }}" class="shine__animate-link">
                                                        <img src="{{ asset($course['course_feature_image']) }}" alt="{{ $course['course_title'] }}">
                                                    </a>
                                                </div>
                                                <div class="courses__item-content">
                                                    <ul class="courses__item-meta">
                                                        <li style="display: flex;align-items:center;gap:5px;margin-top:8px;"><svg
                                                                xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" x="0" y="0"
                                                                viewBox="0 0 682.667 682.667" style="enable-background:new 0 0 512 512"
                                                                xml:space="preserve" class="">
                                        <g>
                                            <defs>
                                                <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                                    <path d="M0 512h512V0H0Z" fill="var(--techwave-body-color)"
                                                          opacity="1" data-original="var(--techwave-body-color)">
                                                    </path>
                                                </clipPath>
                                            </defs>
                                            <g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                                <path
                                                    d="M0 0c40.404-43.855 65.081-102.422 65.081-166.753 0-135.955-110.214-246.168-246.168-246.168-135.955 0-246.169 110.213-246.169 246.168S-317.042 79.415-181.087 79.415a248.69 248.69 0 0 0 30.018-1.812"
                                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    transform="translate(437.087 422.753)" fill="none"
                                                    stroke="var(--techwave-body-color)" stroke-width="20"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                    stroke-dasharray="none" stroke-opacity=""
                                                    data-original="var(--techwave-body-color)" class=""></path>
                                                <path
                                                    d="M0 0c69.932 44.079 163.466 35.661 224.382-25.256 70.685-70.685 70.685-185.287 0-255.972-70.684-70.685-185.287-70.685-255.972 0-61.007 61.006-69.36 154.727-25.06 224.692"
                                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    transform="translate(159.604 409.242)" fill="none"
                                                    stroke="var(--techwave-body-color)" stroke-width="20"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                    stroke-dasharray="none" stroke-opacity=""
                                                    data-original="var(--techwave-body-color)" class=""></path>
                                                <path d="M0 0v38h38"
                                                      style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                      transform="translate(435.333 386.167)" fill="none"
                                                      stroke="var(--techwave-body-color)" stroke-width="20"
                                                      stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                      stroke-dasharray="none" stroke-opacity=""
                                                      data-original="var(--techwave-body-color)" class=""></path>
                                                <path
                                                    d="M0 0c0-13.503 10.947-24.45 24.45-24.45S48.9-13.503 48.9 0 37.953 24.45 24.45 24.45 0 13.503 0 0Z"
                                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    transform="translate(231.55 256)" fill="none"
                                                    stroke="var(--techwave-body-color)" stroke-width="20"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                    stroke-dasharray="none" stroke-opacity=""
                                                    data-original="var(--techwave-body-color)" class=""></path>
                                                <path d="M0 0h-12.333"
                                                      style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                      transform="translate(398.333 255.837)" fill="none"
                                                      stroke="var(--techwave-body-color)" stroke-width="20"
                                                      stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                      stroke-dasharray="none" stroke-opacity=""
                                                      data-original="var(--techwave-body-color)" class=""></path>
                                                <path d="M0 0h12.333"
                                                      style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                      transform="translate(113.667 256.163)" fill="none"
                                                      stroke="var(--techwave-body-color)" stroke-width="20"
                                                      stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                      stroke-dasharray="none" stroke-opacity=""
                                                      data-original="var(--techwave-body-color)" class=""></path>
                                                <path d="M0 0v-12.333"
                                                      style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                      transform="translate(256.163 398.333)" fill="none"
                                                      stroke="var(--techwave-body-color)" stroke-width="20"
                                                      stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                      stroke-dasharray="none" stroke-opacity=""
                                                      data-original="var(--techwave-body-color)" class=""></path>
                                                <path d="M0 0v12.333"
                                                      style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                      transform="translate(255.837 113.667)" fill="none"
                                                      stroke="var(--techwave-body-color)" stroke-width="20"
                                                      stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                      stroke-dasharray="none" stroke-opacity=""
                                                      data-original="var(--techwave-body-color)" class=""></path>
                                                <path d="m0 0-39.907 39.907"
                                                      style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                      transform="translate(238.711 273.289)" fill="none"
                                                      stroke="var(--techwave-body-color)" stroke-width="20"
                                                      stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                      stroke-dasharray="none" stroke-opacity=""
                                                      data-original="var(--techwave-body-color)" class=""></path>
                                                <path d="m0 0 74.398 74.398"
                                                      style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                      transform="translate(273.289 273.289)" fill="none"
                                                      stroke="var(--techwave-body-color)" stroke-width="20"
                                                      stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                      stroke-dasharray="none" stroke-opacity=""
                                                      data-original="var(--techwave-body-color)" class=""></path>
                                                <path d="M0 0v0"
                                                      style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                      transform="translate(128.014 383.986)" fill="none"
                                                      stroke="var(--techwave-body-color)" stroke-width="20"
                                                      stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                      stroke-dasharray="none" stroke-opacity=""
                                                      data-original="var(--techwave-body-color)" class=""></path>
                                                <path d="M0 0v0"
                                                      style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                      transform="translate(325.275 492.286)" fill="none"
                                                      stroke="var(--techwave-body-color)" stroke-width="20"
                                                      stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                                      stroke-dasharray="none" stroke-opacity=""
                                                      data-original="var(--techwave-body-color)" class=""></path>
                                            </g>
                                        </g>
                                    </svg> {{ $course['duration'] }}</li>
                                                    </ul>
                                                    <h5 class="title"><a
                                                            href="{{ route('course.enrollment', $course['id']) }}">{{ Str::limit($course['course_title'], 20, '...') }}</a>
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
                                        @empty
                                            <h1>No Course Found</h1>
                                        @endforelse
                                    </div>
                                    <!-- Pagination Elements -->
                                    @if ($courses->nextPageUrl() || $courses->previousPageUrl())
                                        <nav>
                                            <ul class="pagination">
                                                <!-- Previous Page Link -->
                                                @if ($courses->onFirstPage())
                                                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                                        <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $courses->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                                    </li>
                                                @endif

                                            <!-- Pagination Elements -->
                                                @foreach ($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                                                    @if ($page == $courses->currentPage())
                                                        <li class="page-item active" aria-current="page">
                                                            <span class="page-link">{{ $page }}</span>
                                                        </li>
                                                    @else
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            <!-- Next Page Link -->

                                                @if ($courses->hasMorePages())
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $courses->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                                                    </li>
                                                @else
                                                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                                        <span class="page-link" aria-hidden="true">&rsaquo;</span>
                                                    </li>
                                                @endif
                                            </ul>
                                        </nav>
                                    @endif
                                    <!-- Next Page Link -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






@endsection
