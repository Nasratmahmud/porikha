@extends('frontend.app')
<!-- Title -->
@section('title', 'Change Password')
@push('style')
    <style>
        .techwave_fn_user_settings .settings_right {
            max-width: 100%;
            width: 100%;
        }
    </style>
@endpush

{{-- Main Content --}}
@section('content')
    <div class="techwave_fn_user_profile_page">
        <!-- Page Title -->
        <div class="techwave_fn_pagetitle">
            <h2 class="title">Change Password</h2>
        </div>
        <!-- !Page Title -->
        <div class="container small">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p style="text-align: center;color:red;margin-top:12px;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div class="techwave_fn_user_settings">
                <form method="POST" action="{{ route('userPassword.update') }}">
                    @csrf
                    <div class="user__settings">
                        <div class="settings_right">
                            <div class="item">
                                <label class="input_label" for="password">Current Password</label>
                                <div class="input_item">
                                    <input class="input" type="password" id="password" name="old_password">
                                </div>
                            </div>
                            <div class="item">
                                <label class="input_label" for="new_password">New Password</label>
                                <div class="input_item">
                                    <input class="input" type="password" id="new_password" name="new_password">
                                </div>
                            </div>
                            <div class="item">
                                <label class="input_label" for="confirm_password">Confirm Password</label>
                                <div class="input_item">
                                    <input class="input" type="password" id="confirm_password" name="confirm_password">
                                </div>
                            </div>
                            <div class="item">
                                <label class="fn__submit">
                                    <input type="submit" value="Save Changes">
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
