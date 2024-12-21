@php
    $purchaseCourses = App\Models\CoursePurchase::with('course.course_modules.course_contents')
        ->where('user_id', auth()->user()->id)
        ->latest()
        ->paginate(6);
@endphp

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

        <div class="row course-wrap">



            @forelse ($purchaseCourses as $purchase)
                {{-- Course Item  --}}

                <div class="col-lg-4 col-md-6 col-xl-3 col-12 my-5 mt-md-0">

                    <div class="card h-100">

                        <div class="course-card-thumb">

                            <img src="{{ asset($purchase['course']['course_feature_image']) }}"
                                alt="{{ $purchase['course']['course_title'] }}" class="img-fluid w-100 rounded-3">

                            <a href="{{ route('course.enrollment', $purchase['course']['id']) }}">

                                <i class="bi bi-play-fill"></i>

                            </a>

                        </div>

                        <div class="course-card-info flex-column px-3 pb-3 h-100">

                            <a href="{{ route('course.enrollment', $purchase['course']['id']) }}" class="w-100">

                                <h4 class="text-hover">{{ Str::limit($purchase['course']['course_title'], 20, '...') }}</h4>

                            </a>

                            <div class="text-start w-100">

                                <span class="text-start badge bg-primary fs-5 mt-2">

                                    <i class="bi bi-clock-fill me-1"></i>

                                    {{ $purchase['course']['duration'] }}

                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <h1 class="text-danger text-center h3">You have not purchased any courses yet</h1>
            @endforelse

        </div>

        <!-- pagination start  -->

        @if ($purchaseCourses->nextPageUrl() || $purchaseCourses->previousPageUrl())
            <nav>

                <ul class="pagination d-flex justify-content-center flex-wrap pagination-flat pagination-success">

                    <!-- Previous Page Link -->

                    @if ($purchaseCourses->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">

                            <span class="page-link" aria-hidden="true">&lsaquo;</span>

                        </li>
                    @else
                        <li class="page-item">

                            <a class="page-link" href="{{ $purchaseCourses->previousPageUrl() }}" rel="prev"
                                aria-label="@lang('pagination.previous')">&lsaquo;</a>

                        </li>
                    @endif



                    <!-- Pagination Elements -->

                    @foreach ($purchaseCourses->getUrlRange(1, $purchaseCourses->lastPage()) as $page => $url)
                        @if ($page == $purchaseCourses->currentPage())
                            <li class="page-item active" aria-current="page"><span
                                    class="page-link">{{ $page }}</span>

                            </li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a>

                            </li>
                        @endif
                    @endforeach



                    <!-- Next Page Link -->

                    @if ($purchaseCourses->hasMorePages())
                        <li class="page-item">

                            <a class="page-link" href="{{ $purchaseCourses->nextPageUrl() }}" rel="next"
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
