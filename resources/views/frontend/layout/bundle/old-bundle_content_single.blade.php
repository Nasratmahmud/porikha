@extends('frontend.app')



<!-- Start:Title -->

@section('title', "$bundleContent->title")

<!-- End:Title -->

@push('style')
    <style>
        .journal-details-section {

            height: auto;

        }



        .first-letter-uppercase::first-letter {

            text-transform: capitalize;

        }

        .dash-breadcrumb-tree {
            padding: 20px 30px 0;
        }

        @media only screen and (max-width: 650px) {
            .journal-details {
                padding: 20px 30px !important;
            }

            .dash-breadcrumb-tree {
                padding: 20px 30px 0 !important;
            }
        }
    </style>
@endpush



<!-- Start:Content -->

@section('content')

    <!-- Dashboard :: Left -> Start -->

    <div class="app-content-area">

        <!-- ./Dashboard Main Content :: Start -->

        <main class="dashboard-content-wrapper p-0">

            <!-- Dashboard Breadcrumb :: Start -->

            <section id="dash-breadcrumb" class="dash-breadcrumb-tree">

                <div class=""></div>

                <h3 class="dash-active-page fw-bold ">{{ $bundleContent->title }}</h3>

                <ul class="m-0 p-0">

                    <li class="d-inline-block"><a class="bg-transparent" href="{{ route('user.dashboard') }}">Dashboard</a>

                    </li>

                    <li class="d-inline-block"><i class="bi bi-chevron-right"></i></li>

                    <li class="d-inline-block">{{ $bundleContent->title }}</li>

                </ul>

            </section>

            <!-- Dashboard Breadcrumb :: End -->

            <div class="journal-details bg-transparent">

                <div class="journal-details-section">

                    <div class="d-flex justify-content-between">

                        <h3 class="first-letter-uppercase text-center text-md-start">

                            {{ $bundleContent->title }}

                        </h3>

                    </div>

                    <p class="mt-0">{{ $bundleContent->sub_description }}</p>

                    <p>

                        {!! $bundleContent->description !!}

                    </p>

                </div>



            </div>

        </main>

        <!-- ./Dashboard Main Content :: End -->

    </div>

    <!-- Dashboard :: Left -> End -->







@endsection

<!-- Start:Script -->

@push('script')
@endpush

<!-- End:Script -->
