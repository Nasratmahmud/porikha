@extends('auth.layouts.app')

<!-- Title -->
@section('title','Confirm Password')

<!-- Page Image -->
@section('auth_image')
    <img class="mx-auto d-block" src="{{ asset('dashboard/image/password_reset.jpg') }}" style="width: 80vh"/>
@endsection


@section('content')
<div class="container">
    <h3 class="text-primary text-primary text-uppercase fw-bold mb-3">{{ __('Confirm Password') }}</h3>
    {{ __('Please confirm your password before continuing.') }}
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="row mb-3">
            <label for="password" class="col-12 col-form-label">{{ __('Password') }}</label>
            <div class="col-12">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-8">
                <button type="submit" class="btn btn-primary">
                    {{ __('Confirm Password') }}
                </button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection
