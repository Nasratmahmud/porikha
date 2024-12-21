@extends('frontend.app')



<!-- Start:Title -->

@section('title', 'Course Checkout')

<!-- End:Title -->

@push('style')
    <style>
        .checkout-section a {

            color: #0b75f1 !important;

            text-decoration: none;

        }



        .StripeCardPayment {

            display: flex;
            border: 1px solid #00000030;
        }



        .StripeCardPayment .payment-user--card-number {

            width: 55%;



        }



        .StripeCardPayment .payment-card--valid {

            width: 45%;

            display: flex;

        }



        .StripeCardPayment .payment-user--card-number input,

        .StripeCardPayment .payment-card--valid input {

            border: 0px;
            /* border-radius: 0px 8px 8px 0px; */

        }



        .StripeCardPayment .payment-card--valid input {
            border-left: 1px solid #00000030;
        }



        .StripeCardPayment .payment-user--card-number input:focus,

        .StripeCardPayment .payment-card--valid input:focus {

            outline: none;



            box-shadow: none;

        }



        .checkout-details-section {

            width: 100%;

        }



        .checkout-filed-col {

            margin: 0 !important;

        }



        .payment-amount {

            margin-top: 1rem;

        }



        ul,

        ol {

            list-style: auto;

        }



        .course_enroll-video-thumb iframe {

            height: 520px;

        }



        @media only screen and (min-width: 361px) and (max-width: 479px) {

            .course_enroll-video-thumb iframe {

                height: 250px;

            }



            h5 {

                font-size: .8rem !important;

                font-weight: 500 !important;

            }

        }



        @media only screen and (min-width: 480px) and (max-width: 767px) {

            .course_enroll-video-thumb iframe {

                height: 350px;

            }

        }

        .course_content-list-item {

            align-items: flex-start !important;

        }

        .dash-breadcrumb-tree {
            padding: 20px 30px 0;
        }

        .form-control {
            border-radius: 0;
        }
    </style>
@endpush



<!-- Start:Content -->

