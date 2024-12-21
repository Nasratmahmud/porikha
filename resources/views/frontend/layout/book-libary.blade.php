@extends('frontend.app')
<!-- Title -->
@section('title', 'Books Libary')
@push('style')
    <style>
        .fn__gallery_items {
            height: auto !important;
            margin-top: 55px !important
        }

        .fn__gallery_items .item {
            height: 400px !important;
            background-color: var(--techwave-some-r-bg-color);
            overflow: visible !important;
            border: 1px solid transparent;
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

        .fn__gallery_items .author_name {
            font-size: 16px;
            font-weight: 600;
        }

        .fn__gallery_items .info__header p {
            font-size: 16px;
            font-weight: 500;
        }

        .fn__gallery_items .item:hover {
            border-color: var(--techwave-main-color);
        }
    </style>
@endpush

{{-- Main Content --}}
@section('content')
    <div class="techwave_fn_page">

        <!-- Community Feed Page -->
        <div class="techwave_fn_community_page">

            <div class="fn__title_holder">
                <div class="container">
                    <h1 class="title fn__animated_text ">Books Libary</h1>
                </div>
            </div>

            <!-- Feed -->
            <div class="techwave_fn_feed">
                <div class="fn__tabs">
                    <div class="container">
                        <div class="tab_in">
                            <a class="active" onclick="bookFilterByCategory('all', 'fn__gallery_items')"
                                href="#">All</a>
                            @foreach ($categories as $category)
                                <a onclick="bookFilterByCategory('{{ $category['category_name'] }}', 'fn__gallery_items')"
                                    href="#" class="">{{ $category['category_name'] }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="container">
                    <!-- feed content -->
                    <div class="feed__content">
                        <div class="feed__results">
                            <div class="fn__preloader">
                                <div class="icon"></div>
                                <div class="text">Loading</div>
                            </div>
                            <ul class="fn__gallery_items fn__gallery_item_cols" id="fn__gallery_items"
                                style="position: relative; height: 989.188px;">
                                @forelse ($books as $book)
                                    <li class="fn__gallery_item" id="fn__gallery_item_{{ $book['id'] }}">
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
                                            <div class="item__info">
                                                <div class="info__header">
                                                    <div class="user__info">
                                                        <h3 class="author_name">
                                                            {{ Str::limit($book['book_name'], 30, '...') }}
                                                        </h3>
                                                    </div>
                                                    @php
                                                        $has_like = '';
                                                        foreach ($book['book_favourites'] as $fav) {
                                                            if ($fav['book_id'] == $book['id'] && $fav['user_id'] == auth()->user()->id) {
                                                                $has_like = 'has__like';
                                                            }
                                                        }
                                                    @endphp
                                                    <a href="#" class="fn__like no_border {{ $has_like }}"
                                                        data-id="{{ $book['id'] }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                            id="Layer_1" x="0px" y="0px" viewBox="0 0 409 346.2"
                                                            style="enable-background:new 0 0 409 346.2;"
                                                            xml:space="preserve" class="fn__svg empty__like replaced-svg">
                                                            <g>
                                                                <path
                                                                    d="M409,126.1c-1.6,8.9-2.7,17.8-4.8,26.6c-4.3,18.3-12.8,34.9-23.3,50.4c-20.3,30.1-46.6,54.5-74.7,77   c-29.3,23.4-60.5,43.8-92.4,63.3c-6.1,3.7-12.3,3.8-18.4,0c-42.2-25.7-83.2-53.2-119.7-86.6C54,237,34.3,215.4,19.9,189.5   C-0.6,152.7-6.6,114.1,8.1,74C21.8,36.8,47.6,11.6,86.8,2.9c35.3-7.9,67.4,0.3,94.4,24.9c8.7,7.9,15.9,17.4,24,26.4   c1.6-2.2,3.6-5,5.7-7.8c9.5-12.7,20.7-23.5,34.4-31.6c18.6-11,38.7-15.6,60.3-14.3c23,1.4,43.5,9.3,61.2,24.1   c20.6,17.2,33.1,39.2,38.9,65.2c1.4,6.4,2.2,13,3.3,19.6C409,114.9,409,120.5,409,126.1z M376.8,123.9c1-28.3-8.5-53-25.6-70.5   c-24.9-25.3-67.6-28.4-95.8-7.1c-16.9,12.8-27.8,29.8-35.4,49.2c-3,7.6-8.8,12.1-15.7,12c-6.9-0.1-12.4-4.5-15.3-12   c-5.5-14.3-13.2-27.2-23.5-38.6c-20.9-23.3-54.2-31.3-83.1-19.5C56.9,47.9,42.1,67.7,35.3,93.9c-7.7,29.8-0.9,57.4,14.4,83.3   c13.8,23.4,32.4,42.7,52.6,60.7c30.8,27.4,64.9,50.4,99.7,72.2c1.8,1.2,3.1,1.2,5,0c27.5-17.2,54.5-35.2,79.9-55.5   c24.2-19.4,46.9-40.2,64.9-65.6C366.3,168.4,376.3,146.1,376.8,123.9z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 -28 512.00002 512"
                                                            class="fn__svg full__like replaced-svg">
                                                            <path
                                                                d="m471.382812 44.578125c-26.503906-28.746094-62.871093-44.578125-102.410156-44.578125-29.554687 0-56.621094 9.34375-80.449218 27.769531-12.023438 9.300781-22.917969 20.679688-32.523438 33.960938-9.601562-13.277344-20.5-24.660157-32.527344-33.960938-23.824218-18.425781-50.890625-27.769531-80.445312-27.769531-39.539063 0-75.910156 15.832031-102.414063 44.578125-26.1875 28.410156-40.613281 67.222656-40.613281 109.292969 0 43.300781 16.136719 82.9375 50.78125 124.742187 30.992188 37.394531 75.535156 75.355469 127.117188 119.3125 17.613281 15.011719 37.578124 32.027344 58.308593 50.152344 5.476563 4.796875 12.503907 7.4375 19.792969 7.4375 7.285156 0 14.316406-2.640625 19.785156-7.429687 20.730469-18.128907 40.707032-35.152344 58.328125-50.171876 51.574219-43.949218 96.117188-81.90625 127.109375-119.304687 34.644532-41.800781 50.777344-81.4375 50.777344-124.742187 0-42.066407-14.425781-80.878907-40.617188-109.289063zm0 0">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <p class="desc">{!! Str::limit(strip_tags($book['book_summary']), 40, '...') !!}
</p>
                                                <a href="{{ route('book.singlePage', $book->id) }}"
                                                    class="filter__trending enabled btn-gradient-fill has__icon small__border">
                                                    <span>Read</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <h1>No Book Found</h1>
                                @endforelse
                            </ul>
                        </div>
                        {{-- @if ($books->nextPageUrl())
                            <div id="loader_gif" style="text-align: center;display:none;">
                                <img src="{{ asset('frontend/img/loader.gif') }}" height="60" width="60">
                            </div>
                            <div class="feed__more" id="feed__more_area">
                                <a id="load_more_btn" data-current_page="{{ $books->currentPage() + 1 }}"
                                    data-current_path="{{ $books->path() }}"
                                    onclick="loadMoreBook(this,'fn__gallery_items','loader_gif')" href="javascript:void(0)"
                                    class="btn-gradient-fill madFlows_btn">
                                    <span>Load More</span>
                                </a>
                            </div>
                        @endif --}}
                    </div>
                    <!-- !feed content -->
                </div>

            </div>
            <!-- !Feed -->

        </div>
        <!-- !Community Feed Page -->

    </div>
@endsection

@push('script')
    <script>
        //book filter by category
        function bookFilterByCategory(category, list, ) {
            let user_id = "{{ auth()->user()->id }}";
            let bookList = document.getElementById(list);
            bookList.innerHTML = '';
            let button = document.getElementById('load_more_btn');

            // Building the URL with tag as a parameter and query string ?page=1 using template literal
            let url = `{{ route('book.filter', '') }}/${encodeURIComponent(category)}`;
            $.ajax({
                type: "GET",
                url: url,
                success: function(resp) {

                    button.setAttribute('data-current_page', resp.current_page + 1);
                    button.setAttribute('data-current_path', resp.path);
                    resp.data.forEach(item => {
                        let has_like = false;
                        if (item['book_favourites'].length > 0) {
                            item['book_favourites'].forEach(fav => {
                                if (fav['book_id'] == item['id'] && fav['user_id'] ==
                                    user_id) {
                                    has_like = true;
                                }
                            })
                        }

                        bookList.innerHTML +=
                            `<li class="fn__gallery_item" id="fn__gallery_item_${item['id']}">
                                        <div class="item book-card">
                                            <div class="book-card__cover">
                                                <div class="book-card__book">
                                                    <div class="book-card__book-front">
                                                        <img class="book-card__img" src="{{ url('/') }}/${item['feature_image']}"
                                                            alt="${item['book_name']}" />
                                                    </div>
                                                    <div class="book-card__book-back"></div>
                                                    <div class="book-card__book-side"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <h2 class="book-card__title title">
                                                    ${item['book_name'].length > 20 ? item['book_name'].substring(0, 20) + '...' : item['book_name']}
                                                </h2>

                                                @if ($book->book_author)
                                                    <div class="book-card__author">
                                                        ${item['book_author']}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="item__info">
                                                <div class="info__header">
                                                    <div class="user__info">
                                                        <h3 class="author_name">
                                                            ${item['book_name'].length > 30 ? item['book_name'].substring(0, 30) + '...' : item['book_name']}
                                                        </h3>
                                                    </div>
                                                    <a href="#" class="fn__like no_border ${ has_like ? 'has__like': ''}" data-id="${item['id']}">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                            id="Layer_1" x="0px" y="0px" viewBox="0 0 409 346.2"
                                                            style="enable-background:new 0 0 409 346.2;"
                                                            xml:space="preserve" class="fn__svg empty__like replaced-svg">
                                                            <g>
                                                                <path
                                                                    d="M409,126.1c-1.6,8.9-2.7,17.8-4.8,26.6c-4.3,18.3-12.8,34.9-23.3,50.4c-20.3,30.1-46.6,54.5-74.7,77   c-29.3,23.4-60.5,43.8-92.4,63.3c-6.1,3.7-12.3,3.8-18.4,0c-42.2-25.7-83.2-53.2-119.7-86.6C54,237,34.3,215.4,19.9,189.5   C-0.6,152.7-6.6,114.1,8.1,74C21.8,36.8,47.6,11.6,86.8,2.9c35.3-7.9,67.4,0.3,94.4,24.9c8.7,7.9,15.9,17.4,24,26.4   c1.6-2.2,3.6-5,5.7-7.8c9.5-12.7,20.7-23.5,34.4-31.6c18.6-11,38.7-15.6,60.3-14.3c23,1.4,43.5,9.3,61.2,24.1   c20.6,17.2,33.1,39.2,38.9,65.2c1.4,6.4,2.2,13,3.3,19.6C409,114.9,409,120.5,409,126.1z M376.8,123.9c1-28.3-8.5-53-25.6-70.5   c-24.9-25.3-67.6-28.4-95.8-7.1c-16.9,12.8-27.8,29.8-35.4,49.2c-3,7.6-8.8,12.1-15.7,12c-6.9-0.1-12.4-4.5-15.3-12   c-5.5-14.3-13.2-27.2-23.5-38.6c-20.9-23.3-54.2-31.3-83.1-19.5C56.9,47.9,42.1,67.7,35.3,93.9c-7.7,29.8-0.9,57.4,14.4,83.3   c13.8,23.4,32.4,42.7,52.6,60.7c30.8,27.4,64.9,50.4,99.7,72.2c1.8,1.2,3.1,1.2,5,0c27.5-17.2,54.5-35.2,79.9-55.5   c24.2-19.4,46.9-40.2,64.9-65.6C366.3,168.4,376.3,146.1,376.8,123.9z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 -28 512.00002 512"
                                                            class="fn__svg full__like replaced-svg">
                                                            <path
                                                                d="m471.382812 44.578125c-26.503906-28.746094-62.871093-44.578125-102.410156-44.578125-29.554687 0-56.621094 9.34375-80.449218 27.769531-12.023438 9.300781-22.917969 20.679688-32.523438 33.960938-9.601562-13.277344-20.5-24.660157-32.527344-33.960938-23.824218-18.425781-50.890625-27.769531-80.445312-27.769531-39.539063 0-75.910156 15.832031-102.414063 44.578125-26.1875 28.410156-40.613281 67.222656-40.613281 109.292969 0 43.300781 16.136719 82.9375 50.78125 124.742187 30.992188 37.394531 75.535156 75.355469 127.117188 119.3125 17.613281 15.011719 37.578124 32.027344 58.308593 50.152344 5.476563 4.796875 12.503907 7.4375 19.792969 7.4375 7.285156 0 14.316406-2.640625 19.785156-7.429687 20.730469-18.128907 40.707032-35.152344 58.328125-50.171876 51.574219-43.949218 96.117188-81.90625 127.109375-119.304687 34.644532-41.800781 50.777344-81.4375 50.777344-124.742187 0-42.066407-14.425781-80.878907-40.617188-109.289063zm0 0">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <p class="desc">${item['book_summary'].length > 40 ? item['book_summary'].substring(0, 40) + '...' : item['book_summary']}</p>
                                                <a href="{{ url('/') }}/books/${item['id']}"
                                                    class="filter__trending enabled btn-gradient-fill has__icon small__border">
                                                    <span>Read</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>`;
                    });
                    if (resp.next_page_url == null) {
                        document.getElementById('feed__more_area').style.display = 'none';
                    } else {
                        document.getElementById('feed__more_area').style.display = 'flex';
                    }
                },
                error: function(error) {
                    toastr.error('Something went wrong');
                } // Error
            })
        }



        //book like
        $(document).on("click", ".fn__like", function(event) {
            event.preventDefault();

            var button = $(this);
            var book_id = button.data("id");
            var countElement = button.find(".count");

            $.ajax({
                type: "POST",
                url: "/book/favorite",
                data: {
                    book_id: book_id,
                },
                success: function(resp) {
                    if (resp.success === true) {
                        if (resp.type === "add") {
                            button.addClass("has__like");
                            countElement.text(parseInt(countElement.text()) + 1);
                        } else if (resp.type === "remove") {
                            button.removeClass("has__like");
                            countElement.text(parseInt(countElement.text()) - 1);
                        }
                    } else if (resp.errors) {
                        toastr.error(resp.errors[0]);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function(error) {
                    toastr.error("Something went wrong");
                },
            });

            return false; // Prevent the default action of the click event
        });

        //book load more button
        function loadMoreBook(button, list, loader) {
            document.getElementById(loader).style.display = 'block';
            let user_id = "{{ auth()->user()->id }}";
            let bookList = $(`#${list}`);
            let page = parseInt(button.getAttribute('data-current_page'));
            let path = button.getAttribute('data-current_path');

            // Get the last item ID
            let lastItemId = $('.fn__gallery_items li:last').attr('data-id');

            // Building the URL with tag as a parameter and query string ?page=1 using template literal
            let url = `${path}?page=${page}`;
            $.ajax({
                type: "GET",
                url: url,
                success: function(resp) {
                    console.log(resp)
                    resp.data.forEach(item => {
                        let has_like = false;
                        if (item['book_favourites'].length > 0) {
                            item['book_favourites'].forEach(fav => {
                                if (fav['book_id'] == item['id'] && fav['user_id'] ==
                                    user_id) {
                                    has_like = true;
                                }
                            })
                        }

                        // Find the last item with the specified ID
                        let lastItem = $(`#${lastItemId}`);

                        // Insert the new item after the last item
                        lastItem.after(`<li class="fn__gallery_item" id="fn__gallery_item_${item['id']}">
                                        <div class="item book-card">
                                            <div class="book-card__cover">
                                                <div class="book-card__book">
                                                    <div class="book-card__book-front">
                                                        <img class="book-card__img" src="{{ url('/') }}/${item['feature_image']}"
                                                            alt="${item['book_name']}" />
                                                    </div>
                                                    <div class="book-card__book-back"></div>
                                                    <div class="book-card__book-side"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <h2 class="book-card__title title">
                                                    ${item['book_name'].length > 20 ? item['book_name'].substring(0, 20) + '...' : item['book_name']}
                                                </h2>

                                                @if ($book->book_author)
                                                    <div class="book-card__author">
                                                        ${item['book_author']}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="item__info">
                                                <div class="info__header">
                                                    <div class="user__info">
                                                        <h3 class="author_name">
                                                            ${item['book_name'].length > 30 ? item['book_name'].substring(0, 30) + '...' : item['book_name']}
                                                        </h3>
                                                    </div>
                                                    <a href="#" class="fn__like no_border ${ has_like ? 'has__like': ''}"
                                                        data-id="${item['id']}">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                            id="Layer_1" x="0px" y="0px" viewBox="0 0 409 346.2"
                                                            style="enable-background:new 0 0 409 346.2;"
                                                            xml:space="preserve" class="fn__svg empty__like replaced-svg">
                                                            <g>
                                                                <path
                                                                    d="M409,126.1c-1.6,8.9-2.7,17.8-4.8,26.6c-4.3,18.3-12.8,34.9-23.3,50.4c-20.3,30.1-46.6,54.5-74.7,77   c-29.3,23.4-60.5,43.8-92.4,63.3c-6.1,3.7-12.3,3.8-18.4,0c-42.2-25.7-83.2-53.2-119.7-86.6C54,237,34.3,215.4,19.9,189.5   C-0.6,152.7-6.6,114.1,8.1,74C21.8,36.8,47.6,11.6,86.8,2.9c35.3-7.9,67.4,0.3,94.4,24.9c8.7,7.9,15.9,17.4,24,26.4   c1.6-2.2,3.6-5,5.7-7.8c9.5-12.7,20.7-23.5,34.4-31.6c18.6-11,38.7-15.6,60.3-14.3c23,1.4,43.5,9.3,61.2,24.1   c20.6,17.2,33.1,39.2,38.9,65.2c1.4,6.4,2.2,13,3.3,19.6C409,114.9,409,120.5,409,126.1z M376.8,123.9c1-28.3-8.5-53-25.6-70.5   c-24.9-25.3-67.6-28.4-95.8-7.1c-16.9,12.8-27.8,29.8-35.4,49.2c-3,7.6-8.8,12.1-15.7,12c-6.9-0.1-12.4-4.5-15.3-12   c-5.5-14.3-13.2-27.2-23.5-38.6c-20.9-23.3-54.2-31.3-83.1-19.5C56.9,47.9,42.1,67.7,35.3,93.9c-7.7,29.8-0.9,57.4,14.4,83.3   c13.8,23.4,32.4,42.7,52.6,60.7c30.8,27.4,64.9,50.4,99.7,72.2c1.8,1.2,3.1,1.2,5,0c27.5-17.2,54.5-35.2,79.9-55.5   c24.2-19.4,46.9-40.2,64.9-65.6C366.3,168.4,376.3,146.1,376.8,123.9z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 -28 512.00002 512"
                                                            class="fn__svg full__like replaced-svg">
                                                            <path
                                                                d="m471.382812 44.578125c-26.503906-28.746094-62.871093-44.578125-102.410156-44.578125-29.554687 0-56.621094 9.34375-80.449218 27.769531-12.023438 9.300781-22.917969 20.679688-32.523438 33.960938-9.601562-13.277344-20.5-24.660157-32.527344-33.960938-23.824218-18.425781-50.890625-27.769531-80.445312-27.769531-39.539063 0-75.910156 15.832031-102.414063 44.578125-26.1875 28.410156-40.613281 67.222656-40.613281 109.292969 0 43.300781 16.136719 82.9375 50.78125 124.742187 30.992188 37.394531 75.535156 75.355469 127.117188 119.3125 17.613281 15.011719 37.578124 32.027344 58.308593 50.152344 5.476563 4.796875 12.503907 7.4375 19.792969 7.4375 7.285156 0 14.316406-2.640625 19.785156-7.429687 20.730469-18.128907 40.707032-35.152344 58.328125-50.171876 51.574219-43.949218 96.117188-81.90625 127.109375-119.304687 34.644532-41.800781 50.777344-81.4375 50.777344-124.742187 0-42.066407-14.425781-80.878907-40.617188-109.289063zm0 0">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <p class="desc">${item['book_summary'].length > 40 ? item['book_summary'].substring(0, 40) + '...' : item['book_summary']}</p>
                                                <a href="{{ url('/') }}/books/${item['id']}"
                                                    class="filter__trending enabled btn-gradient-fill has__icon small__border">
                                                    <span>Read</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>`);

                        lastItemId = item['id']; // Update lastItemId for the next iteration
                    });

                    page++;
                    button.setAttribute('data-current_page', page);
                    document.getElementById(loader).style.display = 'none';
                    if (resp.next_page_url == null) {
                        document.getElementById('feed__more_area').style.display = 'none';
                    } else {
                        document.getElementById('feed__more_area').style.display = 'flex';
                    }
                },
                error: function(error) {
                    toastr.error('Something went wrong');
                } // Error
            });
        }



        function loadMoreBook(button, list, loader) {
            document.getElementById(loader).style.display = 'block';
            let user_id = "{{ auth()->user()->id }}";
            let bookList = $(`#${list}`);
            let page = parseInt(button.getAttribute('data-current_page'));
            let path = button.getAttribute('data-current_path');

            // Building the URL with tag as a parameter and query string ?page=1 using template literal
            let url = `${path}?page=${page}`;
            $.ajax({
                type: "GET",
                url: url,
                success: function(resp) {
                    console.log(resp)
                    resp.data.forEach(item => {
                        let has_like = false;
                        if (item['book_favourites'].length > 0) {
                            item['book_favourites'].forEach(fav => {
                                if (fav['book_id'] == item['id'] && fav['user_id'] == user_id) {
                                    has_like = true;
                                }
                            })
                        }

                        // Find the last item using :last selector
                        let lastItem = bookList.find('.fn__gallery_item:last');

                        // Insert the new item after the last item
                        lastItem.after(`<li class="fn__gallery_item" id="fn__gallery_item_${item['id']}">
                                        <div class="item book-card">
                                            <div class="book-card__cover">
                                                <div class="book-card__book">
                                                    <div class="book-card__book-front">
                                                        <img class="book-card__img" src="{{ url('/') }}/${item['feature_image']}"
                                                            alt="${item['book_name']}" />
                                                    </div>
                                                    <div class="book-card__book-back"></div>
                                                    <div class="book-card__book-side"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <h2 class="book-card__title title">
                                                    ${item['book_name'].length > 20 ? item['book_name'].substring(0, 20) + '...' : item['book_name']}
                                                </h2>

                                                @if ($book->book_author)
                                                    <div class="book-card__author">
                                                        ${item['book_author']}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="item__info">
                                                <div class="info__header">
                                                    <div class="user__info">
                                                        <h3 class="author_name">
                                                            ${item['book_name'].length > 30 ? item['book_name'].substring(0, 30) + '...' : item['book_name']}
                                                        </h3>
                                                    </div>
                                                    <a href="#" class="fn__like no_border ${ has_like ? 'has__like': ''}"
                                                        data-id="${item['id']}">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                            id="Layer_1" x="0px" y="0px" viewBox="0 0 409 346.2"
                                                            style="enable-background:new 0 0 409 346.2;"
                                                            xml:space="preserve" class="fn__svg empty__like replaced-svg">
                                                            <g>
                                                                <path
                                                                    d="M409,126.1c-1.6,8.9-2.7,17.8-4.8,26.6c-4.3,18.3-12.8,34.9-23.3,50.4c-20.3,30.1-46.6,54.5-74.7,77   c-29.3,23.4-60.5,43.8-92.4,63.3c-6.1,3.7-12.3,3.8-18.4,0c-42.2-25.7-83.2-53.2-119.7-86.6C54,237,34.3,215.4,19.9,189.5   C-0.6,152.7-6.6,114.1,8.1,74C21.8,36.8,47.6,11.6,86.8,2.9c35.3-7.9,67.4,0.3,94.4,24.9c8.7,7.9,15.9,17.4,24,26.4   c1.6-2.2,3.6-5,5.7-7.8c9.5-12.7,20.7-23.5,34.4-31.6c18.6-11,38.7-15.6,60.3-14.3c23,1.4,43.5,9.3,61.2,24.1   c20.6,17.2,33.1,39.2,38.9,65.2c1.4,6.4,2.2,13,3.3,19.6C409,114.9,409,120.5,409,126.1z M376.8,123.9c1-28.3-8.5-53-25.6-70.5   c-24.9-25.3-67.6-28.4-95.8-7.1c-16.9,12.8-27.8,29.8-35.4,49.2c-3,7.6-8.8,12.1-15.7,12c-6.9-0.1-12.4-4.5-15.3-12   c-5.5-14.3-13.2-27.2-23.5-38.6c-20.9-23.3-54.2-31.3-83.1-19.5C56.9,47.9,42.1,67.7,35.3,93.9c-7.7,29.8-0.9,57.4,14.4,83.3   c13.8,23.4,32.4,42.7,52.6,60.7c30.8,27.4,64.9,50.4,99.7,72.2c1.8,1.2,3.1,1.2,5,0c27.5-17.2,54.5-35.2,79.9-55.5   c24.2-19.4,46.9-40.2,64.9-65.6C366.3,168.4,376.3,146.1,376.8,123.9z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 -28 512.00002 512"
                                                            class="fn__svg full__like replaced-svg">
                                                            <path
                                                                d="m471.382812 44.578125c-26.503906-28.746094-62.871093-44.578125-102.410156-44.578125-29.554687 0-56.621094 9.34375-80.449218 27.769531-12.023438 9.300781-22.917969 20.679688-32.523438 33.960938-9.601562-13.277344-20.5-24.660157-32.527344-33.960938-23.824218-18.425781-50.890625-27.769531-80.445312-27.769531-39.539063 0-75.910156 15.832031-102.414063 44.578125-26.1875 28.410156-40.613281 67.222656-40.613281 109.292969 0 43.300781 16.136719 82.9375 50.78125 124.742187 30.992188 37.394531 75.535156 75.355469 127.117188 119.3125 17.613281 15.011719 37.578124 32.027344 58.308593 50.152344 5.476563 4.796875 12.503907 7.4375 19.792969 7.4375 7.285156 0 14.316406-2.640625 19.785156-7.429687 20.730469-18.128907 40.707032-35.152344 58.328125-50.171876 51.574219-43.949218 96.117188-81.90625 127.109375-119.304687 34.644532-41.800781 50.777344-81.4375 50.777344-124.742187 0-42.066407-14.425781-80.878907-40.617188-109.289063zm0 0">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <p class="desc">${item['book_summary'].length > 40 ? item['book_summary'].substring(0, 40) + '...' : item['book_summary']}</p>
                                                <a href="{{ url('/') }}/books/${item['id']}"
                                                    class="filter__trending enabled btn-gradient-fill has__icon small__border">
                                                    <span>Read</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>`);
                    });

                    page++;
                    button.setAttribute('data-current_page', page);
                    document.getElementById(loader).style.display = 'none';
                    if (resp.next_page_url == null) {
                        document.getElementById('feed__more_area').style.display = 'none';
                    } else {
                        document.getElementById('feed__more_area').style.display = 'flex';
                    }
                },
                error: function(error) {
                    toastr.error('Something went wrong');
                } // Error
            });
        }
    </script>
@endpush
