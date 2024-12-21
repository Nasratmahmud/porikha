@php
    $user = App\Models\User::find(auth()->user()->id);
@endphp
<div class="header">

    <!-- navbar -->

    <div class="navbar-custom navbar navbar-expand-lg">

        <div class="container-fluid px-0">

            <a class="navbar-brand d-block d-md-none" href="{{ route('root.page') }}">

                @php

                    $setting = \App\Models\Setting::first();

                @endphp

                <img src="{{ !empty($setting->logo) ? asset($setting->logo) : asset('backend/images/logo/logo.png') }}"
                    alt="{{ $setting->title ?? 'Imanifest' }}" title="{{ $setting->title ?? 'Imanifest' }}">

            </a>

            <a id="nav-toggle" href="#!" class="ms-auto ms-md-0 me-0 me-lg-3 ">

                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                    class="bi bi-text-indent-left text-muted" viewBox="0 0 16 16">

                    <path
                        d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />

                </svg></a>

            <!--Navbar nav -->

            <ul class="navbar-nav navbar-right-wrap ms-lg-auto d-flex nav-top-wrap align-items-center ms-4 ms-lg-0">
                <a href="#"
                    class="form-check form-switch theme-switch btn btn-ghost btn-icon rounded-circle mb-0 ">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>

                </a>
                {{-- Notification  --}}
                <li class="dropdown stopevent ms-2">
                    <a class="btn btn-light btn-icon rounded-circle position-relative" href="#!" role="button"
                        id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-bell icon-xs">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class="position-absolute start-0 translate-middle badge rounded-pill bg-danger"
                            id="count-unread-notification" style="top:5px;">
                            {{ $user->unreadNotifications->count() > 99 ? '99+' : $user->unreadNotifications->count() }}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="dropdownNotification"
                        data-bs-popper="static">
                        <div>
                            <div class="border-bottom px-3 pt-2 pb-3 d-flex justify-content-between align-items-center">
                                <p class="mb-0 text-dark fw-medium fs-4">Notifications</p>
                            </div>
                            <div data-simplebar="init" style="height: 250px;">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                aria-label="scrollable content"
                                                style="height: 100%; overflow: hidden scroll;">
                                                <div class="simplebar-content" style="padding: 0px;">
                                                    <!-- List group -->
                                                    <ul class="list-group list-group-flush notification-list-scroll">
                                                        @forelse ($user->notifications as $notification)
                                                            <!-- List group item -->
                                                            <li class="list-group-item @if (!$notification->read_at) bg-light @endif"
                                                                onclick="markAsRead(this,'{{ $notification->id }}','{{ $notification->data['link'] }}')">
                                                                <a href="#" class="text-muted">
                                                                    <div class="d-flex justify-content-between">
                                                                        <h5 class=" mb-1">
                                                                            {{ $notification->data['name'] }}
                                                                        </h5>
                                                                        <span
                                                                            class="fs-6">{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                                                    </div>

                                                                    @if ($notification->data['link'])
                                                                        <a
                                                                            href="{{ $notification->data['link'] }}">{{ $notification->data['message'] }}</a>
                                                                    @else
                                                                        <p class="mb-0">
                                                                            {{ $notification->data['message'] }}
                                                                        </p>
                                                                    @endif
                                                                </a>
                                                            </li>
                                                        @empty
                                                            <li class="list-group-item">
                                                                <p class="text-center">No notification found</p>
                                                            </li>
                                                        @endforelse
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: auto; height: 407px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                    <div class="simplebar-scrollbar"
                                        style="height: 153px; display: block; transform: translate3d(0px, 0px, 0px);">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- List -->

                <li class="dropdown ms-2">

                    <a class="rounded-circle" href="#!" role="button" id="dropdownUser" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">

                        <div class="avatar avatar-md avatar-indicators avatar-online">

                            @if (empty(auth()->user()->user_avatar))
                                <img class="rounded-circle" src="{{ asset('backend/images/avatar/user-avatar.png') }}"
                                    alt="{{ auth()->user()->email }}">
                            @else
                                <img class="rounded-circle" src="{{ asset('/' . auth()->user()->user_avatar) }}"
                                    alt="{{ auth()->user()->email }}">
                            @endif

                        </div>

                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">

                        <div class="px-4 pb-0 pt-2">

                            <div class="lh-1 ">

                                <h5 class="mb-1"> {{ auth()->user()->name }}</h5>

                            </div>

                            <div class=" dropdown-divider mt-3 mb-2">

                                <h5 class="mb-1"></h5>

                            </div>

                        </div>



                        <ul class="list-unstyled">



                            <li>

                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('userProfile', ['type' => 'profile']) }}">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-shopping-cart nav-icon me-2 icon-xxs">

                                        <circle cx="9" cy="21" r="1"></circle>

                                        <circle cx="20" cy="21" r="1"></circle>

                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">

                                        </path>

                                    </svg>

                                    @php

                                        $balance = App\Models\CoinBalance::where('user_id', auth()->user()->id)
                                            ->latest()
                                            ->select('total')
                                            ->first();

                                    @endphp

                                    Balance : <span> ${{ $balance->total }}</span>

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('userProfile', ['type' => 'profile']) }}">

                                    <i class="me-2 icon-xxs dropdown-item-icon" data-feather="user"></i>Edit

                                    Profile

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                    <i class="me-2 icon-xxs dropdown-item-icon" data-feather="power"></i>

                                    Sign Out

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>

                                </a>

                            </li>

                        </ul>



                    </div>

                </li>

            </ul>

        </div>

    </div>

</div>
