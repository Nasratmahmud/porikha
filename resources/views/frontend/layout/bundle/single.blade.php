@extends('frontend.app')
<!-- Start:Title -->
@section('title', "$bundle->title")
<!-- End:Title -->
@push('style')
    <style>
        .image-wrapper {
            text-align: center;
        }

        .guide-details img {
            width: 600px;
            border-radius: 5px;
        }

        .category-wrapper {
            margin-top: 23px
        }

        .category-wrapper span {
            background-color: #7c5fe3;
            display: inline-block;
            margin-right: 5px;
            color: white;
            padding: 3px 26px;
            border-radius: 20px;
            font-size: 15px;
            text-transform: capitalize;
        }

        .section_right h4 {
            color: #7c5fe3;
            font-weight: 600;
        }

        .icon img {
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }

        .techwave_fn_interactive_list.modern a {
            padding: 10px 28px;
        }

        .techwave_fn_interactive_list.modern .title {
            font-size: 16px;
        }

        .guide-create {
            text-align: start;
            font-size: 12px;
        }

        .techwave_fn_interactive_list.modern .icon {
            min-width: 50px;
            width: 50px;
            height: 50px;
        }

        .recent-guide {
            margin-bottom: 40px;
        }

        .section_home .section_left {
            padding: 93px 40px 80px;
            border-right: 1px solid var(--techwave-border-color);
            width: 100%;
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
        }

        .courses__item:hover {
            filter: drop-shadow(10px 10px 0px var(--techwave-some-a-bg-color));
        }


        .courses__item-thumb {
            width: 300px;
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

        .section_home .section_left {
            padding: 50px 40px 80px;
        }

        .techwave_fn_title_holder {
            text-align: start !important;
        }

        .techwave_fn_title_holder .title {
            font-weight: 600;
        }

        .row {
            display: flex;
            align-items: center;
        }

        .col-md-6 {
            width: 50%;
            float: left;
        }

        .col-md-6 {
            width: 50%;
            float: left;
        }

        img.img-fluid {
            width: 100%;
        }

        .image-wrapper {
            text-align: start;
            padding-right: 80px;
        }

        .image-wrapper img {
            border-radius: 16px;
            height: 350px;
        }

        .description-wrapper h2 {
            font-weight: 600;
        }

        .description-wrapper span {
            font-weight: 600;
            color: var(--techwave-heading-color);
            font-size: 18px;
        }

        .description-wrapper {
            padding-right: 172px
        }

        .bundel-title-wrapper {
            margin-bottom: 5rem;
        }

        .mt-5 {
            margin-top: 10px;
        }

        .tab-container {
            display: flex;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: .5px;
            text-transform: uppercase;
            color: var(--techwave-heading-color);
            font-family: var(--techwave-heading-font-family);
        }

        .tab-content {
            display: none;
            padding: 20px;
        }

        .active-tab {
            border-bottom: 2px solid var(--techwave-main-color);
            font-weight: 600;
        }

        .active-content {
            display: block;
        }

        .fn__tabs {
            margin-bottom: 0px;
        }

        .tab-content h2 {
            font-weight: 600;
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
            font-weight: 600;
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

        .fn__gallery_items .item {
            background-color: var(--techwave-some-r-bg-color);
            border: 1px solid transparent;
        }
        .fn__gallery_items .item:hover{
            border: 1px solid var(--techwave-main-color);
        }
    </style>
@endpush



<!-- Start:Content -->

@section('content')

    <!-- Dashboard :: Left -> Start -->
    <div class="techwave_fn_home">
        <div class="section_home">
            <div class="section_left">

                <!-- Guide Details -->
                <div class="row bundel-title-wrapper">
                    <div class="col-md-6">
                        <div class="image-wrapper">
                            <img src="{{ asset($bundle->feature_image) }}" class="img-fluid" alt="{{ $bundle->title }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="description-wrapper">
                            <h2>
                                {{ $bundle->title }}
                            </h2>
                            <span>Published At: {{ $bundle->created_at->format('F j, Y \a\t g:i A') }}</span>
                            <p class="mt-5">
                                @if ($bundle->sub_title != null)
                                    {{ $bundle->sub_title }}
                                @else
                                    Unlock extraordinary value with our exclusive bundles, carefully curated to enhance your
                                    lifestyle.
                                    Enjoy seamless combinations of premium products and services, all in one irresistible
                                    package.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="fn__tabs">
                    <div class="tab_in">
                        <div class="tab-container">
                            <div class="tab active-tab" onclick="openTab('tab1')">Courses</div>
                            <div class="tab" onclick="openTab('tab2')">Books</div>
                            <div class="tab" onclick="openTab('tab3')">Journals</div>
                            <div class="tab" onclick="openTab('tab4')">Contents</div>
                        </div>
                    </div>
                </div>

                <div id="tab1" class="tab-content active-content">
                    <h2>Courses</h2>
                    {{-- Course List  --}}
                    @if (in_array(2, $types))
                        <div style="display:flex;gap:24px;align-items:center;">
                            @foreach ($bundle->bundle_items as $item)
                                @if ($item->type == 2)
                                    <div class="courses__item shine__animate-item">
                                        <div class="courses__item-thumb">
                                            <a href="{{ route('course.enrollment', $item->course->id) }}"
                                                class="shine__animate-link">
                                                <img src="{{ asset($item->course->course_feature_image) }}"
                                                    alt="{{ $item->course->course_title }}">
                                            </a>
                                        </div>
                                        <div class="courses__item-content">
                                            <ul class="courses__item-meta">
                                                <li style="display: flex;align-items:center;gap:5px;margin-top:8px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="16"
                                                        height="16" x="0" y="0" viewBox="0 0 682.667 682.667"
                                                        style="enable-background:new 0 0 512 512" xml:space="preserve"
                                                        class="">
                                                        <g>
                                                            <defs>
                                                                <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                                                    <path d="M0 512h512V0H0Z"
                                                                        fill="var(--techwave-body-color)" opacity="1"
                                                                        data-original="var(--techwave-body-color)">
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
                                                                    stroke-miterlimit="10" stroke-dasharray="none"
                                                                    stroke-opacity=""
                                                                    data-original="var(--techwave-body-color)"
                                                                    class=""></path>
                                                                <path
                                                                    d="M0 0c69.932 44.079 163.466 35.661 224.382-25.256 70.685-70.685 70.685-185.287 0-255.972-70.684-70.685-185.287-70.685-255.972 0-61.007 61.006-69.36 154.727-25.06 224.692"
                                                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                    transform="translate(159.604 409.242)" fill="none"
                                                                    stroke="var(--techwave-body-color)" stroke-width="20"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-miterlimit="10" stroke-dasharray="none"
                                                                    stroke-opacity=""
                                                                    data-original="var(--techwave-body-color)"
                                                                    class="">
                                                                </path>
                                                                <path d="M0 0v38h38"
                                                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                    transform="translate(435.333 386.167)" fill="none"
                                                                    stroke="var(--techwave-body-color)" stroke-width="20"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-miterlimit="10" stroke-dasharray="none"
                                                                    stroke-opacity=""
                                                                    data-original="var(--techwave-body-color)"
                                                                    class="">
                                                                </path>
                                                                <path
                                                                    d="M0 0c0-13.503 10.947-24.45 24.45-24.45S48.9-13.503 48.9 0 37.953 24.45 24.45 24.45 0 13.503 0 0Z"
                                                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                    transform="translate(231.55 256)" fill="none"
                                                                    stroke="var(--techwave-body-color)" stroke-width="20"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-miterlimit="10" stroke-dasharray="none"
                                                                    stroke-opacity=""
                                                                    data-original="var(--techwave-body-color)"
                                                                    class="">
                                                                </path>
                                                                <path d="M0 0h-12.333"
                                                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                    transform="translate(398.333 255.837)" fill="none"
                                                                    stroke="var(--techwave-body-color)" stroke-width="20"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-miterlimit="10" stroke-dasharray="none"
                                                                    stroke-opacity=""
                                                                    data-original="var(--techwave-body-color)"
                                                                    class="">
                                                                </path>
                                                                <path d="M0 0h12.333"
                                                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                    transform="translate(113.667 256.163)" fill="none"
                                                                    stroke="var(--techwave-body-color)" stroke-width="20"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-miterlimit="10" stroke-dasharray="none"
                                                                    stroke-opacity=""
                                                                    data-original="var(--techwave-body-color)"
                                                                    class="">
                                                                </path>
                                                                <path d="M0 0v-12.333"
                                                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                    transform="translate(256.163 398.333)" fill="none"
                                                                    stroke="var(--techwave-body-color)" stroke-width="20"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-miterlimit="10" stroke-dasharray="none"
                                                                    stroke-opacity=""
                                                                    data-original="var(--techwave-body-color)"
                                                                    class="">
                                                                </path>
                                                                <path d="M0 0v12.333"
                                                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                    transform="translate(255.837 113.667)" fill="none"
                                                                    stroke="var(--techwave-body-color)" stroke-width="20"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-miterlimit="10" stroke-dasharray="none"
                                                                    stroke-opacity=""
                                                                    data-original="var(--techwave-body-color)"
                                                                    class="">
                                                                </path>
                                                                <path d="m0 0-39.907 39.907"
                                                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                    transform="translate(238.711 273.289)" fill="none"
                                                                    stroke="var(--techwave-body-color)" stroke-width="20"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-miterlimit="10" stroke-dasharray="none"
                                                                    stroke-opacity=""
                                                                    data-original="var(--techwave-body-color)"
                                                                    class="">
                                                                </path>
                                                                <path d="m0 0 74.398 74.398"
                                                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                    transform="translate(273.289 273.289)" fill="none"
                                                                    stroke="var(--techwave-body-color)" stroke-width="20"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-miterlimit="10" stroke-dasharray="none"
                                                                    stroke-opacity=""
                                                                    data-original="var(--techwave-body-color)"
                                                                    class="">
                                                                </path>
                                                                <path d="M0 0v0"
                                                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                    transform="translate(128.014 383.986)" fill="none"
                                                                    stroke="var(--techwave-body-color)" stroke-width="20"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-miterlimit="10" stroke-dasharray="none"
                                                                    stroke-opacity=""
                                                                    data-original="var(--techwave-body-color)"
                                                                    class="">
                                                                </path>
                                                                <path d="M0 0v0"
                                                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                    transform="translate(325.275 492.286)" fill="none"
                                                                    stroke="var(--techwave-body-color)" stroke-width="20"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-miterlimit="10" stroke-dasharray="none"
                                                                    stroke-opacity=""
                                                                    data-original="var(--techwave-body-color)"
                                                                    class="">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    {{ $item->course->duration }}
                                                </li>
                                            </ul>
                                            <h5 class="title"><a
                                                    href="{{ route('course.enrollment', $item->course->id) }}">{{ Str::limit($item->course->course_title, 20, '...') }}</a>
                                            </h5>
                                            <div class="courses__item-bottom">
                                                <div class="button">
                                                    <a href="{{ route('course.enrollment', $item->course->id) }}"
                                                        class="btn-gradient-fill">See</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p>No Course found</p>
                    @endif
                </div>

                <div id="tab2" class="tab-content">
                    <h2>Books</h2>
                    {{-- book List  --}}
                    @if (in_array(3, $types))
                        <div>
                            <ul class="fn__gallery_items fn__gallery_item_cols" id="fn__gallery_items">
                                @foreach ($bundle->bundle_items as $item)
                                    @if ($item->type == 3)
                                        <li class="fn__gallery_item" id="fn__gallery_item_{{ $item['book']['id'] }}">
                                            <div class="item book-card">
                                                <div class="book-card__cover">
                                                    <div class="book-card__book">
                                                        <div class="book-card__book-front">
                                                            <img class="book-card__img"
                                                                src="{{ asset($item->book->feature_image) }}"
                                                                alt="{{ $item->book->book_name }}" />
                                                        </div>
                                                        <div class="book-card__book-back"></div>
                                                        <div class="book-card__book-side"></div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h2 class="book-card__title title">
                                                        {{ Str::limit($item->book->book_name, 25, '...') }}
                                                    </h2>

                                                    @if ($item->book->book_author)
                                                        <div class="book-card__author">
                                                            {{ $item->book->book_author }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="item__info">
                                                    <div class="info__header">
                                                        <div class="user__info">
                                                            <h3 class="author_name">
                                                                {{ Str::limit($item['book']['book_name'], 30, '...') }}
                                                            </h3>
                                                        </div>
                                                    </div>
                                                    <p class="desc">{!! Str::limit($item['book']['book_summary'], 40, '...') !!}</p>
                                                    <a href="{{ route('book.singlePage', $item->book->id) }}"
                                                        class="filter__trending enabled btn-gradient-fill has__icon small__border">
                                                        <span>Read</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        {{-- <div class="courses__item shine__animate-item">
                                        <div class="courses__item-thumb">
                                            <a href="{{ route('book.singlePage', $item->book->id) }}"
                                                class="shine__animate-link">
                                                <img src="{{ asset($item->book->feature_image) }}"
                                                    alt="{{ $item->book->book_name }}">
                                            </a>
                                        </div>
                                        <div class="courses__item-content" style="margin-top: 16px;">
                                            <h5 class="title"><a
                                                    href="{{ route('book.singlePage', $item->book->id) }}">{{ Str::limit($item->book->book_name, 20, '...') }}</a>
                                            </h5>
                                            <div class="courses__item-bottom">
                                                <div class="button">
                                                    <a href="{{ route('book.singlePage', $item->book->id) }}"
                                                        class="btn-gradient-fill">See</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <p>No Books found</p>
                    @endif
                </div>

                <div id="tab3" class="tab-content">
                    <h2>Journals</h2>
                    {{-- Journal List --}}
                    @if (in_array(1, $types))
                        <div style="display:flex;gap:24px;align-items:center; justify-content: flex-start">
                            @foreach ($bundle->bundle_items as $item)
                                @if ($item->type == 1)
                                    <div class="courses__item shine__animate-item">
                                        <div class="courses__item-thumb">
                                            <a href="{{ route('single.journal', $item->journal->journal_slug) }}"
                                                class="shine__animate-link">
                                                <img src="{{ asset($item->journal->journal_featured_image) }}"
                                                    alt="{{ $item->journal->journal_title }}">
                                            </a>
                                        </div>
                                        <div class="courses__item-content" style="margin-top: 16px;">
                                            <h5 class="title"><a
                                                    href="{{ route('single.journal', $item->journal->journal_slug) }}">{{ Str::limit($item->journal->journal_title, 20, '...') }}</a>
                                            </h5>
                                            <div class="courses__item-bottom">
                                                <div class="button">
                                                    <a href="{{ route('single.journal', $item->journal->journal_slug) }}"
                                                        class="btn-gradient-fill">See</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p>No Journals found</p>
                    @endif
                </div>
                <div id="tab4" class="tab-content">
                    <h2>Contents</h2>

                    {{-- Content List  --}}
                    @if (in_array(4, $types))
                        <div style="display:flex;gap:24px;align-items:center;">
                            @foreach ($bundle->bundle_items as $item)
                                @if ($item->type == 4)
                                    <div class="courses__item shine__animate-item">
                                        <div class="courses__item-content" style="margin-top: 16px;">
                                            <h5 class="title"><a
                                                    href="{{ route('single.bundle.content', $item->id) }}">{{ Str::limit($item->title, 20, '...') }}</a>
                                            </h5>
                                            <p>{!! Str::limit($item->sub_description, 20, '...') !!}</p>
                                            <div class="courses__item-bottom">
                                                <div class="button">
                                                    <a href="{{ route('single.bundle.content', $item->id) }}"
                                                        class="btn-gradient-fill">See</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p>No Content found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection

<!-- Start:Script -->

@push('script')
    <script>
        function openTab(tabId) {
            // Hide all tabs and reset their styles
            document.querySelectorAll('.tab-content').forEach(function(tabContent) {
                tabContent.style.display = 'none';
            });

            document.querySelectorAll('.tab').forEach(function(tab) {
                tab.classList.remove('active-tab');
            });

            // Show the selected tab and set its style
            document.getElementById(tabId).style.display = 'block';
            document.querySelector(`[onclick="openTab('${tabId}')"]`).classList.add('active-tab');
        }
    </script>
@endpush

<!-- End:Script -->
