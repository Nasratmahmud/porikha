@extends('frontend.app')



<!-- Start:Title -->

@section('title', 'List Of Guides')

<!-- End:Title -->

@push('style')
    <style>
        .fn__model_item {
            margin: 0 0 20px;
            padding: 0 0 0 20px;
            width: 25%;
        }

        .count {
            background-color: #7c5fe3;
            display: inline-block;
            margin-right: 5px;
            color: white;
            padding: 2px 14px;
            border-radius: 20px;
            font-size: 12px;
        }

        .guide-angkor {
            text-decoration: none !important;
        }

        .fn__preloader {
            height: 100% !important;
            border: 0px !important;
        }

        .feed__more {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 25px 0;
        }

        .tab_in {
            display: flex;
            align-items: center;
        }

        .tab_in span {
            margin-right: 25px;
            font-size: 18px;
            font-weight: 500;
            background-color: #7c5fe3;
            color: white;
            padding: 2px 10px;
            border-radius: 5px;
        }
    </style>
@endpush



<!-- Start:Content -->

@section('content')

    <!-- Dashboard :: Left -> Start -->

    <div class="app-content-area">


        <div class="techwave_fn_models_page">

            <div class="fn__title_holder">
                <div class="container">
                    <h1 class="title fn__animated_text ">List of Guides</h1>
                </div>
            </div>

            <!-- Models -->
            <div class="techwave_fn_models">

                <div class="fn__tabs">
                    <div class="container">
                        <div class="tab_in">
                            <a class="active tab-item-filter" onclick="guideFilterByCategory(this,'all', 'fn__model_items')"
                                href="#">All</a>
                            @foreach ($categories as $category)
                                <a onclick="guideFilterByCategory(this,'{{ $category['category_name'] }}', 'fn__model_items')"
                                    href="#" class="tab-item-filter">{{ $category['category_name'] }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>


                <div class="container">
                    <!-- models content -->
                    <div class="models__content">
                        <div class="models__results">
                            <div class="fn__preloader">
                                <div class="icon"></div>
                                <div class="text">Loading</div>
                            </div>
                            <div class="">
                                <div class="">
                                    <ul class="fn__model_items" id="fn__model_items">
                                        @forelse ($guides as $guidance )
                                            <li class="fn__model_item">
                                                <a class="guide-angkor"
                                                    href="{{ route('guidances.single', ['slug' => $guidance['guide_slug']]) }}">
                                                    <div class="item">
                                                        <div class="img">
                                                            <img src="{{ asset($guidance->feature_image) }}" alt="">
                                                        </div>
                                                        <div class="item__info">
                                                            <h3 class="title" style="font-weight: 600">
                                                                {!! Str::limit($guidance->guide_name, 30, '...') !!}
                                                            </h3>

                                                        </div>
                                                        <div class="item__author" style="text-align: center">
                                                            @php
                                                                $tagArr = explode(',', $guidance->tag);
                                                            @endphp
                                                            @foreach ($tagArr as $tag)
                                                                <span class="count">{{ $tag }}</span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @empty
                                            <h1>No Data</h1>
                                        @endforelse
                                    </ul>
                                    @if ($guides->nextPageUrl())
                                        <div id="loader_gif" style="text-align: center;display:none;">
                                            <img src="{{ asset('frontend/img/loader.gif') }}" height="60" width="60">
                                        </div>
                                        <div class="feed__more" id="feed__more_area">
                                            <a id="load_more_btn" data-current_page="{{ $guides->currentPage() + 1 }}"
                                                data-current_path="{{ $guides->path() }}"
                                                onclick="loadMoreGuide(this,'fn__model_items','loader_gif')" href="#"
                                                class="medium techwave_fn_button"><span>Load
                                                    More</span></a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- !models content -->
                </div>

            </div>
            <!-- !Models -->

        </div>
    </div>
    <!-- Dashboard :: Left -> End -->

@endsection

<!-- Start:Script -->

@push('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                }
            });
        });
        //Guide filter by category
        function guideFilterByCategory(button, category, list) {
            let user_id = "{{ auth()->user()->id }}";
            let guideList = document.getElementById(list);
            guideList.innerHTML = '';
            // let button = document.getElementById('load_more_btn');

            // Building the URL with tag as a parameter and query string ?page=1 using template literal
            let url = `{{ route('guides.filter', '') }}/${encodeURIComponent(category)}`;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(resp) {
                    let tabItem = document.querySelectorAll('.tab-item-filter');
                    tabItem.forEach(element => {
                        element.classList.remove('active');
                    });
                    button.classList.add('active');
                    // button.setAttribute('data-current_page', resp.current_page + 1);
                    // button.setAttribute('data-current_path', resp.path);
                    resp.data.forEach(item => {
                        guideList.innerHTML +=
                            `<li class="fn__model_item">
                                <a class="guide-angkor" href="{{ url('/') }}/guidances/${item['guide_slug']}">
                                    <div class="item">
                                        <div class="img">
                                            <img src="{{ asset('') }}${item['feature_image']}" alt="${item['guide_name']}">
                                        </div>
                                        <div class="item__info">
                                            <h3 class="title" style="font-weight: 600">${item['guide_name']}</h3>
                                        </div>
                                        <div class="item__author" style="text-align: center">

                                            ${item.tag.split(",") ? item.tag.split(",").map(tag => `<span class="count">${tag}</span>`).join('') : `<span class="count">${item.tag}</span>`}
                                        </div>
                                    </div>
                                </a>
                            </li>`;
                    });
                },
                error: function(error) {
                    toastr.error('Something went wrong');
                } // Error
            })
        }



        //guide load more button
        function loadMoreGuide(button, list, loader) {
            document.getElementById(loader).style.display = 'block';
            let user_id = "{{ auth()->user()->id }}";
            let guideList = document.getElementById(list);
            let page = parseInt(button.getAttribute('data-current_page'));
            let path = button.getAttribute('data-current_path');
            let url = `${path}?page=${page}`;
            $.ajax({
                type: "GET",
                url: url,
                success: function(resp) {
                    resp.data.forEach(item => {
                        guideList.innerHTML +=
                            `<li class="fn__model_item">
                                <a class="guide-angkor" href="{{ url('/') }}/guidances/${item['guide_slug']}">
                                    <div class="item">
                                        <div class="img">
                                            <img src="{{ asset('') }}${item['feature_image']}" alt="${item['guide_name']}">
                                        </div>
                                        <div class="item__info">
                                            <h3 class="title" style="font-weight: 600">${item['guide_name']}</h3>
                                        </div>
                                        <div class="item__author" style="text-align: center">
                                            ${item.tag.split(",") ? item.tag.split(",").map(tag => `<span class="count">${tag}</span>`).join('') : `<span class="count">${item.tag}</span>`}
                                        </div>
                                    </div>
                                </a>
                            </li>`;
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
            })
        }
    </script>
@endpush

<!-- End:Script -->
