@extends('frontend.layout.profile.master_layout')
@push('style')
    <style>
        @media only screen and (min-width: 400px) and (max-width: 767px) {
            .course-wrap {
                padding: 0 20% !important;
            }
        }
    </style>
@endpush

@section('tab_section')

    <section class="user--course--area user--padding">

        <div class="row course-wrap" id="bundle_collection">



            @forelse ($favBundle as $fav)
                {{-- Course Item  --}}

                <div class="col-lg-4 col-md-6 col-xl-3 col-12 my-5 mt-md-0 bundle" id="bundle_{{ $fav['bundle']['id'] }}">

                    <div class="card h-100">

                        <div class="course-card-thumb">

                            <img src="{{ asset($fav['bundle']['feature_image']) }}" alt="{{ $fav['bundle']['title'] }}"
                                class="img-fluid w-100 rounded-3">

                            <a href="{{ route('bundle.page') }}">

                                <i class="bi bi-play-fill"></i>

                            </a>

                        </div>

                        <div class="course-card-info flex-column px-3 pb-3 h-100">

                            <a href="{{ route('single.bundle', $fav['bundle']['id']) }}" class="w-100">

                                <h4 class="text-hover">{{ Str::limit($fav['bundle']['title'], 20, '...') }}</h4>

                            </a>

                            <div class="text-start w-100">

                                <span class="text-start badge bg-primary fs-5 mt-2">

                                    <i class="bi bi-clock-fill me-1"></i>

                                    {{ $fav['bundle']['title'] }}

                                </span>

                            </div>

                        </div>
                        @php
                            $redColor = '';
                            foreach ($fav['bundle']['bundle_favourites'] as $item) {
                                if ($item['bundle_id'] == $fav['bundle']['id'] && $item['user_id'] == auth()->user()->id) {
                                    $redColor = 'text-danger';
                                }
                            }
                        @endphp
                        <button type="button"
                            class="border-0 rounded-circle position-absolute d-flex align-items-center justify-content-center shadow"
                            style="top: 10px; right: 16px; height: 40px; width: 40px;"
                            onclick="bundleFavorite(this, '{{ $fav['bundle']['id'] }}')"><i
                                class="fa-solid fa-heart {{ $redColor }}" style="font-size: 18px !important;"></i>
                        </button>
                    </div>

                </div>

            @empty

                <h1 class="text-danger text-center h3">You haven't favorited a bundle yet</h1>
            @endforelse

        </div>

        <!-- pagination start  -->

        @if ($favBundle->nextPageUrl() || $favBundle->previousPageUrl())
            <nav>

                <ul class="pagination d-flex justify-content-center flex-wrap pagination-flat pagination-success">

                    <!-- Previous Page Link -->

                    @if ($favBundle->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">

                            <span class="page-link" aria-hidden="true">&lsaquo;</span>

                        </li>
                    @else
                        <li class="page-item">

                            <a class="page-link" href="{{ $favBundle->previousPageUrl() }}" rel="prev"
                                aria-label="@lang('pagination.previous')">&lsaquo;</a>

                        </li>
                    @endif



                    <!-- Pagination Elements -->

                    @foreach ($favBundle->getUrlRange(1, $favBundle->lastPage()) as $page => $url)
                        @if ($page == $favBundle->currentPage())
                            <li class="page-item active" aria-current="page"><span
                                    class="page-link">{{ $page }}</span>

                            </li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a>

                            </li>
                        @endif
                    @endforeach



                    <!-- Next Page Link -->

                    @if ($favBundle->hasMorePages())
                        <li class="page-item">

                            <a class="page-link" href="{{ $favBundle->nextPageUrl() }}" rel="next"
                                aria-label="@lang('pagination.next')">&rsaquo;</a>

                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">

                            <span class="page-link" aria-hidden="true">&rsaquo;</span>

                        </li>
                    @endif

                </ul>

            </nav>
        @endif

        <!-- pagination End  -->

    </section>

@endsection
