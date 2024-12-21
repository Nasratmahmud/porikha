@extends('frontend.app')



<!-- Start:Title -->

@section('title', 'Courses')

<!-- End:Title -->

@push('style')
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

                    <h3 class="dash-active-page">Courses</h3>

                    <ul class="m-0 p-0">

                        <li class="d-inline-block"><a class="bg-transparent"
                                href="{{ route('user.dashboard') }}">Dashboard</a></li>

                        <li class="d-inline-block"><i class="bi bi-chevron-right"></i></li>

                        <li class="d-inline-block">Courses</li>

                    </ul>

                </section>

                <!-- Dashboard Breadcrumb :: End -->

                <div class="courses-wrapper bg-transparent py-0 ">

                    <div class="row {{ count($courses) == 0 ? ' justify-content-center' : '' }}">

                        @forelse ($courses as $course)
                            <div class="col-sm-6 col-lg-4 col-xl-3 mb-5 mt-2">

                                <div class="card h-100">

                                    <div class="course-card-thumb">

                                        <img src="{{ asset($course['course_feature_image']) }}"
                                            alt="{{ $course['course_title'] }}" class="thumbnail rounded-3 w-100"
                                            style="border-radius: .5rem .5rem 0 0 !important">

                                        <a href="{{ route('course.enrollment', $course['id']) }}">

                                            <i class="bi bi-play-fill"></i>

                                        </a>

                                    </div>

                                    <div class="course-card-info flex-column px-3 pb-3 h-100">

                                        <a href="{{ route('course.enrollment', $course['id']) }}" class="w-100">
                                            <h4 class="text-hover">{{ Str::limit($course['course_title'], 20, '...') }}</h4>
                                        </a>

                                        <div class="text-start w-100 d-flex justify-content-between">

                                            <span class="text-start badge bg-primary fs-5 mt-2">

                                                <i class="bi bi-clock-fill me-1"></i>

                                                {{ $course['duration'] }}

                                            </span>
                                            @if (in_array($course['id'], $enrollment))
                                                <a class="text-primary fw-medium fs-5 mt-2"
                                                    href="{{ route('course.enrollment', $course['id']) }}">Learning</a>
                                            @else
                                                @if ($course['course_price'] == null || $course['course_price'] == 0)
                                                    <span class="text-start badge bg-success fs-5 mt-2">Free</span>
                                                @else
                                                    <span class="text-start fs-4 mt-2 fw-bold cus-text">
                                                        ${{ $course['course_price'] }}
                                                    </span>
                                                @endif
                                            @endif
                                        </div>

                                    </div>

                                </div>

                            </div>

                        @empty
                            <h1 class="text-danger h3 text-center">No Course Found</h1>
                        @endforelse

                    </div>

                </div>



                <!-- pagination start  -->

                @if ($courses->nextPageUrl() || $courses->previousPageUrl())

                    <nav>

                        <ul class="pagination d-flex justify-content-center flex-wrap pagination-flat pagination-success">

                            <!-- Previous Page Link -->

                            @if ($courses->onFirstPage())
                                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">

                                    <span class="page-link" aria-hidden="true">&lsaquo;</span>

                                </li>
                            @else
                                <li class="page-item">

                                    <a class="page-link" href="{{ $courses->previousPageUrl() }}" rel="prev"
                                        aria-label="@lang('pagination.previous')">&lsaquo;</a>

                                </li>
                            @endif



                            <!-- Pagination Elements -->

                            @foreach ($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                                @if ($page == $courses->currentPage())
                                    <li class="page-item active" aria-current="page"><span
                                            class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach



                            <!-- Next Page Link -->

                            @if ($courses->hasMorePages())
                                <li class="page-item">

                                    <a class="page-link" href="{{ $courses->nextPageUrl() }}" rel="next"
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
@endpush

<!-- End:Script -->