@section('content')

    <div class="app-content-area">

        <!-- Dashboard :: Left -> Start -->

        <main class="dashboard-content-wrapper p-0">

            <div class="forum-details p-0">

                <!-- Dashboard Breadcrumb :: Start -->

                <section id="dash-breadcrumb" class="dash-breadcrumb-tree">

                    <div class=""></div>

                    <h3 class="dash-active-page course_enroll-title">Course Checkout</h3>

                    <ul class="m-0 p-0">

                        <li class="d-inline-block"><a class="bg-transparent"
                                href="{{ route('user.dashboard') }}">Dashboard</a></li>

                        <li class="d-inline-block"><i class="bi bi-chevron-right"></i></li>

                        <li class="d-inline-block">Course Checkout</li>

                    </ul>

                </section>



                @php
                    $bal = new \App\Models\CoinBalance();
                    $myBal = $bal->GetLastTransaction()->total;
                @endphp



                <!-- Dashboard Breadcrumb :: End -->

                <!-- Course Enroll : Start -->

                <div class="row justify-content-between" style="padding: 15px 30px;">

                    <div class="col-lg-6 col-xl-8 my-5 mt-lg-0">

                        <div class="course_enroll-left w-100">

                            <div class="course_enroll-details">

                                <div class="course_enroll-video-thumb">

                                    <iframe id="CourseThumbVideo" class="course-thumb-video" frameborder="0"
                                        allowfullscreen="1"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        title="FIRST DRIVE: Rolls-Royce Spectre – 576bhp, £330k Electric Masterpiece | Top Gear"
                                        width="100%" height="550" src="{{ $course->feature_video }}"></iframe>

                                </div>

                                <div class="course_details_info">

                                    <h3>Course Info</h3>

                                    <div class="course_details_widget">

                                        <h5 class="course_details_title">What Will You Learn?</h5>

                                        <div>

                                            {!! $course->summary !!}

                                        </div>

                                    </div>

                                </div>

                                <div class="course_accordion-item">

                                    <h3>Course Content</h3>

                                    <div>

                                        <h2 class="py-4 px-5 h5 fw-medium bg-gray-200">{{ $course->course_title }}</h2>

                                        <ul class="course_content-list ps-0">

                                            {{-- Loop all module  --}}

                                            @forelse ($course['course_modules'] as $key => $module)
                                                {{-- Module content total video length sum --}}
                                                @php
                                                    $totalTime = [];
                                                    foreach ($module['course_contents'] as $content) {
                                                        if ($module['id'] == $content['course_module_id']) {
                                                            $totalTime[] = $content['content_length'];
                                                        }
                                                    }
                                                @endphp
                                                <li class="course_content-list-item d-flex gap-2 justify-content-between">

                                                    <div class="d-flex align-items-center gap-2">

                                                        <h5 class="mb-0"><span
                                                                class="btn btn-sm btn-secondary me-2">{{ $key + 1 }}</span>

                                                            {{ $module['course_module_name'] }}

                                                        </h5>

                                                    </div>

                                                    <div class="course_item-time d-flex justify-content-end align-items-center"
                                                        style="min-width: 95px;">

                                                        <span>{{ App\Helper\Helper::addDurationsArray($totalTime) }}</span>

                                                        <i class="bi bi-lock fs-5"></i>

                                                    </div>

                                                </li>

                                            @empty
                                                <h1>not found</h1>
                                            @endforelse

                                        </ul>

                                    </div>

                                </div>



                            </div>

                        </div>

                    </div>

                    <div class="col-lg-6 col-xl-4 my-5 mt-lg-0 ">

                        <div class="course_enroll-right w-100 card">

                            <div class="course_enroll-card">
                                @if ($course->course_price > 0 && $course->course_price != null)
                                    <form class="course_purchase" action="{{ route('course.purchasing') }}" method="POST">
                                        <!-- Pricing Details section  -->
                                        <div
                                            class="checkout-filed-col checkout-field-col-30 checkout-details-section shadow-sm">
                                            @csrf
                                            <input type="hidden" name="stripeToken" id="stripeToken" value="">
                                            <div class="checkout-discount">
                                                <div class="d-flex justify-content-between payment-amount">
                                                    <p>Payable amount</p>
                                                    <p id="Payable_amount">$ <span
                                                            id="CourseBalance">{{ $course->course_price }}</span></p>
                                                    <input type="hidden" name="paying_amount" id="paying_amount"
                                                        value="{{ $course->course_price }}" readonly>
                                                </div>

                                                <div class="col-12 m-0">

                                                    <div id="stripe-button-container"
                                                        class="StripeElement StripeElement--empty">

                                                        <div class="StripeCardPayment">

                                                            <div class="payment-user--card-number">

                                                                <input type="text" name="name" id="card-number"
                                                                    class="card-number form-control" pattern="[0-9.]+"
                                                                    placeholder="4242 4242 4242 4242" required="">

                                                            </div>

                                                            <input type="hidden" name="course_id"
                                                                value="{{ $course->id }}" readonly>

                                                            <div class="payment-card--valid">

                                                                <div class="payment-card--expiry">

                                                                    <input type="text" name="Card Expiration Date"
                                                                        id="card--expiry--date"
                                                                        class="card-expiry form-control" placeholder="01/25"
                                                                        minlength="5" maxlength="5">

                                                                </div>

                                                                <div class="payment-card--expiry">

                                                                    <input type="text" name="Card CVC" id="card--CVC"
                                                                        class="card-CVC form-control " placeholder="123"
                                                                        maxlength="3" minlength="3">

                                                                </div>

                                                            </div>



                                                        </div>

                                                    </div>

                                                </div>

                                                {{-- @if ($mainBalance < 0) --}}

                                                <div class="form-check d-flex align-items-center">

                                                    <input class=" me-2 p-3" name="useBalance" type="checkbox"
                                                        value="1" id="useMyBalance" />

                                                    <label class="form-check-label" for="useMyBalance">I want to use my

                                                        balance ({{ $myBal }} $)</label>

                                                </div>

                                                {{-- @endif --}}

                                            </div>

                                        </div>

                                        <!-- Pricing Details section end  -->



                                        <div class="course_enroll_body bg-transparent">

                                            <div class="course_enroll_dtn">

                                                <button type="submit" class="btn btn-primary form-control"> Enroll
                                                    now</button>

                                            </div>

                                        </div>

                                    </form>
                                @else
                                    <form action="{{ route('course.purchasing') }}" method="POST">
                                        <!-- Pricing Details section  -->
                                        <div
                                            class="checkout-filed-col checkout-field-col-30 checkout-details-section shadow-sm">
                                            @csrf
                                            <div class="checkout-discount">
                                                <div class="d-flex justify-content-between payment-amount">
                                                    <p>Payable amount</p>
                                                    <p id="Payable_amount">$ <span
                                                            id="CourseBalance">{{ $course->course_price }}</span></p>
                                                    <input type="hidden" name="course_id" value="{{ $course->id }}"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="course_enroll_body bg-transparent">
                                            <div class="course_enroll_dtn">
                                                <button type="submit" class="btn btn-primary form-control"> Free Enroll
                                                    now</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                                <div>
                                    <p><b>Level</b>{{ $course->level }}</p>
                                    @php
                                        [$hours, $minutes, $seconds] = explode(':', $course->duration);
                                    @endphp
                                    <p><b>Duration</b>{{ $hours . ' hours ' . $minutes . ' Minutes' }}</p>
                                    <p><b>Last Update</b>{{ Carbon\Carbon::parse($course->last_date)->format('M d, Y') }}
                                    </p>
                                </div>
                                <div class="course-overview">

                                    <ul class="course_short-overview  p-0 m-0">

                                        <li class="course_short-overview-item">

                                            <div class="course_short-overview-title">

                                                <i class="bi bi-reception-4"></i>

                                                <h6>Level</h6>

                                            </div>

                                            <div class="course_short-overview-detail">

                                                <p class="course_level m-0">{{ $course->level }}</p>

                                            </div>

                                        </li>

                                        <li class="course_short-overview-item">

                                            <div class="course_short-overview-title">

                                                <i class="bi bi-clock-fill"></i>

                                                <h6>Duration</h6>

                                            </div>

                                            <div class="course_short-overview-detail">

                                                <ul class="course_duration m-0 p-0">

                                                    @php
                                                        [$hours, $minutes, $seconds] = explode(':', $course->duration);
                                                    @endphp

                                                    <li class="course_duration-hour d-inline-block">

                                                        {{ $hours }} <span>Hour</span></li>

                                                    <li class="course_duration-hour d-inline-block">

                                                        {{ $minutes }} <span>Minutes</span></li>

                                                </ul>

                                            </div>

                                        </li>

                                        <li class="course_short-overview-item">

                                            <div class="course_short-overview-title">

                                                <i class="bi bi-repeat"></i>

                                                <h6>Last Update</h6>

                                            </div>

                                            <div class="course_short-overview-detail">

                                                <p class="mb-0">

                                                    {{ Carbon\Carbon::parse($course->last_date)->format('M d, Y') }}</p>

                                            </div>

                                        </li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Course Enroll : End -->

            </div>

        </main>

        <!-- Dashboard :: Left -> End -->

    </div>

