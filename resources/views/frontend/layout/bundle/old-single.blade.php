@extends('frontend.app')



<!-- Title -->

@section('title', "$bundle->title")

@push('style')
    <!-- Add these lines to include pdf.js -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf_viewer.min.css" />

    <style>
        .journal-details-section {

            height: auto;

        }



        .journal-details-section img {

            max-height: 500px;

        }



        .bc-course-card-row.courses-row {

            display: flex;

            flex-direction: column;

            align-items: center;

        }



        .course-card {

            width: 400px;

        }



        .course-card-thumb.position-relative {

            transition: .5s ease-in-out;

        }



        @media only screen and (min-width: 991px) {

            .course-card-thumb.position-relative:hover span input.book-view-button {

                display: block !important;

            }

        }



        @media only screen and (max-width: 991px) {

            .course-card-thumb.position-relative:hover span a.book-view-mobile {

                display: block !important;

            }

        }



        .course-card-thumb.position-relative:hover> ::before {

            content: '';

            position: absolute;

            top: 0;

            left: 0;

            width: 100%;

            height: 100%;

            background-color: rgba(0, 0, 0, 0.5);

        }



        .first-letter-uppercase::first-letter {

            text-transform: capitalize;

        }



        .course-card-thumb img {

            height: auto;

        }

        /* [data-theme=dark] .journal-details-section {
                                                                            background: transparent;
                                                                        } */

        .dash-breadcrumb-tree {
            padding: 20px 30px 0;
        }

        @media only screen and (max-width: 650px) {
            .dash-breadcrumb-tree {
                padding: 20px 30px 0;
            }

            .course-card {
                width: 90%;
            }

            .journal-details {
                padding: 24px 30px 52px 30px;
            }

            .journal-details-section {
                padding: 10px;
            }
        }

        @media only screen and (min-width: 320px) and (max-width: 360px) {
            .journal-details {
                background: transparent;
            }
        }
    </style>
@endpush



{{-- Main Content --}}

