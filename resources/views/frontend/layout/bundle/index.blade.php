@extends('frontend.app')
<!-- Title -->
@section('title', 'Bundles')
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

        .techwave_fn_changelog {
            display: flex;
            flex-flow: wrap;
            justify-content: space-between;
        }

        .courses__item-thumb {
            width: 370px;
        }

        /*Custom card*/
        .custom_bundle__card {
            width: 32%;
            height: auto;
            background: transparent;
            border-radius: 10px;
            transition: 0.2s ease-in-out;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            margin-bottom: 50px;
        }

        .custom_bundle__card .img {
            width: 100%;
            height: 260px;
            border-top-left-radius: 30px;
            border-top-right-radius: 30px;
            background: linear-gradient(#e66465, #9198e5);
            display: flex;
            align-items: top;
            justify-content: right;
        }

        .custom_bundle__card .save {
            transition: 0.2s ease-in-out;
            border-radius: 10px;
            margin: 20px;
            width: 30px;
            height: 30px;
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
        }

        .custom_bundle__card .text {
            margin: 20px;
            display: block;
        }

        .custom_bundle__card .save .svg {
            transition: 0.2s ease-in-out;
            width: 15px;
            height: 15px;
        }



        .custom_bundle__card .icon-box svg {
            width: 17px;
        }

        .custom_bundle__card .text .h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 0px;

        }

        .custom_bundle__card .text .p {
            color: #999999;
            font-size: 13px;
        }

        .custom_bundle__card .icon-box .span {
            font-size: 13px;
            font-weight: 500;
            color: #9198e5;
            margin-bottom: 0px;
        }

        .custom_bundle__card:hover {
            cursor: pointer;
            box-shadow: 0px 10px 20px rgba(0,0,0,0.1);
        }

        .custom_bundle__card .save:hover {
            transform: scale(1.1) rotate(10deg);
        }

        .custom_bundle__card .save:hover .svg {
            fill: #ced8de;
        }

        .custom_bundle__card img{
            width:100%;
            height:100%;
            object-fit:cover;
            border-radius: 10px 10px 0px 0px;
        }

        .save .fn_bundle_like.fav__bundle{
            width: auto !important;
            padding: 27px !important;
            display: block !important;
            border: 0px !important;
        }

        .save .has__like svg{
            fill: #ab0cdf !important;
        }


    </style>
@endpush

{{-- Main Content --}}
@section('content')

    <div class="app-content-area">
        <div class="techwave_fn_models_page">
            <div class="fn__title_holder">
                <div class="container">
                    <h1 class="title fn__animated_text ">Complete Service Collection: One Bundle, Many Benefits</h1>
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
                                        @forelse ($bundles as $bundle)
                                            <div class="card custom_bundle__card">
                                                <div class="img">
                                                    <img src="{{ asset($bundle['feature_image']) }}" alt="{{ $bundle['title'] }}" >
                                                    <div class="save">

                                                        @php
                                                            $favBundle = \App\Models\BundleFavourite::where(['user_id'=> auth()->user()->id, 'bundle_id' => $bundle->id])->first();
                                                        @endphp

                                                        <a class="fn_bundle_like fav__bundle {{ $favBundle ? 'has__like' : '' }} " id="bundle_{{ $bundle['id'] }}" onclick="bundleLike({{ $bundle['id'] }})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 409 346.2"
                                                                 style="enable-background:new 0 0 409 346.2;" xml:space="preserve"
                                                                 class="fn__svg empty__like replaced-svg">
                                                                <g>
                                                                    <path
                                                                        d="M409,126.1c-1.6,8.9-2.7,17.8-4.8,26.6c-4.3,18.3-12.8,34.9-23.3,50.4c-20.3,30.1-46.6,54.5-74.7,77   c-29.3,23.4-60.5,43.8-92.4,63.3c-6.1,3.7-12.3,3.8-18.4,0c-42.2-25.7-83.2-53.2-119.7-86.6C54,237,34.3,215.4,19.9,189.5   C-0.6,152.7-6.6,114.1,8.1,74C21.8,36.8,47.6,11.6,86.8,2.9c35.3-7.9,67.4,0.3,94.4,24.9c8.7,7.9,15.9,17.4,24,26.4   c1.6-2.2,3.6-5,5.7-7.8c9.5-12.7,20.7-23.5,34.4-31.6c18.6-11,38.7-15.6,60.3-14.3c23,1.4,43.5,9.3,61.2,24.1   c20.6,17.2,33.1,39.2,38.9,65.2c1.4,6.4,2.2,13,3.3,19.6C409,114.9,409,120.5,409,126.1z M376.8,123.9c1-28.3-8.5-53-25.6-70.5   c-24.9-25.3-67.6-28.4-95.8-7.1c-16.9,12.8-27.8,29.8-35.4,49.2c-3,7.6-8.8,12.1-15.7,12c-6.9-0.1-12.4-4.5-15.3-12   c-5.5-14.3-13.2-27.2-23.5-38.6c-20.9-23.3-54.2-31.3-83.1-19.5C56.9,47.9,42.1,67.7,35.3,93.9c-7.7,29.8-0.9,57.4,14.4,83.3   c13.8,23.4,32.4,42.7,52.6,60.7c30.8,27.4,64.9,50.4,99.7,72.2c1.8,1.2,3.1,1.2,5,0c27.5-17.2,54.5-35.2,79.9-55.5   c24.2-19.4,46.9-40.2,64.9-65.6C366.3,168.4,376.3,146.1,376.8,123.9z">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="text">
                                                    <p class="h3">{{ Str::limit($bundle['title'], 20, '...') }}</p>
                                                    <p class="p"> {{ Str::limit($bundle['sub_title'], 40, '...') }} </p>
                                                    <div class="icon-box">
                                                        <a href="{{ route('single.bundle', $bundle['id']) }}" class="btn-gradient-fill">See Bundle</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <h1>No Bundles Available</h1>
                                        @endforelse
                                    </div>
                                    <!-- Pagination Elements -->
                                    @if ($bundles->nextPageUrl() || $bundles->previousPageUrl())
                                        <nav>
                                            <ul class="pagination">
                                                <!-- Previous Page Link -->
                                                @if ($bundles->onFirstPage())
                                                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                                        <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $bundles->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                                    </li>
                                                @endif

                                            <!-- Pagination Elements -->
                                                @foreach ($bundles->getUrlRange(1, $bundles->lastPage()) as $page => $url)
                                                    @if ($page == $bundles->currentPage())
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

                                                @if ($bundles->hasMorePages())
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $bundles->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
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

@push('script')
    <script>

        function bundleLike(id){
            var bundle_id = id;

            $.ajax({
                type: "POST",
                url: "/bundles/favorite",
                data: {
                    bundle_id: bundle_id,
                },
                success: function(resp) {
                    if (resp.success === true) {
                        if (resp.type === "add") {
                            $("#bundle_"+id).addClass("has__like");
                            toastr.success("Item added to your favorites!");
                        } else if (resp.type === "remove") {
                            $("#bundle_"+id).removeClass("has__like");
                            toastr.warning("Item removed from your favorites!");
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
            return false;
        }


    </script>
@endpush
