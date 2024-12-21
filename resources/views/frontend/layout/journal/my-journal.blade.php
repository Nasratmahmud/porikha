@extends('frontend.app')



<!-- Start:Title -->

@section('title', 'Journals')

<!-- End:Title -->

@push('style')
    <style>
        .journals {
            padding: 20px 30px;
        }

        .dash-breadcrumb-tree {
            padding: 20px 30px 0;
        }

        @media only screen and (max-width: 650px) {
            .journals {
                padding: 20px 30px !important;
            }

            .dash-breadcrumb-tree {
                padding: 20px 30px 0;
            }
        }

        .journal-card-thumb img {
            height: 200px;
            object-fit: cover;
        }

        @media only screen and (min-width: 1800px) {
            .journal-card-thumb img {
                height: 240px !important;
            }
        }



        ul.journal-btn li:nth-child(2) {

            margin-left: 0;

        }



        .journal-btn li a:hover {

            color: #ffffff !important;

        }
    </style>
@endpush



<!-- Start:Content -->

@section('content')



    <!-- Dashboard :: Left -> Start -->

    <div class="app-content-area">

        <!-- ./Dashboard Main Content :: Start -->

        <main class="dashboard-content-wrapper">

            <!-- Dashboard Breadcrumb :: Start -->

            <section id="dash-breadcrumb" class="dash-breadcrumb-tree">

                <div class=""></div>

                <h3 class="dash-active-page ">My Journals</h3>

                <ul class="m-0 p-0">

                    <li class="d-inline-block"><a class="bg-transparent" href="{{ route('user.dashboard') }}">Dashboard</a>

                    </li>

                    <li class="d-inline-block"><i class="bi bi-chevron-right"></i></li>

                    <li class="d-inline-block">My Journals</li>

                </ul>

            </section>

            <!-- Dashboard Breadcrumb :: End -->

            <div class="journals m-0">

                <div class="d-flex mb-2">

                    <div class="d-flex me-3 journal-btns">

                        <ul class="p-0 m-0 d-flex align-items-center gap-2 flex-wrap journal-btn">

                            <li><a href="{{ route('journal.index') }}" class="btn btn-outline-primary">All Journals</a>

                            </li>

                            <li class="active"><a href="#" class="bg-primary me-0">My Journals</a></li>

                            <li><a href="{{ route('journal.create') }}"
                                    class="btn btn-outline-primary d-flex align-items-center"><i
                                        class="bi bi-pencil-square"></i> Write Journal</a></li>

                        </ul>

                    </div>

                </div>

                <div class="row course-wrap">

                    @forelse ($journals as $journal)
                        <div class="col-sm-6 col-lg-4 col-xl-3 mb-5 mt-2">

                            <div class="journal-card card h-100 pb-3">

                                <a class="bg-transparent"
                                    href="{{ route('single.journal', ['slug' => $journal->journal_slug]) }}">

                                    <div class="journal-card-thumb">

                                        <img class="thumbnail " style="border-radius: 0.5rem 0.5rem 0 0 !important;"
                                            src="{{ asset($journal->journal_featured_image) }}"
                                            alt="{{ $journal->journal_title }}">

                                        <span class="journal-icon">

                                            @if ($journal->journal_type == '1')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">

                                                    <path
                                                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484-.08.08-.162.158-.242.234-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z" />

                                                </svg>
                                            @else
                                                <i class="bi bi-lock-fill"></i>
                                            @endif

                                        </span>

                                    </div>

                                    <div class="journal-detail mb-3 text-hover">

                                        <h3 class="mb-0  ps-4">{{ Str::limit($journal->journal_title, 20, '...') }}</h3>

                                    </div>

                                </a>

                            </div>

                        </div>



                    @empty

                        <h1 class="text-danger p-5 h3 text-center">You havn't created any journal</h1>
                    @endforelse

                    <!-- pagination start  -->

                    @if ($journals->nextPageUrl() || $journals->previousPageUrl())

                        <nav>

                            <ul
                                class="pagination d-flex justify-content-center flex-wrap pagination-flat pagination-success">

                                <!-- Previous Page Link -->

                                @if ($journals->onFirstPage())
                                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">

                                        <span class="page-link" aria-hidden="true">&lsaquo;</span>

                                    </li>
                                @else
                                    <li class="page-item">

                                        <a class="page-link" href="{{ $journals->previousPageUrl() }}" rel="prev"
                                            aria-label="@lang('pagination.previous')">&lsaquo;</a>

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

                                        <a class="page-link" href="{{ $journals->nextPageUrl() }}" rel="next"
                                            aria-label="@lang('pagination.next')">&rsaquo;</a>

                                    </li>
                                @else
                                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">

                                        <span class="page-link" aria-hidden="true">&rsaquo;</span>

                                    </li>
                                @endif

                            </ul>

                        </nav>

                        <!-- pagination start  -->

                    @endif



                </div>

        </main>

        <!-- ./Dashboard Main Content :: End -->

    </div>

    <!-- Dashboard :: Left -> End -->







@endsection

<!-- Start:Script -->

@push('script')
    <script></script>
@endpush

<!-- End:Script -->