@endsection

<!-- Start:Script -->

@push('script')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        $('#useMyBalance').change(function() {

            let myBal = {{ $myBal }};

            let courseBalance = $('#CourseBalance').html();

            if ($(this).is(':checked')) {

                if (myBal > {{ $course->course_price }}) {

                    $('#card-number').attr('disabled', 'disabled');

                    $('#card--expiry--date').attr('disabled', 'disabled');

                    $('#card--CVC').attr('disabled', 'disabled');

                    $('#CourseBalance').html(00)

                } else {

                    courseBalance -= myBal;

                    $('#CourseBalance').html(courseBalance)

                }

            } else {

                $('#card-number').removeAttr("disabled")

                $('#card--expiry--date').removeAttr("disabled")

                $('#card--CVC').removeAttr("disabled")

                courseBalance = parseFloat(courseBalance) + parseFloat(myBal);

                $('#CourseBalance').text({{ $course->course_price }})

            }

        });
    </script>
    <script type="text/javascript">
        $(function() {
            var $form = $(".course_purchase");
            $form.submit(function(event) {
                event.preventDefault();
                Stripe.setPublishableKey("pk_test_TYooMQauvdEDq54NiTphI7jx");

                // Get the card expiration date (MM/YY) from the input field
                var cardExpiry = $('.card-expiry').val().split('/');

                Stripe.card.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-CVC').val(),
                    exp_month: cardExpiry[0], // Extract the month part
                    exp_year: cardExpiry[1] // Extract the year part
                }, function(status, response) {
                    if (response.error) {
                        // Handle errors, display error messages, etc.
                        toastr.error(response.error.message, "Stripe Error");
                    } else {
                        // Token successfully created, set it in the hidden input field
                        $("#stripeToken").val(response.id);
                        // Now, submit the form to your server
                        $form.get(0).submit();
                    }
                });
            });
        });
    </script>
@endpush

<!-- End:Script -->
