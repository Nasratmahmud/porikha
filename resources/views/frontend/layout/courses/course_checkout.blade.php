@extends('frontend.app')
<!-- Title -->
@section('title', $course->course_title)
@push('style')
    <style>
        .section_home .section_right {
            padding: 0;
        }

        .section_home .section_left {
            padding-top: 24px;
        }

        #CourseVideo {
            height: 500px;
        }

        @media screen and (max-width:768px) {
            #CourseVideo {
                height: 320px;
            }
        }

        .techwave_fn_interactive_list .item:hover {
            border-color: transparent;
        }

        .techwave_fn_interactive_list li {
            margin-bottom: 10px;
        }

        .module_total_duration {
            color: var(--techwave-heading-color);
        }

        .content-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .content-item:last-child {
            margin-bottom: 0;
        }

        .content-item div {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .content-item div p {
            margin-bottom: 0;
        }

        .techwave_fn_button {
            margin-top: 16px;
        }

        .techwave_fn_button,
        .techwave_fn_button:after {
            border-radius: 12px;
        }

        .techwave_fn_interactive_list.modern {
            max-width: 100%;
            margin: 0;
        }

        .techwave_fn_title_holder {
            text-align: left;
        }

        .section_home .section_right {
            padding: 24px 20px 80px;
        }

        input[type=text] {
            min-width: auto;
            vertical-align: middle;
            border-radius: 0;
            border: none;
            border-right: 2px solid var(--techwave-border-color);
        }

        input[type=text]:last-child {
            border-radius: 0 10px 10px 0;
        }

        .card {
            background-color: var(--techwave-site-bg-color);
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            -o-border-radius: 10px;
            -ms-border-radius: 10px;
            border-radius: 10px;
            padding: 24px;
            border: 1px solid #B5B5C3;
            transition: all 0.2s ease-out 0s;
        }

        button.techwave_fn_button {
            border: none;
            cursor: pointer;
        }
    </style>
@endpush

{{-- Main Content --}}
@section('content')
    @php
        $bal = new \App\Models\CoinBalance();
        $myBal = $bal->GetLastTransaction()->total;
    @endphp
    <div class="techwave_fn_home">
        <div class="section_home">
            <div class="section_left">
                <!-- Title Shortcode -->
                <div class="techwave_fn_title_holder">
                    <h1 class="title">{{ $course->course_title }}</h1>
                </div>
                <!-- !Title Shortcode -->
                <!-- Video Player -->
                <div>
                    <iframe id="CourseVideo" class="course-thumb-video" frameborder="0" allowfullscreen="1" allow="autoplay;"
                        title="FIRST DRIVE: Rolls-Royce Spectre – 576bhp, £330k Electric Masterpiece | Top Gear"
                        width="100%" height="100%"
                        src="{{ $course->feature_video }}"></iframe>
                    <div style="margin-top: 24px;">
                        {!! $course->summary !!}
                    </div>
                </div>
                <!-- Video Player -->
                <div class="techwave_fn_interactive_list modern">
                    <ul>
                        @forelse ($course['course_modules'] as $key => $module)
                            {{-- Module content total video length sum --}}

                            <li>
                                <div class="item">
                                    <a href="javascript:void(0)"
                                        style="display: flex;align-items:center;justify-content:space-between;padding: 26px 30px;">
                                        <h2 class="title">{{ $key + 1 }}:
                                            {{ Str::limit($module['course_module_name'], 32, '...') }}</h2>
                                        <div
                                            style="display: flex;align-items:center;justify-content:space-between;gap:5px;">
                                            {{-- Module total content video length summing --}}
                                            @php
                                                $totalTime = [];
                                                foreach ($module['course_contents'] as $content) {
                                                    if ($module['id'] == $content['course_module_id']) {
                                                        if (1 == $content['status']) {
                                                            $totalTime[] = $content['content_length'];
                                                        }
                                                    }
                                                }
                                            @endphp
                                            <span
                                                class="module_total_duration">{{ App\Helper\Helper::addDurationsArray($totalTime) }}</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24"
                                                x="0" y="0" viewBox="0 0 32 32"
                                                style="enable-background:new 0 0 512 512;margin-top:-5px;"
                                                xml:space="preserve">
                                                <g>
                                                    <path
                                                        d="M23.15 11.27H11.29V8.75a4.754 4.754 0 0 1 9.13-1.85c.22.51.8.75 1.31.53.51-.21.75-.8.53-1.31A6.746 6.746 0 0 0 16.04 2c-3.72 0-6.75 3.03-6.75 6.75v2.52h-.44c-2.21 0-4 1.79-4 4V26c0 2.21 1.79 4 4 4h14.3c2.21 0 4-1.79 4-4V15.27c0-2.2-1.79-4-4-4zm2 14.73c0 1.1-.9 2-2 2H8.85c-1.1 0-2-.9-2-2V15.27c0-1.1.9-2 2-2h14.3c1.1 0 2 .9 2 2zm-7.35-5.65c0 .62-.32 1.18-.8 1.5v2.45c0 .55-.45 1-1 1s-1-.45-1-1v-2.45c-.48-.32-.8-.88-.8-1.5a1.799 1.799 0 1 1 3.6 0z"
                                                        fill="var(--techwave-heading-color)" opacity="1"
                                                        data-original="var(--techwave-heading-color)">
                                                    </path>
                                                </g>
                                            </svg>
                                        </div>


                                    </a>
                                </div>
                            </li>

                        @empty
                            <h1>not found</h1>
                        @endforelse
                    </ul>
                </div>

            </div>
            <div class="section_right">
                @if ($course->course_price > 0 && $course->course_price != null)
                    <div class="card">
                        <form action="{{ route('course.purchasing') }}" method="POST" class="contact_form"
                            autocomplete="off">
                            @csrf
                            <div
                                style="display: flex;justify-content:space-between;align-items:center;margin-bottom: 16px;">
                                <h3 style="margin-bottom: 0;">Payable amount</h3>
                                <p id="Payable_amount"
                                    style="margin-bottom: 0;font-weight:600;color:var(--techwave-main-color);font-size:20px;">
                                    $ <span id="CourseBalance">{{ $course->course_price }}</span></p>
                            </div>
                            <div class="input_list">
                                <input type="hidden" name="stripeToken" id="stripeToken" value="">
                                <input type="hidden" name="paying_amount" id="paying_amount"
                                    value="{{ $course->course_price }}" readonly>
                                <input type="hidden" name="course_id" value="{{ $course->id }}" readonly>

                                <div
                                    style="display: flex;border:2px solid var(--techwave-border-color);border-right:none;border-radius:10px;">
                                    <input class="card-number" style="width: 60%;" type="text" name="name"
                                        id="card-number" pattern="[0-9.]+" placeholder="4242 4242 4242 4242" required="">
                                    <input style="width: 20%;" type="text" name="Card Expiration Date"
                                        id="card--expiry--date" placeholder="01/25" minlength="5" maxlength="5"
                                        class="card-expiry">
                                    <input style="width: 20%;" type="text" name="Card CVC" id="card--CVC"
                                        class="card-CVC" placeholder="123" maxlength="3" minlength="3">
                                </div>


                                <div style="margin-top: 12px;">
                                    <input name="useBalance" type="checkbox" value="1" id="useMyBalance" />
                                    <label class="form-check-label" for="useMyBalance">I want to use my
                                        balance (${{ $myBal }})</label>
                                </div>
                                <button type="submit" class="techwave_fn_button">Enroll
                                    now</button>
                                <div style="margin-top: 24px;">
                                    <p style="display: flex;justify-content:space-between;margin-bottom:4px;">
                                        <b>Level:</b><span>{{ $course->level }}</span>
                                    </p>
                                    @php
                                        [$hours, $minutes, $seconds] = explode(':', $course->duration);
                                    @endphp
                                    <p style="display: flex;justify-content:space-between;margin-bottom:4px;">
                                        <b>Duration:</b><span>{{ ($hours <= 0 ? '' : $hours . ' hours ') . $minutes . ' Minutes' }}</span>
                                    </p>
                                    <p style="display: flex;justify-content:space-between;margin-bottom:4px;"><b>Last
                                            Update:</b><span>{{ Carbon\Carbon::parse($course->last_date)->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="card">
                        <form action="{{ route('course.purchasing') }}" method="POST" autocomplete="off">
                            @csrf
                            <div
                                style="display: flex;justify-content:space-between;align-items:center;margin-bottom: 16px;">
                                <h3 style="margin-bottom: 0;">Payable amount</h3>
                                <p id="Payable_amount"
                                    style="margin-bottom: 0;font-weight:600;color:var(--techwave-main-color);font-size:20px;">
                                    $ <span id="CourseBalance">{{ $course->course_price }}</span></p>
                                <input type="hidden" name="course_id" value="{{ $course->id }}" readonly>
                            </div>
                            <div class="input_list">
                                <button type="submit" class="techwave_fn_button">Free Enroll
                                    now</button>
                                <div style="margin-top: 24px;">
                                    <p style="display: flex;justify-content:space-between;margin-bottom:4px;">
                                        <b>Level:</b><span>{{ $course->level }}</span>
                                    </p>
                                    @php
                                        [$hours, $minutes, $seconds] = explode(':', $course->duration);
                                    @endphp
                                    <p style="display: flex;justify-content:space-between;margin-bottom:4px;">
                                        <b>Duration:</b><span>{{ ($hours <= 0 ? '' : $hours . ' hours ') . $minutes . ' Minutes' }}</span>
                                    </p>
                                    <p style="display: flex;justify-content:space-between;margin-bottom:4px;"><b>Last
                                            Update:</b><span>{{ Carbon\Carbon::parse($course->last_date)->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

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
            var $form = $(".contact_form");
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
