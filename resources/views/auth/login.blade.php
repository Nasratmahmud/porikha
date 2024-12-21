@extends('auth.layouts.app')

<!-- Start:Title -->
@section('title', 'Login')
<!-- End:Title -->


<!-- Start:Content -->
@section('content')

    <div class="login-form">

        <!-- login page background -->
        <div class="login-bg" style="background-image: url({{ asset('frontend/images/login-bg.png') }})">
            {{-- <img height="170" src="{{ asset('uploads/setting/default/logo.png') }}" alt="" class=""> --}}
        </div>


        <!-- login form  -->
        <form class="shadow" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <h2>Welcome To Login Page</h2>
                <p>Login to Continue</p>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" placeholder="Enter Your Email" value="{{ old('email') }}" required autocomplete="email"
                    autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    placeholder="Enter Your Password" name="password" required autocomplete="current-password">
                <button class="btn position-absolute top-50 end-0 border-0 toggle-password">
                    <i class="bi bi-eye"></i>
                </button>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3 p-0 form-check d-flex justify-content-between align-items-center">
                {{-- <a href="" class="text-decoration-none">Forgot password?</a> --}}
                <button type="submit" class="btn btn-primary btn-submit">Submit</button>
            </div>
        </form>
    </div>
@endsection
