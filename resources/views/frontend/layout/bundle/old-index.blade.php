@extends('frontend.app')



<!-- Start:Title -->

@section('title', 'Bundles')

<!-- End:Title -->

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        .courses-wrapper {
            padding: 20px 30px !important;
        }

        .dash-breadcrumb-tree {
            padding: 20px 30px 0;
        }

        @media only screen and (max-width: 650px) {
            .courses-wrapper {
                padding: 20px 30px !important;
            }

            .dash-breadcrumb-tree {
                padding: 20px 30px 0;
            }
        }

        @media only screen and (min-width: 1800px) {
            .course-card-thumb img {
                height: 240px !important;
            }
        }
    </style>
@endpush

<!-- Start:Content -->

@section('content')

    <div class="app-content-area">

        <!-- ./Dashboard Main Content :: Start -->

        <main class="dashboard-content-wrapper p-0">

            <div class="courses-section p-0">

                <!-- Dashboard Breadcrumb :: Start -->

                <section id="dash-breadcrumb" class="dash-breadcrumb-tree">

                    <div class=""></div>

                    <h3 class="dash-active-page">Bundles</h3>

                    <ul class="m-0 p-0">

                        <li class="d-inline-block"><a class="bg-transparent"
                                href="{{ route('user.dashboard') }}">Dashboard</a></li>

                        <li class="d-inline-block"><i class="bi bi-chevron-right"></i></li>

                        <li class="d-inline-block">Bundles</li>

                    </ul>

                </section>

                <!-- Dashboard Breadcrumb :: End -->

                <div class="courses-wrapper bg-transparent py-0">

                    <div class="row {{ count($bundles) == 0 ? 'justify-content-center' : '' }}">

                        @forelse ($bundles as $bundle)
                            <div class="col-sm-6 col-lg-4 col-xl-3 mb-5 mt-2">

                                <div class="card">

                                    <div class="course-card-thumb ">

                                        <img src="{{ asset($bundle['feature_image']) }}" alt="{{ $bundle['title'] }}"
                                            class="thumbnail w-100 rounded-3 object-fit-cover" style="min-height: 200px;">

                                        <a href="{{ route('single.bundle', $bundle['id']) }}">

                                            <i class="bi bi-play-fill"></i>

                                        </a>

                                    </div>

                                    <div class="course-card-info ps-3">

                                        <a href="{{ route('single.bundle', $bundle['id']) }}">

                                            <h4 class="text-hover">{{ Str::limit($bundle['title'], 20, '...') }}</h4>

                                        </a>

                                    </div>
                                    @php
                                        $redColor = 'text-black';
                                        foreach ($bundle['bundle_favourites'] as $fav) {
                                            if ($fav['bundle_id'] == $bundle['id'] && $fav['user_id'] == auth()->user()->id) {
                                                $redColor = 'text-danger';
                                            }
                                        }
                                    @endphp
                                    <button type="button"
                                        class="border-0 rounded-circle position-absolute d-flex align-items-center justify-content-center shadow"
                                        style="top: 10px; right: 16px; height: 40px; width: 40px;"
                                        onclick="bundleFavorite(this, '{{ $bundle['id'] }}')"><i
                                            class="fa-solid fa-heart {{ $redColor }}"
                                            style="font-size: 18px !important;"></i>
                                    </button>

                                </div>
                            </div>

                        @empty

                            <h1 class="text-danger h2 text-center">No Bundle Found</h1>
                        @endforelse

                    </div>

                </div>



                <!-- pagination start  -->

                @if ($bundles->nextPageUrl() || $bundles->previousPageUrl())

                    <nav>

                        <ul class="pagination d-flex justify-content-center flex-wrap pagination-flat pagination-success">

                            <!-- Previous Page Link -->

                            @if ($bundles->onFirstPage())
                                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">

                                    <span class="page-link" aria-hidden="true">&lsaquo;</span>

                                </li>
                            @else
                                <li class="page-item">

                                    <a class="page-link" href="{{ $bundles->previousPageUrl() }}" rel="prev"
                                        aria-label="@lang('pagination.previous')">&lsaquo;</a>

                                </li>
                            @endif



                            <!-- Pagination Elements -->

                            @foreach ($bundles->getUrlRange(1, $bundles->lastPage()) as $page => $url)
                                @if ($page == $bundles->currentPage())
                                    <li class="page-item active" aria-current="page"><span
                                            class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach



                            <!-- Next Page Link -->

                            @if ($bundles->hasMorePages())
                                <li class="page-item">

                                    <a class="page-link" href="{{ $bundles->nextPageUrl() }}" rel="next"
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

            </div>

        </main>

        <!-- ./Dashboard Main Content :: End -->

    </div>

@endsection
<!-- Start:Script -->

@push('script')
    <script>
        //favorite bundle

        function bundleFavorite(button, bundle_id) {

            $.ajax({

                type: "POST",

                url: '{{ route('bundle.favorite') }}',

                data: {

                    bundle_id: bundle_id,

                },

                success: function(resp) {

                    if (resp.success === true && resp.type == 'add') {

                        button.innerHTML =

                            '<i class="fa-solid fa-heart text-danger" style="font-size: 18px !important;"></i>';

                        toastr.success(resp.message);

                    } else if (resp.success === true && resp.type == 'remove') {

                        button.innerHTML =

                            '<i class="fa-solid fa-heart text-black" style="font-size: 18px !important;"></i>';

                        toastr.error(resp.message);

                    } else if (resp.errors) {

                        toastr.error(resp.errors[0]);

                    } else {

                        toastr.error(resp.message);

                    }

                },

                error: function(error) {

                    toastr.error("Something went wrong");

                }

            })

        }
    </script>
@endpush

<!-- End:Script -->