@section('content')

    <div class="app-content-area">

        <!-- ./Dashboard Main Content :: Start -->

        <main class="dashboard-content-wrapper mt-5">

            <!-- Dashboard Breadcrumb :: Start -->

            <section id="dash-breadcrumb" class="dash-breadcrumb-tree">

                <div class=""></div>

                <h3 class="dash-active-page first-letter-uppercase">{{ $bundle->title }}</h3>

                <ul class="m-0 p-0">

                    <li class="d-inline-block"><a class="bg-transparent" href="{{ route('user.dashboard') }}">Dashboard</a>

                    </li>

                    <li class="d-inline-block"><i class="bi bi-chevron-right"></i></li>

                    <li class="d-inline-block">{{ $bundle->title }}</li>

                </ul>

            </section>

            <!-- Dashboard Breadcrumb :: End -->

            <div class="journal-details">

                <div class="journal-details-section p-5">

                    <h4 class="first-letter-uppercase text-hover">{{ $bundle->sub_title }}</h4>

                    <img class="img-fluid object-fit-fill rounded-3" src="{{ asset($bundle->feature_image) }}"
                        alt="{{ $bundle->title }}">

                </div>

            </div>

            @if (in_array(2, $types))

                {{-- Course List  --}}

                <div class="journal-details">

                    <div class="journal-details-section">

                        <div class="d-flex justify-content-center flex-column gap-2 mt-5">

                            <div>

                                <h3 class="text-center fw-bold">Courses</h3>

                                <div class="bc-course-cards-wrapper">

                                    <div class="bc-course-card-row courses-row">

                                        {{-- Course item --}}

                                        @foreach ($bundle->bundle_items as $item)
                                            @if ($item->type == 2)
                                                <div class="course-card card mb-5 shadow">

                                                    <div class="course-card-thumb">

                                                        <img src="{{ asset($item->course->course_feature_image) }}"
                                                            alt="{{ $item->course->course_title }}"
                                                            class="img-fluid rounded-3"
                                                            style="border-radius: 0.5rem 0.5rem 0 0 !important;">

                                                        <a href="{{ route('course.enrollment', $item->course->id) }}">

                                                            <i
                                                                class="bi

                                                        bi-play-fill"></i>

                                                        </a>

                                                    </div>

                                                    <div
                                                        class="course-card-info align-items-start flex-column text-center px-2">

                                                        <a href="{{ route('course.enrollment', $item->course->id) }}">

                                                            <h4 class="text-hover px-2">{{ $item->course->course_title }}
                                                            </h4>

                                                        </a>

                                                        <div class="text-center w-100 mb-4">

                                                            <span class="text-start badge bg-primary fs-5 mt-2">

                                                                <i class="bi bi-clock-fill me-1"></i>

                                                                {{ $item->course['duration'] }}

                                                            </span>
                                                            @if (in_array($item->course['id'], $enrollment))
                                                                <a class="text-start badge bg-info fs-5 mt-2"
                                                                    href="{{ route('course.enrollment', $item->course['id']) }}">Learning</a>
                                                            @else
                                                                @if ($item->course['course_price'] == null || $item->course['course_price'] == 0)
                                                                    <span
                                                                        class="text-start badge bg-success fs-5 mt-2">Free</span>
                                                                @else
                                                                    <span class="text-start fs-4 mt-2 fw-bold">
                                                                        ${{ $item->course['course_price'] }}
                                                                    </span>
                                                                @endif
                                                            @endif

                                                        </div>



                                                    </div>

                                                </div>
                                            @endif
                                        @endforeach

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @endif



            @if (in_array(1, $types))

                {{-- Journal List  --}}

                <div class="journal-details">

                    <div class="journal-details-section">

                        <div class="d-flex justify-content-center flex-column gap-2 mt-5">

                            <div>

                                <h3 class="text-center fw-bold">Journal</h3>

                                <div class="bc-course-cards-wrapper">

                                    <div class="bc-course-card-row courses-row">

                                        {{-- Journal item --}}

                                        @foreach ($bundle->bundle_items as $item)
                                            @if ($item->type == 1)
                                                <div class="course-card card mb-5 shadow">

                                                    <div class="course-card-thumb">

                                                        <img src="{{ asset($item->journal->journal_featured_image) }}"
                                                            alt="{{ $item->journal->journal_title }}"
                                                            class="img-fluid w-100 rounded-3"
                                                            style="border-radius: 0.5rem 0.5rem 0 0 !important;">

                                                        <a class="fs-5"
                                                            href="{{ route('single.journal', $item->journal->journal_slug) }}">

                                                            <i
                                                                class="bi

                                                bi-eye"></i>

                                                        </a>

                                                    </div>

                                                    <a class="mt-3"
                                                        href="{{ route('single.journal', $item->journal->journal_slug) }}">

                                                        <h4 class="text-center text-hover px-2">

                                                            {{ $item->journal->journal_title }}

                                                        </h4>

                                                    </a>

                                                </div>
                                            @endif
                                        @endforeach

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @endif



            @if (in_array(3, $types))

                {{-- Book List  --}}

                <div class="journal-details">

                    <div class="journal-details-section">

                        <div class="d-flex justify-content-center flex-column gap-2 mt-5">

                            <div>

                                <h3 class="text-center fw-bold">Books</h3>

                                <div class="bc-course-cards-wrapper">

                                    <div class="bc-course-card-row courses-row">

                                        {{-- Book item --}}

                                        @foreach ($bundle->bundle_items as $item)
                                            @if ($item->type == 3)
                                                <div class="course-card card mb-5 shadow">

                                                    <div class="course-card-thumb position-relative">

                                                        <img src="{{ asset($item->book->feature_image) }}"
                                                            alt="{{ $item->book->book_name }}"
                                                            class="img-fluid w-100 rounded-3">

                                                        <span>

                                                            <input type="button" value="View Book"
                                                                class="btn btn-sm btn-primary position-absolute top-50 start-50 translate-middle d-none book-view-button fs-4"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#{{ $item->book->book_slug }}">

                                                            <a href="{{ route('book.singlePage', $item->book->id) }}"
                                                                class="btn btn-sm btn-primary position-absolute top-50 start-50 translate-middle d-none fs-4 book-view-mobile"
                                                                style="top: 34%;">

                                                                View

                                                            </a>

                                                        </span>

                                                    </div>

                                                    <div class="course-card-info">

                                                        <h4 class="text-center w-100 px-2">

                                                            {{ $item->book->book_name }}

                                                        </h4>

                                                    </div>



                                                    <!-- Modal start -->

                                                    <div class="book-modal">

                                                        <div class="modal modal-lg fade" id="{{ $item->book->book_slug }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">

                                                            <div class="modal-dialog modal-dialog-scrollable">

                                                                <div class="modal-content book-modal">

                                                                    <div class="modal-header">

                                                                        <h3 class="modal-title" id="exampleModalLabel">

                                                                            Book: "{{ $item->book->book_name }}"</h3>

                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>

                                                                    </div>

                                                                    <div class="modal-body">

                                                                        <embed
                                                                            src="{{ asset($item->book->file) }}#toolbar=0"
                                                                            type="application/pdf" width="100%"
                                                                            height="600px">



                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <!-- Modal end -->

                                                </div>
                                            @endif
                                        @endforeach

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @endif



            @if (in_array(4, $types))

                {{-- Content List  --}}

                <div class="journal-details">

                    <div class="journal-details-section">

                        <div class="d-flex justify-content-center flex-column gap-2 mt-5">

                            <div>

                                <h3 class="text-center fw-bold">Contents</h3>

                                <div class="bc-course-cards-wrapper">

                                    <div class="bc-course-card-row courses-row">

                                        {{-- Book item --}}

                                        @foreach ($bundle->bundle_items as $item)
                                            @if ($item->type == 4)
                                                <div class="course-card card mb-5 px-3 pb-3 shadow">

                                                    <div class="course-card-info flex-column flex-md-row">

                                                        <h4 class="first-letter-uppercase  text-hover">{{ $item->title }}

                                                        </h4>

                                                    </div>

                                                    <div class="text-center text-md-start">

                                                        <p class="text-center text-md-start">

                                                            {{ Illuminate\Support\Str::limit($item->sub_description, 60) }}

                                                        </p>

                                                        <a href="{{ route('single.bundle.content', $item->id) }}"
                                                            class="btn btn-primary btn-sm">See Details</a>

                                                    </div>

                                                </div>
                                            @endif
                                        @endforeach

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @endif



        </main>

        <!-- ./Dashboard Main Content :: End -->

    </div>



@endsection

{{-- Add Script --}}

@push('script')
@endpush
