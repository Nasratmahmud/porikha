@extends('auth.layouts.app')

<!-- Title -->
@section('title','Reset Password')

<!-- Page Image -->
@section('auth_image')
    <img class="mx-auto d-block" src="{{ asset('dashboard/image/password_reset.jpg') }}" style="width: 80vh"/>
@endsection

@section('content')
<div class="container">
    <h3 class="text-primary text-primary text-uppercase fw-bold">{{ __('Reset Password') }}</h3>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="row mb-2">
            <label for="email" class="col-12 col-form-label">{{ __('Email Address') }}</label>
            <div class="col-12">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-2">
            <label for="password" class="col-12 col-form-label">{{ __('Password') }}</label>
            <div class="col-12">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-2">
            <label for="password-confirm" class="col-12 col-form-label">{{ __('Confirm Password') }}</label>
            <div class="col-12">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>
        <div class="row mb-0">
            <div class="col-6">
                <button type="submit" class="btn btn-primary">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
