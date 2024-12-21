@extends('backend.app')

<!-- Start:Title -->
@section('title', 'Setting')
<!-- End:Title -->

<!-- Start:Sub Header Menu -->
@section('sub-header-menu')
    <li class="breadcrumb-item">
        <span>Setting</span>
    </li>
@endsection
<!-- End:Sub Header Menu -->

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }

        .ck-editor__editable[role="textbox"] {
            min-height: 150px;
        }

        @media (min-width: 200px) and (max-width: 728px) {

            .list-group,
            .tab-content {
                width: 100%;
                padding-right: 0px !important;
                margin-bottom: 10px;
            }

            html:not([dir=rtl]) .pe-3 {
                padding-right: 0px !important;
            }

            .setting-content {
                display: block !important;
            }

        }

        .dropify-wrapper {
            width: 150px;
            height: 150px;
            padding: 0;
            /* font-size: 14px; */
            border: none;
        }
    </style>
@endpush

<!-- Start:Content -->
@section('content')
    <div class="app-content-area">
        <div class="container-fluid">
            <div class="row mx-2">
                <div class="col-lg-12 col-md-12 col-12">
                    <!-- Page header -->
                    <div class="mb-5">
                        <h3 class="mb-0 ">Profile Setting</h3>
                        <a class="bg-transparent" href="{{ route('home') }}">
                            <i class="bi bi-chevron-left"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>


            <div class="row mx-2">
                <div class="col-lg-12 col-12">
                    <!-- Start:Alert -->
                    @include('backend.partials.alert')
                    <!-- End:Alert -->
                    <div class="d-flex setting-content align-items-start">

                        <div class="col-3 list-group nav flex-column nav-pills pe-3" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a href="{{ route('user.profile') }}"
                                class="list-group-item list-group-item-action {{ request()->routeIs('user.profile') ? 'active' : 'bg-white' }} ">
                                Profile
                            </a>
                            <a href="{{ route('user.password') }}"
                                class="list-group-item list-group-item-action {{ request()->routeIs('user.password') ? 'active' : 'bg-white' }} ">
                                Password
                            </a>
                            @can('profile setting')
                                <a href="{{ route('stripe.setting') }}"
                                    class="list-group-item list-group-item-action {{ request()->routeIs('stripe.setting') ? 'active' : 'bg-white' }} ">
                                    Stripe Setting
                                </a>
                                <a href="{{ route('pusher.setting') }}"
                                    class="list-group-item list-group-item-action {{ request()->routeIs('pusher.setting') ? 'active' : 'bg-white' }} ">
                                    Pusher Setting
                                </a>
                                <a href="{{ route('mail.setting') }}"
                                    class="list-group-item list-group-item-action {{ request()->routeIs('mail.setting') ? 'active' : 'bg-white' }} ">
                                    Mail Setting
                                </a>
                                <a href="{{ route('dynamic_page.create') }}"
                                    class="list-group-item list-group-item-action {{ request()->routeIs('dynamic_page.create') ? 'active' : 'bg-white' }}">
                                    Add Dynamic Page
                                </a>
                                @php
                                    $dynamicPages = \App\Models\DynamicPage::where('status', 1)->get();
                                @endphp

                                @foreach ($dynamicPages as $dynamicPage)
                                    <a href="{{ route('dynamic_page.edit', $dynamicPage->id) }}"
                                        class="list-group-item list-group-item-action {{ request()->is('dynamic-page/update/' . $dynamicPage->id) ? 'active' : 'bg-white' }}">
                                        {{ $dynamicPage->page_title }}
                                    </a>
                                @endforeach
                            @endcan
                        </div>


                        <div class="col-9 tab-content" id="v-pills-tabContent">

                            <!-- Start:Setting-Tab -->
                            <div class="tab-pane {{ request()->routeIs('setting') ? 'show active' : '' }}">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-content-center">
                                        <div class="d-flex align-content-center">
                                            <strong>General Setting</strong>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('setting.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group my-3">
                                                <label for="title">
                                                    <b>Title</b>
                                                </label>
                                                <input type="text" name="title" id="title" class="form-control"
                                                    value="{{ empty($setting->title) ? 'Accounting System' : $setting->title }}">
                                                @error('title')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group my-3">
                                                <label for="logo">
                                                    <b>Logo (Only image are allowed)</b>
                                                </label>
                                                @if (empty($setting->logo))
                                                    <input type="file" class="form-control dropify"
                                                        data-default-file="{{ asset('dashboard/image/logo_full.png') }}"
                                                        name="logo" id="logo">
                                                @else
                                                    <input type="file" class="form-control dropify"
                                                        data-default-file="{{ asset('/' . $setting->logo) }}"
                                                        name="logo" id="logo">
                                                @endif

                                                @error('logo')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <!-- Start:Favicon -->
                                            <div class="form-group my-3">
                                                <label for="favicon"><b>Favicon (Only image are allowed, size: 33 x 33)</b>
                                                </label>
                                                @if (empty($setting->favicon))
                                                    <input type="file" class="form-control dropify"
                                                        data-default-file="{{ asset('dashboard/image/logo.png') }}"
                                                        name="favicon" id="favicon">
                                                @else
                                                    <input type="file" class="form-control dropify"
                                                        data-default-file="{{ asset('/' . $setting->favicon) }}"
                                                        name="favicon" id="favicon">
                                                @endif

                                                @error('favicon')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <!-- End:Favicon -->

                                            <!-- Start:Address -->
                                            <div class="form-group my-3">
                                                <label for="address"> <b>Address</b> </label>
                                                <input type="text" name="address" id="address" class="form-control"
                                                    value="{{ empty($setting->address) ? '26985 Brighton Lane, Lake Forest, CA 92630' : $setting->address }}">
                                                @error('address')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <!-- End:Address -->

                                            <div class="form-group my-3">
                                                <label for="description"> <b>Description</b> </label>
                                                <textarea name="description" class="form-control" id="description" cols="30" rows="10">
                                                    @if (empty($setting->description))
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
@else
{{ $setting->description }}
@endif
                                                </textarea>
                                                @error('description')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <button type="submit" class="btn btn-success text-white">
                                                Update
                                            </button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End:Setting-Tab -->

                            <!-- Start:Profile-Tab -->
                            <div class="tab-pane fade {{ request()->routeIs('user.profile') ? 'show active' : '' }}">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-content-center">
                                        <div class="d-flex align-content-center">
                                            <strong>Profile</strong>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('user.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group my-3">
                                                <label for="logo" class="mb-2">
                                                    <b>User Avarat</b>
                                                </label>
                                                @if (empty(auth()->user()->user_avatar))
                                                    <input type="file" class="form-control dropify"
                                                        data-default-file="{{ asset('dashboard/image/user.png') }}"
                                                        name="user_avatar" id="user_avatar">
                                                @else
                                                    <input type="file" class="form-control dropify"
                                                        data-default-file="{{ asset('/' . auth()->user()->user_avatar) }}"
                                                        name="user_avatar" id="user_avatar">
                                                @endif
                                                @error('user_avatar')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group my-3">
                                                <label for="title"><b>Name</b></label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    value="{{ auth()->user()->name }}">
                                                @error('name')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group my-3">
                                                <label for="title"><b>Email</b></label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    value="{{ auth()->user()->email }}">
                                                @error('email')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <button type="submit" class="btn btn-success text-white">
                                                Update
                                            </button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End:Profile-Tab -->

                            <!-- Start:Password-Tab -->
                            <div class="tab-pane fade {{ request()->routeIs('user.password') ? 'show active' : '' }}">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-content-center">
                                        <div class="d-flex align-content-center">
                                            <strong>Password</strong>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('user.password-update') }}" class="password_form"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group col-6 mb-1 px-1">
                                                <label for="old_password"><b>Old Password</b></label>
                                                <div class="input-group input-group-sm">
                                                    <input type="password" class="form-control" id="old_password"
                                                        name="old_password">
                                                    <span class="input-group-text" id="inputGroup-sizing-lg"
                                                        onclick="passwordVisisbility('old_password','old_password_icon')">
                                                        <i class="bx bx-low-vision" id="old_password_icon"></i>
                                                    </span>
                                                </div>
                                                @error('old_password')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="d-flex justify-content-between mb-2">
                                                <div class="form-group col-6 px-1">
                                                    <label for="new_password"><b>New Password</b></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="password" class="form-control" id="new_password"
                                                            name="new_password">
                                                        <span class="input-group-text" id="inputGroup-sizing-lg"
                                                            onclick="passwordVisisbility('new_password','new_password_icon')">
                                                            <i class="bx bx-low-vision" id="new_password_icon"></i>
                                                        </span>
                                                    </div>
                                                    @error('new_password')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-6 px-1">
                                                    <label for="confirm_password"><b>Confirm Password</b></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="password" class="form-control" id="confirm_password"
                                                            name="confirm_password">
                                                        <span class="input-group-text" id="inputGroup-sizing-lg"
                                                            onclick="passwordVisisbility('confirm_password','confirm_password_icon')">
                                                            <i class="bx bx-low-vision" id="confirm_password_icon"></i>
                                                        </span>
                                                    </div>
                                                    @error('confirm_password')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success mx-1 text-white">
                                                Update
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End:Password-Tab -->

                            @can('profile setting')
                                <!-- Start:Stripe-Tab -->
                                <div class="tab-pane fade {{ request()->routeIs('stripe.setting') ? 'show active' : '' }}">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-content-center">
                                            <div class="d-flex align-content-center">
                                                <strong>Stripe Setting</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('stripe.setting.update') }}" class="password_form"
                                                method="POST">
                                                @csrf
                                                <div class="form-group mb-3 px-1">
                                                    <label for="stripe_key"><b>Stripe Key</b></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" id="stripe_key"
                                                            name="stripe_key" value="{{ env('STRIPE_KEY') }}">
                                                    </div>
                                                    @error('stripe_key')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3 px-1">
                                                    <label for="stripe_secret"><b>Stripe Secret</b></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" id="stripe_secret"
                                                            name="stripe_secret" value="{{ env('STRIPE_SECRET') }}">
                                                    </div>
                                                    @error('stripe_secret')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-success mx-1 text-white">
                                                    Update
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End:Stripe-Tab -->

                                <!-- Start:Pusher-Tab -->
                                <div class="tab-pane fade {{ request()->routeIs('pusher.setting') ? 'show active' : '' }}">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-content-center">
                                            <div class="d-flex align-content-center">
                                                <strong>Pusher Setting</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('pusher.setting.update') }}" class="password_form"
                                                method="POST">
                                                @csrf
                                                <div class="form-group mb-3 px-1">
                                                    <label for="pusher_app_id"><b>Pusher App ID</b></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" id="pusher_app_id"
                                                            name="pusher_app_id" value="{{ env('PUSHER_APP_ID') }}">
                                                    </div>
                                                    @error('pusher_app_id')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3 px-1">
                                                    <label for="pusher_app_key"><b>Pusher App Key</b></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" id="pusher_app_key"
                                                            name="pusher_app_key" value="{{ env('PUSHER_APP_KEY') }}">
                                                    </div>
                                                    @error('pusher_app_key')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3 px-1">
                                                    <label for="pusher_app_secret"><b>Pusher App Sercet</b></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" id="pusher_app_secret"
                                                            name="pusher_app_secret" value="{{ env('PUSHER_APP_SECRET') }}">
                                                    </div>
                                                    @error('pusher_app_secret')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-success mx-1 text-white">
                                                    Update
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End:Pusher-Tab -->

                                <!-- Start:Mail-Tab -->
                                <div class="tab-pane fade {{ request()->routeIs('mail.setting') ? 'show active' : '' }}">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-content-center">
                                            <div class="d-flex align-content-center">
                                                <strong>Mail Setting</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('mail.setting.update') }}" class="password_form"
                                                method="POST">
                                                @csrf
                                                <div class="form-group mb-3 px-1">
                                                    <label for="mail_mailer"><b>Mail Mailer</b></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" id="mail_mailer"
                                                            name="mail_mailer" value="{{ env('MAIL_MAILER') }}">
                                                    </div>
                                                    @error('mail_mailer')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3 px-1">
                                                    <label for="mail_host"><b>Mail Host</b></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" id="mail_host"
                                                            name="mail_host" value="{{ env('MAIL_HOST') }}">
                                                    </div>
                                                    @error('mail_host')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3 px-1">
                                                    <label for="mail_port"><b>Mail Port</b></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" id="mail_port"
                                                            name="mail_port" value="{{ env('MAIL_PORT') }}">
                                                    </div>
                                                    @error('mail_port')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3 px-1">
                                                    <label for="mail_username"><b>Mail Username</b></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" id="mail_username"
                                                            name="mail_username" value="{{ env('MAIL_USERNAME') }}">
                                                    </div>
                                                    @error('mail_username')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3 px-1">
                                                    <label for="mail_password"><b>Mail Password</b></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" id="mail_password"
                                                            name="mail_password" value="{{ env('MAIL_PASSWORD') }}">
                                                    </div>
                                                    @error('mail_password')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3 px-1">
                                                    <label for="mail_encryption"><b>Mail Encryption</b></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" id="mail_encryption"
                                                            name="mail_encryption" value="{{ env('MAIL_ENCRYPTION') }}">
                                                    </div>
                                                    @error('mail_encryption')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3 px-1">
                                                    <label for="mail_from_address"><b>Mail From Address</b></label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" id="mail_from_address"
                                                            name="mail_from_address" value="{{ env('MAIL_FROM_ADDRESS') }}">
                                                    </div>
                                                    @error('mail_from_address')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-success mx-1 text-white">
                                                    Update
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End:Mail-Tab -->

                                <!-- Start:Dynamic Page add Tab -->
                                <div
                                    class="tab-pane fade {{ request()->routeIs('dynamic_page.create') ? 'show active' : '' }}">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-content-center">
                                            <div class="d-flex align-content-center">
                                                <strong>Add Dynamic Page</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('dynamic_page.store') }}" method="POST">
                                                @csrf

                                                <div class="form-group my-3">
                                                    <label for="page_title"><b>Page Title</b></label>
                                                    <input type="text" name="page_title" id="page_title"
                                                        class="form-control" value="{{ old('page_title') }}">
                                                    @if ($errors->has('page_title'))
                                                        <span class="help-block text-danger">
                                                            {{ $errors->first('page_title') }}
                                                        </span>
                                                    @endif
                                                </div>


                                                <div class="form-group my-3">
                                                    <label for="terms_content"> <b>Content</b> </label>
                                                    <textarea name="page_content" class="form-control rich_text_content" id="dynamic_page_content" cols="30"
                                                        rows="10"></textarea>
                                                    @if ($errors->has('page_content'))
                                                        <span class="help-block text-danger">
                                                            {{ $errors->first('page_content') }}
                                                        </span>
                                                    @endif
                                                </div>

                                                <button type="submit" class="btn btn-success text-white">
                                                    Submit
                                                </button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End:Dynamic Page add Tab -->

                                <!-- Start:Selected Dynamic Page Update Tab -->
                                @foreach ($dynamicPages as $dynamicPage)
                                    <div
                                        class="tab-pane {{ request()->is('dynamic-page/update/' . $dynamicPage->id) ? 'show active' : '' }}">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between align-content-center">
                                                <div class="d-flex align-content-center">
                                                    <strong>Update Dynamic Page</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('dynamic_page.update', $dynamicPage->id) }}"
                                                    method="POST">
                                                    @csrf

                                                    <div class="form-group my-3">
                                                        <label for="page_title"><b>Page Title</b></label>
                                                        <input type="text" name="page_title" id="page_title"
                                                            class="form-control" value="{{ $dynamicPage->page_title }}">
                                                        @if ($errors->has('page_title'))
                                                            <span class="help-block text-danger">
                                                                {{ $errors->first('page_title') }}
                                                            </span>
                                                        @endif
                                                    </div>


                                                    <div class="form-group my-3">
                                                        <label for="terms_content"> <b>Content</b> </label>
                                                        <textarea name="page_content" class="form-control rich_text_content"
                                                            id="dynamic_page_content_update_{{ $dynamicPage->id }}" cols="30" rows="10">{!! $dynamicPage->page_content !!}</textarea>
                                                        @if ($errors->has('page_content'))
                                                            <span class="help-block text-danger">
                                                                {{ $errors->first('page_content') }}
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <button type="submit" class="btn btn-success text-white">
                                                        Submit
                                                    </button>

                                                    <a href="{{ route('dynamic_page.delete', $dynamicPage->id) }}"
                                                        type="button" class="btn btn-danger text-white">
                                                        Delete
                                                    </a>



                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- End:Dynamic Page Tab-Tab -->
                            @endcan


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- End:Content -->

<!-- Start:Script -->
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });

        ClassicEditor
            .create(document.querySelector('#description'), {
                removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle',
                    'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                ],
            })
            .catch(error => {
                console.error(error);
            });

        createCKEditors()
        // Function to create CKEditor instances for all elements with class dynamic_page_content_update
        function createCKEditors() {
            var elements = document.querySelectorAll('.rich_text_content');
            elements.forEach(function(element) {
                ClassicEditor
                    .create(element, {
                        removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image',
                            'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                        ]
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        }
    </script>

    <script>
        function passwordVisisbility(input, icon) {
            if ($('.password_form #' + icon).hasClass('bx-low-vision')) {
                $('.password_form #' + icon).removeClass('bx-low-vision');
                $('.password_form #' + icon).addClass('bx-show');
                $('.password_form #' + input).attr('type', 'text');
            } else {
                console.log(input);
                $('.password_form #' + icon).removeClass('bx-show');
                $('.password_form #' + icon).addClass('bx-low-vision');
                $('.password_form #' + input).attr('type', 'password');
            }
        }
    </script>
@endpush
<!-- End:Script -->
