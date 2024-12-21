@extends('frontend.app')
<!-- Title -->
@section('title', 'Edit Profile')

{{-- Main Content --}}
@section('content')
    <div class="techwave_fn_user_profile_page">
        <!-- Page Title -->
        <div class="techwave_fn_pagetitle">
            <h2 class="title">Settings</h2>
        </div>
        <!-- !Page Title -->

        <div class="container small">
            <div class="techwave_fn_user_settings">
                <form method="POST" action="{{ route('userProfile.update') }}" enctype="multipart/form-data"
                    id="profile_update_form">
                    @csrf
                    <div class="user__settings">
                        <div class="settings_left">

                            <!-- Upload Shortcode -->
                            <label class="fn__upload">
                                <span class="upload_content">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 383.5 271.6"
                                        style="enable-background:new 0 0 383.5 271.6;" xml:space="preserve"
                                        class="fn__svg replaced-svg">
                                        <g>
                                            <path
                                                d="M383.5,183.2c-0.9,4.3-1.5,8.6-2.6,12.7c-9.2,34.7-39.5,58.6-75.5,59.5c-11.1,0.3-22.2,0.2-33.3,0.1   c-7.7-0.1-13.8-4.8-15.7-11.5c-1.9-6.7,0.6-14.1,6.6-17.6c2.8-1.6,6.3-2.6,9.5-2.7c10.6-0.3,21.2-0.1,31.8-0.2   c25.9-0.1,47.1-21.5,47.2-47.7c0.1-26.1-20.8-47.7-46.8-48.1c-11-0.2-16.2-4.9-18.4-15.6c-8-40.3-31.7-66.6-71.3-77.2   c-43-11.5-88.3,9.5-108.3,49.2c-3.9,7.8-9.4,11.5-18,12.2c-28.7,2.3-53.7,27.8-56.1,56.8c-2.8,33.8,18.7,62.9,51.8,69.1   c8.7,1.6,17.9,1,26.8,1.3c8.4,0.2,14.8,5,16.4,12.5c2,9.3-3.9,18.4-13.5,19.2c-31,2.5-59.9-3-83.1-25.5   C3.1,203-6.4,170.2,4.3,133.1c10.6-36.7,36.2-58.9,73.5-67.5c1.6-0.4,3.3-1.7,4.1-3.1c20.7-33.3,50.2-53.8,88.9-60.7   C234-9.3,297.2,30.4,314.5,92.3c0.9,3.2,2.2,4.7,5.7,5.5c33.7,7.3,58,33.7,62.6,68c0.1,0.8,0.4,1.7,0.7,2.5   C383.5,173.2,383.5,178.2,383.5,183.2z">
                                            </path>
                                            <path
                                                d="M176,166.6c-1.5,1.4-2.4,2.1-3.3,3c-5.7,5.6-11.2,11.3-16.9,16.9c-6.9,6.7-16.7,6.9-23.1,0.5c-6.4-6.4-6.2-16.3,0.6-23.1   c15.6-15.7,31.2-31.3,46.8-46.8c7.1-7.1,16.5-7.1,23.6,0c15.7,15.5,31.3,31.1,46.8,46.8c6.8,6.8,6.9,16.7,0.6,23.1   c-6.3,6.4-16.2,6.3-23.1-0.4c-5.7-5.6-11.3-11.3-16.9-16.9c-0.8-0.8-1.7-1.6-3.3-3c0,2.2,0,3.5,0,4.8c0,27.7,0,55.4,0,83   c0,8.1-4,14-10.7,16.3c-10.5,3.6-20.9-4-21-15.5c-0.1-18.6,0-37.2,0-55.7c0-9.5,0-19,0-28.4C176,169.9,176,168.7,176,166.6z">
                                            </path>
                                        </g>
                                    </svg>
                                    <span class="title">Drag &amp; Drop a Image</span>
                                    <span class="fn__lined_text">
                                        <span class="line"></span>
                                        <span class="text">Or</span>
                                        <span class="line"></span>
                                    </span>
                                    <span class="title">Browse</span>
                                    <span class="desc">Supports JPG, JPEG, and PNG</span>
                                </span>
                                <span class="upload_preview">
                                    <a href="#" class="fn__closer fn__icon_button">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 383.3 383.3"
                                            style="enable-background:new 0 0 383.3 383.3;" xml:space="preserve"
                                            class="fn__svg replaced-svg">
                                            <g>
                                                <path
                                                    d="M15,383.3c-1.1-0.5-2.2-1-3.3-1.4C0.2,377.1-3.6,362.9,4,353.1c1.1-1.5,2.5-2.8,3.8-4.1c51.3-51.3,102.7-102.7,154-154   c1-1,2.4-1.7,3.9-2.7c-1.8-1.9-2.8-3-3.8-4C110.1,136.6,58.5,84.9,6.8,33.3c-5.2-5.2-7.9-11.2-6.3-18.5C3.7,0.7,20.2-4.7,31.1,4.7   c1.2,1.1,2.3,2.2,3.5,3.4C85.7,59.3,136.9,110.4,188,161.6c1.1,1.1,2,2.3,3.2,3.8c1.4-1.3,2.5-2.3,3.5-3.3   C246.4,110.3,298.1,58.7,349.8,7c6-6,12.7-8.6,21-5.8c6.7,2.2,10.2,7.5,12.5,13.9c0,2.5,0,5,0,7.5c-1.8,5.6-5.6,9.8-9.7,13.8   C322.8,87,272.1,137.7,221.3,188.4c-1,1-2,2.1-3.4,3.5c1.4,1.2,2.6,2.1,3.7,3.2c50.5,50.5,101.1,101.1,151.7,151.6   c4.2,4.2,8.1,8.4,10,14.1c0,2.5,0,5,0,7.5c-2.4,7.6-7.4,12.6-15,15c-2.5,0-5,0-7.5,0c-5.6-1.8-9.7-5.7-13.8-9.7   c-50.7-50.8-101.4-101.5-152.1-152.2c-1-1-2.1-2-3.7-3.5c-1.2,1.5-2,2.8-3,3.8C137.5,272.2,86.9,322.9,36.3,373.5   c-4.1,4.1-8.2,7.9-13.8,9.7C20,383.3,17.5,383.3,15,383.3z">
                                                </path>
                                            </g>
                                        </svg>
                                    </a>
                                    <img src="#" alt="" class="preview_img">
                                </span>

                                <input type="file" accept="image/*" name="user_avatar">
                            </label>
                            <!-- !Upload Shortcode -->

                        </div>

                        <div class="settings_right">
                            <div class="item">
                                <label class="input_label" for="name">Name</label>
                                <div class="input_item">
                                    <input class="input" type="text" id="name" name="name"
                                        value="{{ auth()->user()->name }}">
                                </div>
                            </div>
                            <div class="item">
                                <label class="input_label" for="username">Username</label>
                                <div class="input_item">
                                    <span class="email">@</span>
                                    <input class="input" type="text" id="username"
                                        value="{{ auth()->user()->username }}" readonly>
                                </div>
                            </div>
                            <div class="item">
                                <label class="input_label" for="email">Email Address</label>
                                <div class="input_item">
                                    <input class="input" type="text" id="email" value="{{ auth()->user()->email }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="item">
                                <label class="fn__checkbox">
                                    <input type="checkbox" id="check_change">I approve all changes
                                    <span class="checkmark"></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 408.8 294.1"
                                        style="enable-background:new 0 0 408.8 294.1;" xml:space="preserve"
                                        class="fn__svg replaced-svg">
                                        <g>
                                            <path
                                                d="M408.8,36.8c-2,10.1-8.3,17.4-15.4,24.5C319.6,135,245.8,208.8,172.1,282.6c-10,10-21.5,14.3-35.1,9.5   c-5-1.7-9.9-4.9-13.6-8.6C85.6,246.1,48.1,208.6,10.6,171c-15.1-15.2-13.9-37,2.6-49.9c12.8-10,30.9-8.2,43.7,4.6   c28.9,28.9,57.8,57.8,86.6,86.7c1.1,1.1,1.8,2.6,3.4,4.9c1.7-2.3,2.4-3.6,3.4-4.6c67.1-67.1,134.2-134.2,201.2-201.3   c9.7-9.7,21-13.8,34.5-9.6c11.8,3.7,18.8,12,21.9,23.8c0.2,0.9,0.5,1.7,0.8,2.6C408.8,31,408.8,33.9,408.8,36.8z">
                                            </path>
                                        </g>
                                    </svg>
                                </label>
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

@push('script')
    <!-- sweetalert -->
    <script type="text/javascript" src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script>
        let updateForm = document.getElementById('profile_update_form');
        let checkChange = document.getElementById('check_change');
        updateForm.addEventListener('submit', (e) => {
            e.preventDefault();
            if (checkChange.checked) {
                updateForm.submit();
            } else {
                toastr.error('Please agree to approve all changes.');
            }
        });
    </script>
@endpush
