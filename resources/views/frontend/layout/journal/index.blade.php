@extends('frontend.app')

<!-- Start:Title -->
@section('title', 'Journals')

<!-- End:Title -->
@push('style')
    <style>
        .card {
            position: relative;
            width: 300px;
            height: 390px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            font-weight: bold;
            border-radius: 15px;
            cursor: pointer;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Heebo", sans-serif;
            text-decoration: none;
        }

        .card::before,
        .card::after {
            position: absolute;
            content: "";
            width: 20%;
            height: 20%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            background-color: #4242428f;
            transition: all 0.5s;
            color: white;
            opacity: 0.7;
        }

        .card::before {
            top: 0;
            right: 0;
            border-radius: 0 15px 0 100%;
        }

        .card::after {
            bottom: 0;
            left: 0;
            border-radius: 0 100% 0 15px;
            text-align: center;
        }

        .card:hover::before,
        .card:hover:after {
            width: 100%;
            height: 100%;
            border-radius: 15px;
            transition: all 0.5s;
        }

        .techwave_fn_changelog {
            display: flex;
            gap: 30px;
            flex-flow: wrap;
        }


        .techwave_fn_pagetitle {
            border-bottom: 0px;
        }

        .card h6 {
            text-align: center;
            font-size: 15px;
        }

        .add-card:hover:after {
            content: 'ADD NEW 👍';
        }

        .techwave_fn_models {
            padding: 36px 0 40px;
        }

        .techwave_fn_models .fn__title_holder {
            margin-bottom: 28px;
        }

        /*journal List*/
        .fn__gallery_items {
            height: auto !important;
        }

        .fn__gallery_items .item {
            height: 400px !important;
        }

        .fn__gallery_items .item .img {
            height: 100% !important;
            border-radius: 4px;
        }

        .fn__gallery_items .item .img img {
            height: 100% !important;
            object-fit: cover !important;
        }

        .fn__gallery_item {
            position: unset !important;
        }

        .madFlows_btn {
            position: relative;
            overflow: hidden;
            height: 3rem;
            padding: 0 2rem;
            border-radius: 1.5rem;
            background: #3d3a4e;
            background-size: 400%;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .madFlows_btn:hover::before {
            transform: scaleX(1);
        }

        .madFlows_btn {
            position: relative;
            z-index: 1;
        }

        .madFlows_btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            transform: scaleX(0);
            transform-origin: 0 50%;
            width: 100%;
            height: inherit;
            border-radius: inherit;
            background: linear-gradient(82.3deg,
                    rgba(150, 93, 233, 1) 10.8%,
                    rgba(99, 88, 238, 1) 94.3%);
            transition: all 0.475s;
        }

        .madFlows_btn span {
            z-index: 1;
        }

        a.fn__like.no_border {
            height: auto;
        }

        .fn__gallery_items .info__header {
            margin-bottom: 0px;
        }

        .fn__gallery_items .item__info .desc {
            margin-bottom: 9px;
        }

        .fn__gallery_item {
            width: 23%;
        }

        .tab__item.active {
            display: block;
            width: 100%;
        }
        .add-card:hover:after {
            content: 'Add New 👉' !important;
        }
    </style>
@endpush


