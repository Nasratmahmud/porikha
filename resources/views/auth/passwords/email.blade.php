@extends('auth.layouts.app')
<!-- Title -->
@section('title','Forgot Password')

<!-- Page Image -->
@section('auth_image')
    <img class="mx-auto d-block" src="{{ asset('dashboard/image/password_reset.jpg') }}" style="width: 80vh"/>
@endsection


@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h4 class="text-primary text-primary text-uppercase fw-bold">{{ __('Reset Password') }}</h4>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="row mb-4">
            <label for="email" class="col-md-12 col-form-label">{{ __('Email Address') }}</label>
            <div class="col-md-12">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
