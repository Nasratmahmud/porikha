@extends('auth.layouts.app')

<!-- Start:Title -->
@section('title', 'Register')
<!-- End:Title -->



@push('css_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <style>
        .checkout-section a {
            color: #0b75f1 !important;
            text-decoration: none;
        }

        .StripeCardPayment {
            display: flex;
            border: 1px solid #00000030;
            border-radius: 8px;
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
        }

        .StripeCardPayment .payment-card--valid input {
            border-left: 1px solid #00000030;
            border-radius: 0px 8px 8px 0px;
        }

        .StripeCardPayment .payment-user--card-number input:focus,
        .StripeCardPayment .payment-card--valid input:focus {
            outline: none;

            box-shadow: none;
        }
    </style>
@endpush


<!-- Start:Content -->
@section('content')
    <div class="checkout-body">

        <div class="checkout-section">

            <!-- title section  start-->
            <div class="checkbox-head">
                <h2 class="checkout-title"> Checkout </h2>
                <p class="checkout-breadcrumbs"><a href="{{ route('home') }}"> Home ></a> Checkout</p>
            </div>


            <form class="course_purchase" method="POST" action="{{ route('register') }}">
                @csrf

                <input type="hidden" name="stripeToken" id="stripeToken" value="">

                <!-- title section  end-->
                <div class="checkout-wrapper">
                    <!-- Billing Details form start -->
                    <div class="checkout-filed-col checkout-field-col-70 checkout-billing-form shadow-sm">
                        <h2>Billing Details</h2>
                        <!-- Billing form -->
                        <div class="row">

                            <div class="col-md-6">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                    id="full_name" name="full_name" value="{{ old('full_name') }}" required
                                    autocomplete="full_name" autofocus>
                                @error('full_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="user-name" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="user-name" name="username" value="{{ old('username') }}" required
                                    autocomplete="username" autofocus>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="col-md-6">
                                <label for="phone-number" class="form-label">Phone number</label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                    id="phone-number" name="phone_number" value="{{ old('phone_number') }}" required
                                    autocomplete="phone_number" autofocus>
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label ">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm-password"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <hr />

                            <div class="col-12 m-0">
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label checkout-form-check-label" for="gridCheck">
                                        I agree to the <a href="http://"> Terms of Use, Refund Policy</a> and <a
                                            href="http://">Privacy Policy</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Billing Details form end -->

                    <!-- Pricing Details section  -->
                    <div class="checkout-filed-col checkout-field-col-30 checkout-details-section shadow-sm">
                        <h2>Pricing Details</h2>
                        <hr />
                        <div class="checkout-information">
                            <div>
                                <h6>Information</h6>
                                <p>Package Name: <strong>Premium</strong></p>
                                <p>For : <span>lifetime</span> </p>
                                <p>Price : <span>$90</span></p>
                            </div>
                        </div>
                        <hr />
                        <div class="checkout-discount">
                            <div class="d-flex justify-content-between mt-4 main-price">
                                <p>Price</p>
                                <p>90$</p>
                            </div>
                            <div class="d-flex justify-content-between gap-3">
                                <input type="text" class="form-control" id="promo_code" placeholder="Discount code">
                                <button type="button" class="btn btn-primary mb-3 promo_code_apply">Apply</button>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <p>Discount</p>
                                <p class="form-label text-danger discount_amount">- 0%</p>
                            </div>
                            <hr />




                            <div class="d-flex justify-content-between payment-amount">
                                <p>Payable amount</p>
                                <p id="Payable_amount">$90</p>
                                <input type="hidden" name="paying_amount" id="paying_amount" value="90">
                            </div>
                            <div class="col-12 m-0">
                                <div id="stripe-button-container" class="StripeElement StripeElement--empty">
                                    <div class="StripeCardPayment">
                                        <div class="payment-user--card-number">
                                            <input type="text" name="name" id="card-number"
                                                class="card-number form-control" pattern="[0-9.]+"
                                                placeholder="4242 4242 4242 4242" required="">
                                        </div>
                                        <div class="payment-card--valid">
                                            <div class="payment-card--expiry">
                                                <input type="text" name="Card Expiration Date" id="card--expiry--date"
                                                    class="card-expiry form-control" placeholder="01/25" minlength="5"
                                                    maxlength="5">
                                            </div>
                                            <div class="payment-card--expiry">
                                                <input type="text" name="Card CVC" id="card--CVC"
                                                    class="card-CVC form-control " placeholder="123" maxlength="3"
                                                    minlength="3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="pay-btn">Pay Now</button>
                        </div>
                    </div>
                    <!-- Pricing Details section end  -->

                </div>
            </form>


        </div>

    </div>
@endsection

@push('script')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 10000;
            toastr.options.positionClass = 'toast-top-right'; // Set the position to top right

            @if (Session::has('t-success'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                };
                toastr.success("{{ session('t-success') }}");
            @endif

            @if (Session::has('t-error'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                };
                toastr.error("{{ session('t-error') }}");
            @endif

            @if (Session::has('t-info'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                };
                toastr.info("{{ session('t-info') }}");
            @endif

            @if (Session::has('t-warning'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                };
                toastr.warning("{{ session('t-warning') }}");
            @endif
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

    <script>
        // Check the promo-code and if promo-code is valide then update the amount
        $('.promo_code_apply').click(function() {
            let promoCode = $('#promo_code').val();

            // Get CSRF token value from the meta tag
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            var url = '{{ route('promo.code.discount') }}';

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    promo_code: promoCode,
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token in the headers
                },
                success: function(resp) {
                    if (resp.success === true) {
                        if (resp.data !== null) {
                            $('.discount_amount').text('- ' + resp.data.discount_percentage + '%');

                            let discount = 90 * parseFloat(resp.data.discount_percentage) / 100;

                            var amount = 90 - discount;
                            console.log(amount);

                            // Insert the updated paying value into the text content
                            $('#Payable_amount').text('$' + amount);

                            // Set the value of the input field
                            $('#paying_amount').val(amount);

                        }
                    } else if (resp.success === false) {
                        $('.discount_amount').text('-$0.00');
                        $('#Payable_amount').text('$90');
                        toastr.error(resp.message);
                    } else {
                        toastr.error(resp.message);
                    }
                }, // success end
                error: function(error) {
                    toastr.error('Something Wrong...');
                } // Error
            })


        })
    </script>
@endpush