<!-- Start:Content -->
@section('content')

    <!-- Dashboard :: -> Start -->
    <div class="techwave_fn_changelog_page">
        <div class="techwave_fn_models">
            <div class="fn__title_holder">
                <div class="container">
                    <h1 class="title fn__animated_text">List of Journals</h1>
                </div>
            </div>
            <div class="fn__tabs">
                <div class="container">
                    <div class="tab_in">
                        <a class="active" href="#all">All</a>
                        <a href="#own">My Own</a>
                    </div>
                </div>
            </div>

            <div class="container">
                <!-- models content -->
                <div class="models__content" style="margin-bottom: 50px;">
                    <div class="models__results">
                        <div class="fn__preloader">
                            <div class="icon"></div>
                            <div class="text">Loading</div>
                        </div>
                        <div class="fn__gallery_items fn__gallery_item_cols">
                            <div id="all" class="tab__item active">
                                <div class="techwave_fn_changelog">
                                    <!-- Journal item -->
                                    @forelse ($journals as $journal)
                                        @if ($journal->journal_type == '1')
                                            <div class="fn__gallery_item" id="fn__gallery_item_{{ $journal->id }}">
                                                <div class="item" data-id="">
                                                    <div class="img">
                                                        <img src="{{ $journal->journal_featured_image }}"
                                                            alt="{{ $journal->journal_title }}">
                                                    </div>
                                                    <div class="fn__selectable_item">
                                                        <span class="icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                                id="Layer_1" x="0px" y="0px" viewBox="0 0 408.8 294.1"
                                                                style="enable-background:new 0 0 408.8 294.1;"
                                                                xml:space="preserve" class="fn__svg replaced-svg">
                                                                <g>
                                                                    <path
                                                                        d="M408.8,36.8c-2,10.1-8.3,17.4-15.4,24.5C319.6,135,245.8,208.8,172.1,282.6c-10,10-21.5,14.3-35.1,9.5   c-5-1.7-9.9-4.9-13.6-8.6C85.6,246.1,48.1,208.6,10.6,171c-15.1-15.2-13.9-37,2.6-49.9c12.8-10,30.9-8.2,43.7,4.6   c28.9,28.9,57.8,57.8,86.6,86.7c1.1,1.1,1.8,2.6,3.4,4.9c1.7-2.3,2.4-3.6,3.4-4.6c67.1-67.1,134.2-134.2,201.2-201.3   c9.7-9.7,21-13.8,34.5-9.6c11.8,3.7,18.8,12,21.9,23.8c0.2,0.9,0.5,1.7,0.8,2.6C408.8,31,408.8,33.9,408.8,36.8z">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="item__info">
                                                        <div class="info__header">
                                                            <div class="user__info">
                                                                <h3 class="author_name">
                                                                    {{ $journal->journal_title }}
                                                                </h3>
                                                            </div>
                                                            <a href="#" class="no_border " data-id="">
                                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    width="28" height="28" x="0" y="0"
                                                                    viewBox="0 0 512 512"
                                                                    style="enable-background:new 0 0 512 512"
                                                                    xml:space="preserve" class="">
                                                                    <g>
                                                                        <path
                                                                            d="M256 396.333c-96.715 0-185.475-52.858-231.64-137.948L23.067 256l1.293-2.385C70.526 168.525 159.285 115.667 256 115.667s185.474 52.858 231.639 137.948l1.294 2.385-1.294 2.385C441.474 343.475 352.715 396.333 256 396.333zM34.461 256C79.231 336.462 163.865 386.333 256 386.333S432.77 336.462 477.539 256C432.77 175.538 348.136 125.667 256 125.667S79.231 175.538 34.461 256z"
                                                                            fill="#bd9458" opacity="1"
                                                                            data-original="#000000" class=""></path>
                                                                        <path
                                                                            d="M256 351c-52.383 0-95-42.617-95-95s42.617-95 95-95 95 42.617 95 95-42.617 95-95 95zm0-180c-46.869 0-85 38.131-85 85s38.131 85 85 85 85-38.131 85-85-38.131-85-85-85z"
                                                                            fill="#bd9458" opacity="1"
                                                                            data-original="#000000" class=""></path>
                                                                        <path
                                                                            d="M256 311c-30.327 0-55-24.673-55-55s24.673-55 55-55v10c-24.813 0-45 20.187-45 45s20.187 45 45 45 45-20.187 45-45h10c0 30.327-24.673 55-55 55z"
                                                                            fill="#bd9458" opacity="1"
                                                                            data-original="#000000" class=""></path>
                                                                        <path
                                                                            d="M256 311c-13.785 0-25-11.215-25-25s11.215-25 25-25 25 11.215 25 25-11.215 25-25 25zm0-40c-8.271 0-15 6.729-15 15s6.729 15 15 15 15-6.729 15-15-6.729-15-15-15z"
                                                                            fill="#bd9458" opacity="1"
                                                                            data-original="#000000" class=""></path>
                                                                    </g>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <p class="desc">{{ $journal->user->name }}</p>
                                                        <a href="{{ route('single.journal', ['slug' => $journal->journal_slug]) }}"
                                                            class="filter__trending enabled btn-gradient-fill has__icon small__border">
                                                            <span>See More</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($journal->journal_type == '2' && $journal->user_id == auth()->user()->id)
                                            <div class="fn__gallery_item" id="fn__gallery_item_{{ $journal->id }}">
                                                <div class="item" data-id="">
                                                    <div class="img">
                                                        <img src="{{ $journal->journal_featured_image }}"
                                                            alt="{{ $journal->journal_title }}">
                                                    </div>
                                                    <div class="fn__selectable_item">
                                                        <span class="icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                                id="Layer_1" x="0px" y="0px" viewBox="0 0 408.8 294.1"
                                                                style="enable-background:new 0 0 408.8 294.1;"
                                                                xml:space="preserve" class="fn__svg replaced-svg">
                                                                <g>
                                                                    <path
                                                                        d="M408.8,36.8c-2,10.1-8.3,17.4-15.4,24.5C319.6,135,245.8,208.8,172.1,282.6c-10,10-21.5,14.3-35.1,9.5   c-5-1.7-9.9-4.9-13.6-8.6C85.6,246.1,48.1,208.6,10.6,171c-15.1-15.2-13.9-37,2.6-49.9c12.8-10,30.9-8.2,43.7,4.6   c28.9,28.9,57.8,57.8,86.6,86.7c1.1,1.1,1.8,2.6,3.4,4.9c1.7-2.3,2.4-3.6,3.4-4.6c67.1-67.1,134.2-134.2,201.2-201.3   c9.7-9.7,21-13.8,34.5-9.6c11.8,3.7,18.8,12,21.9,23.8c0.2,0.9,0.5,1.7,0.8,2.6C408.8,31,408.8,33.9,408.8,36.8z">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="item__info">
                                                        <div class="info__header">
                                                            <div class="user__info">
                                                                <h3 class="author_name">
                                                                    {{ $journal->journal_title }}
                                                                </h3>
                                                            </div>
                                                            <a href="#" class="no_border" data-id="">
                                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    width="28" height="28" x="0" y="0"
                                                                    viewBox="0 0 24 24"
                                                                    style="enable-background:new 0 0 512 512"
                                                                    xml:space="preserve" class="">
                                                                    <g>
                                                                        <g stroke-linecap="round" stroke-linejoin="round">
                                                                            <path
                                                                                d="M11.205 3.138 4.273 5.612C3.511 5.884 3 6.612 3 7.421v3.056c0 .625.115 1.497.313 2.112.96 2.995 2.146 4.854 3.521 6.072 1.375 1.219 2.91 1.772 4.48 2.24.442.132.93.132 1.372 0 1.57-.468 3.105-1.021 4.48-2.24 1.375-1.218 2.56-3.077 3.521-6.072.198-.615.313-1.487.313-2.112V7.421c0-.81-.511-1.537-1.273-1.809l-6.932-2.474a2.364 2.364 0 0 0-1.59 0zm.336.943c.297-.106.621-.106.918 0l6.932 2.475c.367.13.609.475.609.865v3.056c0 .48-.124 1.368-.264 1.805-.924 2.883-2.02 4.555-3.232 5.63-1.212 1.073-2.57 1.575-4.104 2.032-.157.047-.644.047-.8 0-1.535-.457-2.892-.957-4.104-2.031-1.212-1.074-2.308-2.748-3.232-5.63-.14-.438-.264-1.325-.264-1.806V7.421c0-.39.242-.734.61-.865z"
                                                                                fill="#bd9458" opacity="1"
                                                                                data-original="#000000" class="">
                                                                            </path>
                                                                            <path
                                                                                d="M16.146 8.146 10.5 13.793l-2.646-2.647a.5.5 0 0 0-.708 0 .5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708 0l6-6a.5.5 0 0 0 0-.708.5.5 0 0 0-.708 0z"
                                                                                fill="#bd9458" opacity="1"
                                                                                data-original="#000000" class="">
                                                                            </path>
                                                                        </g>
                                                                    </g>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <p class="desc">{{ $journal->user->name }}</p>
                                                        <a href="{{ route('single.journal', ['slug' => $journal->journal_slug]) }}"
                                                            class="filter__trending enabled btn-gradient-fill has__icon small__border">
                                                            <span>See More</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    @empty
                                        <h1 class="">No Journal Found</h1>
                                    @endforelse
                                </div>

                                @if ($journals->nextPageUrl() || $journals->previousPageUrl())
                                    <nav>
                                        <ul class="pagination">
                                            <!-- Previous Page Link -->
                                            @if ($journals->onFirstPage())
                                                <li class="page-item disabled" aria-disabled="true"
                                                    aria-label="@lang('pagination.previous')">
                                                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $journals->previousPageUrl() }}"
                                                        rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                                </li>
                                            @endif

                                            <!-- Pagination Elements -->
                                            @foreach ($journals->getUrlRange(1, $journals->lastPage()) as $page => $url)
                                                @if ($page == $journals->currentPage())
                                                    <li class="page-item active" aria-current="page"><span
                                                            class="page-link">{{ $page }}</span></li>
                                                @else
                                                    <li class="page-item"><a class="page-link"
                                                            href="{{ $url }}">{{ $page }}</a></li>
                                                @endif
                                            @endforeach
                                            <!-- Next Page Link -->

                                            @if ($journals->hasMorePages())
                                                <li class="page-item">

                                                    <a class="page-link" href="{{ $journals->nextPageUrl() }}"
                                                        rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>

                                                </li>
                                            @else
                                                <li class="page-item disabled" aria-disabled="true"
                                                    aria-label="@lang('pagination.next')">

                                                    <span class="page-link" aria-hidden="true">&rsaquo;</span>

                                                </li>
                                            @endif

                                        </ul>

                                    </nav>
                                @endif
                            </div>
                            <div id="own" class="tab__item">
                                <div class="techwave_fn_changelog">
                                    <a href="{{ route('journal.create') }}" style="text-decoration: none;">
                                        <div class="card add-card add-card" style="background-color: #2b2b2b">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="180"
                                                    height="180" x="0" y="0" viewBox="0 0 496 496"
                                                    style="enable-background:new 0 0 180 180" xml:space="preserve"
                                                    class="">
                                                    <g
                                                        transform="matrix(0.5199999999999998,1.9104490066698702e-16,1.9104490066698702e-16,-0.5199999999999998,119.0400000000007,376.96000000000083)">
                                                        <path
                                                            d="M488 240H256V8a8 8 0 0 0-16 0v232H8a8 8 0 0 0 0 16h232v232a8 8 0 0 0 16 0V256h232a8 8 0 0 0 0-16z"
                                                            fill="#ffffff" opacity="1" data-original="#000000"
                                                            class="">
                                                        </path>
                                                    </g>
                                                </svg>
                                                <h6>ADD NEW</h6>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- Journal item -->
                                    @forelse ($myJournal as $journal)
                                        @if ($journal->journal_type == '1')
                                            <a href="{{ route('single.journal', ['slug' => $journal->journal_slug]) }}">
                                                <div class="card"
                                                    style="background-image: url('{{ asset($journal->journal_featured_image) }}');">
                                                    <style>
                                                        .card:hover:after {
                                                            content: 'Read More 👉';
                                                        }
                                                    </style>
                                                </div>
                                            </a>
                                        @elseif($journal->journal_type == '2' && $journal->user_id == auth()->user()->id)
                                            <a href="{{ route('single.journal', ['slug' => $journal->journal_slug]) }}">
                                                <div class="card"
                                                    style="background-image: url('{{ asset($journal->journal_featured_image) }}');">
                                                    <style>
                                                        .card:hover:after {
                                                            content: 'Read More 👉';
                                                        }
                                                    </style>
                                                </div>
                                            </a>
                                        @endif

                                    @empty
                                        <h1 class="" style="margin: 50px 0">No Journal Found</h1>
                                    @endforelse


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- !models content -->
            </div>




        </div>

    </div>
    <!-- Dashboard :: -> End -->

@endsection

<!-- Start:Script -->

@push('script')
    <script></script>
@endpush

<!-- End:Script -->
