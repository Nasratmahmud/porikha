@extends('frontend.layout.profile.master_layout')
@push('style')
    <style>
        input {
            color: var(--dashui-heading-color);
        }
    </style>
@endpush

@section('tab_section')
    <section class="user--edit--area user--padding">

        <div class="personal--deatils--area">

            {{-- profile info update form --}}

            <form class="deatils" method="POST" action="{{ route('userProfile.update') }}" enctype="multipart/form-data">

                @csrf

                <h3>Personal Deatils</h3>

                <div class="split--column">

                    <div class="input--group">

                        <label for="f-name">Full Name*</label>

                        <input type="text" id="l-name" name="name" value="{{ auth()->user()->name }}">

                    </div>

                </div>

                <div class="split--column">

                    <div class="input--group">

                        <label>Username</label>

                        <input class="text-gray-500" type="text" value="{{ auth()->user()->username }}" readonly>

                    </div>

                </div>

                <div class="split--column">

                    <div class="input--group">

                        <label>Email</label>

                        <input class="text-gray-500" type="text" value="{{ auth()->user()->email }}" readonly>

                    </div>

                </div>

                <div class="split--column">

                    <div class="input--group">

                        <label>Profile Picture</label>

                        <input style="border-radius: 0;" class="border-0 p-0" class="text-gray-500" type="file"
                            name="user_avatar" oninput="avatarPreview.src=window.URL.createObjectURL(this.files[0])">

                    </div>

                </div>

                <div class="d-flex flex-wrap gap-3 mt-5 justify-content-center justify-content-sm-start">

                    <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary">Cancel</a>

                    <button type="submit" class="btn btn-primary">Update Info</button>

                </div>

            </form>

            {{-- password change form  --}}

            <form class="change--password" method="POST" action="{{ route('userPassword.update') }}">

                @csrf

                <h3>Change Password</h3>

                <div class="input--group">

                    <label for="cur-pass">Current Password</label>

                    <input type="password" id="cur-pass" name="old_password">

                </div>

                <div class="input--group">

                    <label for="new-pass">New Password</label>

                    <input type="password" id="new-pass" name="new_password">

                </div>

                <div class="input--group">

                    <label for="con-pass">Confirm Password</label>

                    <input type="password" id="con-pass" name="confirm_password">

                </div>

                <div class="d-flex flex-wrap gap-3 mt-5 justify-content-center justify-content-sm-start">

                    <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary">Cancle</a>

                    <button type="submit" class="btn btn-primary">Update Password</button>

                </div>

            </form>

        </div>

    </section>
@endsection
