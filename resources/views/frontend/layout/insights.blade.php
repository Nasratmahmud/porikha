@extends('frontend.app')



<!-- Start:Title -->

@section('title', 'Insights')

<!-- End:Title -->

@push('style')
    <style>
        .insights-book-wrapper,

        .insights-course-section .insights-course {

            height: auto;

            max-width: 615px;

        }

        .insights-course-section .insights-course .insights-course-card,
        .insights-book-section .insights-book-card {
            background-color: transparent;
        }

        [data-theme=dark] .insights-course-section .insights-course .insights-course-card,
        [data-theme=dark] .insights-book-section .insights-book-card {
            background-color: var(--dashui-body-bg);
        }

        .insights {
            padding: 20px 30px 0;
        }

        .dash-breadcrumb-tree {
            padding: 20px 30px 0;
        }

        @media only screen and (max-width: 650px) {
            .dash-breadcrumb-tree {
                padding: 20px 30px 0;
            }
        }
    </style>
@endpush



<!-- Start:Content -->

@section('content')

    <div class="app-content-area">

        <!-- ./Dashboard Main Content :: Start -->

        <main class="dashboard-content-wrapper p-0">

            <div class="books-section">

                <!-- Dashboard Breadcrumb :: Start -->

                <section id="dash-breadcrumb" class="dash-breadcrumb-tree">

                    <div class=""></div>

                    <h3 class="dash-active-page">Insights</h3>

                    <ul class="m-0 p-0">

                        <li class="d-inline-block"><a class="bg-transparent"
                                href="{{ route('user.dashboard') }}">Dashboard</a></li>

                        <li class="d-inline-block"><i class="bi bi-chevron-right"></i></li>

                        <li class="d-inline-block">Insights</li>

                    </ul>

                </section>

                <!-- Dashboard Breadcrumb :: End -->

                <div class="insights">

                    <div class="d-flex justify-content-between insights-section">

                        {{-- Books Section --}}

                        <div class="insights-book-section">

                            <h3 class="p-5 fw-bold">Books</h3>

                            <div class="insights-book-wrapper m-0 p-0">

                                @forelse ($favBooks as $book)
                                    {{-- Books Item --}}

                                    <div class="insights-book-card">

                                        <div class="d-flex align-items-center text-center text-md-start">

                                            <img src="{{ asset($book['book']['feature_image']) }}"
                                                alt="{{ $book['book']['book_name'] }}">

                                            <div>

                                                <h4 class="text-hover">{{ $book['book']['book_name'] }}</h4>

                                                <p>{{ $book['book']['book_author'] }}</p>

                                            </div>

                                        </div>

                                    </div>

                                @empty

                                    <h1 class="text-danger p-5 h2">You haven't favorited a book yet</h1>
                                @endforelse



                            </div>

                        </div>



                        {{-- Course Section --}}

                        <div class="insights-course-section">

                            <h3 class="p-5 fw-bold">Course</h3>

                            <div class="insights-course my-0 {{ count($purchaseCourses) == 0 ? 'd-flex' : '' }}">

                                @forelse ($purchaseCourses as $purchase)
                                    {{-- Course Item --}}

                                    <div class="insights-course-card shadow-sm text-center text-md-start">

                                        <a href="{{ route('course.enrollment', $purchase['course']['id']) }}">

                                            <img class="rounded-3"
                                                src="{{ asset($purchase['course']['course_feature_image']) }}"
                                                alt="{{ $purchase['course']['course_title'] }}">

                                        </a>

                                        <a href="{{ route('course.enrollment', $purchase['course']['id']) }}">

                                            <h4 class="text-hover">
                                                {{ Str::limit($purchase['course']['course_title'], 20, '...') }}</h4>

                                        </a>

                                        <p>{{ $purchase['course']['level'] }}</p>

                                        <div>

                                            {{-- Complete module percentage progress bar --}}

                                            @php

                                                $modulePercentage = 100 / count($purchase['course']['course_modules']);

                                                $module_completed = App\Models\CoursePurchase::module_compete($purchase['course']['id']);

                                                $modulePercentage *= count($module_completed);

                                            @endphp

                                            <p class="text-end">{{ number_format($modulePercentage, 2) }}%</p>

                                            <div class="progress" style="height: 4px;">

                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $modulePercentage }}%;" aria-valuemin="0"
                                                    aria-valuemax="100"></div>

                                            </div>

                                        </div>

                                    </div>

                                @empty

                                    <h1 class="text-danger p-5 h2">You have not purchased any courses yet</h1>
                                @endforelse

                            </div>

                        </div>



                    </div>

                </div>

            </div>

        </main>

    </div>

@endsection

<!-- Start:Script -->

@push('script')
@endpush

<!-- End:Script -->
