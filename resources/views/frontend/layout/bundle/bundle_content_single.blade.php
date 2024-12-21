@extends('frontend.app')
<!-- Start:Title -->
@section('title', "$bundleContent->title")
<!-- End:Title -->
@push('style')
    <script src="{{ asset('backend/libs/toastr/toastr.css') }}"></script>
    <style>
        .techwave_fn_interactive_list.modern .title {
            font-size: 16px;
        }

        .section_home .section_left {
            padding: 93px 40px 80px;
            border-right: 1px solid var(--techwave-border-color);
            width: 100%;
        }

    </style>
@endpush



<!-- Start:Content -->

@section('content')

    <!-- Dashboard :: Left -> Start -->
    <div class="techwave_fn_home">
        <div class="section_home">
            <div class="section_left">

                <!-- Title Shortcode -->
                <div class="techwave_fn_title_holder">
                    <h1 class="title">{{ $bundleContent->title }}</h1>
                </div>

                <!-- !Title Shortcode -->

                <!-- Guide Details -->
                <div class="container guide-details">
                    <hr style="margin: 20px 0;">
                    <div class="description-wrapper">
                        <p>{{ $bundleContent->sub_description }}</p>
                        <p>{!! $bundleContent->description !!}</p>
                    </div>

                </div>
                <!-- !Guide Details -->

            </div>
        </div>
    </div>
@endsection
