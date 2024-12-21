@extends('auth.layouts.app')

<!-- Title -->
@section('title','Verify Email')

<!-- Page Image -->
@section('auth_image')
    <img class="mx-auto d-block" src="{{ asset('dashboard/image/password_reset.jpg') }}" style="width: 80vh"/>
@endsection

@section('content')
<div class="container">
    <h3 class="text-primary text-primary text-uppercase fw-bold mb-3">{{ __('Verify Your Email Address') }}</h3>
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }},
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
            {{ __('click here to request another') }}
        </button>
    </form>
</div>
@endsection
